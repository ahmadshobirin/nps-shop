<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataProduk = Produk::with(['category'])->orderBy('id','DESC')->get();
        // dd($dataProduk);
        return view('admin.produk.index',compact('dataProduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $code = $this->setCodeProduk();
        $kategoriProduk = KategoriProduk::orderBy('name')->get();
        return view('admin.produk.create',compact('kategoriProduk'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request,[
            'code' => 'required|max:30|unique:m_produk',
            'name' => 'required|max:30',
            'kategori_id' => 'required',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataProduk = Produk::where('id',$id)->first();
        $kategoriProduk = KategoriProduk::orderBy('name')->get();

        return view('admin.produk.update',compact('dataProduk','kategoriProduk'));
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
            'code' => 'required|max:30|unique:m_produk,code,'.$id,
            'name' => 'required|max:30',
            'kategori_id' => 'required',
        ]);

        Produk::where('id',$id)->update($request->except('_token','_method'));

        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cekData = DB::table('d_transaksi')->where('produk_id',$id)->count();

        if($cekData > 0 ){
            return redirect()->route('produk.index')->with('message','Data tidak Bisa dihapus karena sudah dipakai untuk transaksi');
        }

        Produk::where('id',$id)->delete();
        return redirect()->route('produk.index')->with('message-success','Data berhasil dihapus');
    }

    protected function setCodeProduk()
    {
        $getLastCode = DB::table('m_produk')->select('id')->orderBy('id', 'desc')->pluck('id')->first();

        $getLastCode = $getLastCode +1;

        $nol = null;
        if(strlen($getLastCode) == 1){$nol = "000000";}elseif(strlen($getLastCode) == 2){$nol = "00000";
        }elseif(strlen($getLastCode) == 3){$nol = "0000";}elseif(strlen($getLastCode) == 4){$nol = "000";
        }elseif(strlen($getLastCode) == 5){$nol = "00";}elseif(strlen($getLastCode) == 6){$nol = "0";
        }else{$nol = null;}

        //set value request code
        return 'PRD'.$nol.$getLastCode;
    }

    public function Development()
    {
        # code...
    }
}
