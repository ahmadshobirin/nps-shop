<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function transaksiController(Request $request)
    {
        
        $tglmulai = substr($request->periode,0,10);
        $tglsampai = substr($request->periode,13,10);

        $query = DB::table('t_transaksi');
        $query->join('m_customer','m_customer.id','t_transaksi.customer_id');
        $query->join('d_transaksi','d_transaksi.transaksi_id','t_transaksi.id');
        $query->join('m_produk','m_produk.id','d_transaksi.produk_id');
        $query->join('m_kategori_produk','m_kategori_produk.id','d_transaksi.kategori_produk_id');
        $query->select('t_transaksi.*','m_customer.id as id_customer','m_customer.name as customer','d_transaksi.qty','d_transaksi.selling_price',
        'd_transaksi.purchase_price','d_transaksi.subTotal','d_transaksi.produk_id','m_produk.name as produk','m_kategori_produk.name as kategori');
        $query->where('date_transaction','>=',date('Y-m-d', strtotime($tglmulai)));
        $query->where('date_transaction','<=',date('Y-m-d', strtotime($tglsampai. ' + 1 days')));
        $query->where('t_transaksi.type', $request->status);
        if($request->customer != null) {$query->where('t_transaksi.customer_id', $request->customer);}
        if($request->barang != null) {$query->where('d_transaksi.produk_id', $request->barang);}

        $results = $query->get();
        // dd($data,$request->all());
        return view('admin.transaksi.report',compact('results'));


    }
}
