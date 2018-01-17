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
                        ->get();
        // dd($dataTransaksi);
        return view('admin.transaksi.index',compact('dataTransaksi'));
    }

    public function create()
    {
        $allCustomer = Customer::orderBy('name','ASC')->get();

        $kategoriProduk = KategoriProduk::orderBy('name','ASC')->get();

        return view('admin.transaksi.create',compact('allCustomer','kategoriProduk'));

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
}
