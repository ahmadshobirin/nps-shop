<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCustomer = Customer::orderBy('id','DECS')->get();

        return view('admin.customer.index',compact('dataCustomer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->name);

        $this->validate($request,[
            'name' => 'required|max:30',
            'telephone' => 'max:13',
        ]);

        Customer::create($request->all());

        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::where('id',$id)->first();
        return view('admin.customer.update',compact('customer'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $this->validate($request,[
            'name' => 'required|max:30',
            'telephone' => 'max:13',
        ]);

        Customer::where('id',$id)->update($request->except('_token','_method'));

        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cekDataCustomer = DB::table('t_transaksi')->where('customer_id',$id)->count();
        if($cekDataCustomer > 0 ){
            return redirect()->route('customer.index')->with('message','Data tidak Bisa dihapus karena sudah dipakai untuk transaksi');
        }

        Customer::where('id',$id)->delete();
        return redirect()->route('customer.index')->with('message-success','Data berhasil dihapus');
    }
}
