<?php

namespace App\Http\Controllers;

use DB;
use Response;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\KategoriProduk;
use App\Models\Produk;

class TransaksiController extends Controller
{
	public function index()
	{
		$dataTransaksi = DB::table('t_transaksi')
						->join('m_customer','t_transaksi.customer_id','m_customer.id')
						->select('*','t_transaksi.id as id_transaction')
						->orderBy('id_transaction','DESC')
						->get();

		$customerTrans = DB::table('m_customer')
						->join('t_transaksi','t_transaksi.customer_id','m_customer.id')
						->select('m_customer.id','m_customer.name')
						->groupBy('m_customer.id','m_customer.name')
						->orderBy('name','ASC')
						->get();

		$barang = DB::table('d_transaksi')
				->join('m_produk','m_produk.id','d_transaksi.produk_id')
				->select('m_produk.id','m_produk.name')
				->groupBy('m_produk.id','m_produk.name')
				->orderBy('name','ASC')
				->get();
		
		// dd($dataTransaksi);
		return view('admin.transaksi.index',compact('dataTransaksi','customerTrans','barang'));
	}

	public function create()
	{
		$allCustomer = Customer::orderBy('name','ASC')->get();

		$kategoriProduk = KategoriProduk::orderBy('name','ASC')->get();

		return view('admin.transaksi.create',compact('allCustomer','kategoriProduk'));

	}


	public function store(Request $request)
	{

		( $request->payment_date != null ) ? $payment_date = date('Y-m-d', strtotime($request->payment_date)) : $payment_date = null ;
		
		$array = [];
		$i = 0;
		foreach( $request->beli as $rawBeli ){
			$array[$i]['beli'] = $rawBeli;
			$i++;
		}
		$i = 0;
		foreach( $request->hargaProduk as $rawhargaProduk ){
			$array[$i]['jual'] = $rawhargaProduk;
			$i++;
		}
		$i = 0;
		foreach( $request->jumlah as $rawjumlah ){
			$array[$i]['qty'] = $rawjumlah;
			$i++;
		}
		$i = 0;
		foreach( $request->subtotal as $rawsubtotal ){
			$array[$i]['subtotal'] = $rawsubtotal;
			$i++;
		}
		$i = 0;
		foreach( $request->kategori as $rawkategori ){
			$array[$i]['kategori'] = $rawkategori;
			$i++;
		}
		$i = 0;
		foreach( $request->produk as $rawproduk ){
			$array[$i]['produk'] = $rawproduk;
			$i++;
		}

		// echo "<pre>";
		// 	print_r($array);
		// dd($request->all());
			
		DB::beginTransaction();
		try{

			DB::table('t_transaksi')->insert([
				'customer_id' => $request->customer_id,
				'payment_date' => $payment_date,
				'source' => $request->source,
				'deskripsi' => $request->deskripsi,
				'grand_total' => $request->total,
				'rincian' => $request->rincian,
				'type' => $request->type,
			]);

			$newTransaction = DB::table('t_transaksi')->orderBy('id','DESC')->first();

			for($x=0; $x<count($array); $x++){

				DB::table('d_transaksi')->insert([
					'transaksi_id' => $newTransaction->id,
					'kategori_produk_id' => $array[$x]['kategori'],
					'produk_id' => $array[$x]['produk'],
					'qty' => $array[$x]['qty'],
					'purchase_price' => $array[$x]['beli'],
					'selling_price' => $array[$x]['jual'],
					'subTotal' => $array[$x]['subtotal'],
				]);
			}

			DB::commit();
		}catch(\Exception $e){
			DB::rollback();
		}

		return redirect()->route('transaksi.index');
	}

	public function show($id)
	{
		$header = DB::table('t_transaksi')
				->join('m_customer','t_transaksi.customer_id','m_customer.id')
				->where('t_transaksi.id',$id)
				->first();
		
		$detail = DB::table('d_transaksi')
				->join('m_produk','d_transaksi.produk_id','m_produk.id')
				->join('m_kategori_produk','d_transaksi.kategori_produk_id','m_kategori_produk.id')
				->select('d_transaksi.*','m_produk.name as produk','m_produk.code','m_kategori_produk.name as kategori')
				->where('transaksi_id',$id)
				->get();
		// dd($header);
		return view('admin.transaksi.detail',compact('header','detail'));
	}

	public function edit($id)
	{
		$allCustomer = Customer::orderBy('name','ASC')->get();

		$kategoriProduk = KategoriProduk::orderBy('name','ASC')->get();

		$allProduk = Produk::orderBy('name','ASC')->get();

		$header = DB::table('t_transaksi')
				->join('m_customer','t_transaksi.customer_id','m_customer.id','t_transaksi.id')
				->select('*','t_transaksi.id as id_transaction')
				->where('t_transaksi.id',$id)
				->first();
		
		$detail = DB::table('d_transaksi')
				->join('m_produk','d_transaksi.produk_id','m_produk.id')
				->join('m_kategori_produk','d_transaksi.kategori_produk_id','m_kategori_produk.id')
				->where('transaksi_id',$id)
				->get();
		// dd($detail,$header);
		return view('admin.transaksi.update',compact('header','detail','allCustomer','allProduk','kategoriProduk'));		
	}

	public function update(Request $request,$id)
	{
		// dd($request->all());

		if( $request->type == 'paid' ){

			DB::beginTransaction();
			try{
				//update header

				DB::table('t_transaksi')->where('t_transaksi.id',$id)
					->update([
						'type' => $request->type,
						'payment_date' => date('Y-m-d',strtotime($request->payment_date)),
						'deskripsi' => $request->deskripsi,
						'rincian' => $request->rincian,
					]);

				DB::commit();				
			}catch(\Exceptionn $e){
				DB::rollback();
				dd($e);
			}
			
		}

		return redirect()->route('transaksi.index');
	}

	public function destroy($id)
	{
		DB::table('t_transaksi')->where('t_transaksi.id',$id)->delete();

		DB::table('d_transaksi')->where('transaksi_id',$id)->delete();

		return redirect()->route('transaksi.index');
		
	}

	//ajax-transaction
	public function getCustomer($id)
	{
		return Response::json(Customer::find($id));
	}

	public function getProduk($id)
	{
		return Response::json(Produk::where('kategori_id',$id)->get());
	}

	public function getDetailProduk(Request $request)
	{
		$result = Produk::where('id',$request->id)->first();
		
		$produk = $request->produk;


        $cekproduk = 0;
        if ($produk != null || $produk != '') {
            foreach ($produk as $i => $raw_produk) {
                if ($request->id == $produk[$i]) {
                    $cekproduk = 1;
                }
            }
		}
		
		if( $cekproduk == 0 ){
			$row = "<tr id='row_".$request->id."'>";
			
				$row .= "<td>";
					$row .= "<input type='text' readonly class='form-control input-sm' value='".$result->code."'>";
					$row .= "<input type='hidden' readonly class='form-control input-sm' name='produk[".$request->id."]' value='".$request->id."' id='produk_id_".$request->id."' '>";
					$row .= "<input type='hidden' readonly class='form-control input-sm' name='kategori[".$request->id."]' value='".$result->kategori_id."'>";
				$row .= "</td>";

				$row .= "<td>";
					$row .= "<input type='text' readonly class='form-control input-sm' value='".$result->name."'>";
				$row .= "</td>";

				$row .= "<td>";
					$row .= "<input type='number' min='0'  class='form-control input-sm' value='' name='beli[".$request->id."]' required>";
				$row .= "</td>";

				$row .= "<td>";
					$row .="<input type='number' min='1' class='form-control input-sm ". $request->id."_produkPrice' value='' name='hargaProduk[".$request->length."]' id='". $request->id."_harga' onkeyup='hitungSubTotal(".$request->id.");' onkeypress='hitungSubTotal(". $request->id.");' autocomplete='off' onchange='hitungSubTotal(". $request->id.");' required>";
				$row .= "</td>";

				$row .= "<td>";
					$row .= "<input type='number' min='1' max='' id='".$request->id."_jumlah' class='form-control input-sm' onkeyup='hitungSubTotal(".$request->id.");' onkeypress='hitungSubTotal(". $request->id.");' autocomplete='off' onchange='hitungSubTotal(". $request->id.");' name='jumlah[".$request->length."]' value='1'";
				$row .= "</td>";

				$row .= "<td>";
					$row .= "<input type='number' min='0' readonly class='form-control input-sm ". $request->id."_subTotal' value='' name='subtotal[".$request->id."]'  id='". $request->id."_subTotal'>";
				$row .= "</td>";


				$row .= "<td> <button type='button' value='".$request->id."' class='btn btn-danger btn-sm btn-delete' onclick='hapusBaris(". $request->id.")'><span class='fa fa-trash'></span></button></td>";

			$row .= "</tr>";

		}else{
			$row = '';
		}
		
		return $row;
	}
}
