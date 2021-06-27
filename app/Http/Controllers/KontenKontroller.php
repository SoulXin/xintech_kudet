<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Alert;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class KontenKontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::beginTransaction();
        try{
            $konten = DB::table('konten')->get();
            DB::commit();
    
            return view('konten.index',[
                'list_konten' => $konten
            ]);
        }catch(\Throwable $e){
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        DB::beginTransaction();
        try{
            $objek = DB::table('objek')->get();
            DB::commit();

            return view('konten.create',[
                'objek' => $objek
            ]);
        }catch(\Throwable $e){
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_konten' => 'required|min:3|unique:konten', // => parameter ketiga adalah nama table
            'banner_konten'=> 'required',
            'status' => 'required',
            'objek' => 'required'
        ],[
            'unique' => 'Nama konten ":input" tidak bisa digunakan.', // => :input adalah request inputan dari frontend
        ]);


        if($validator->fails()){ // => jika validator gagal
            Alert::error('Masalah!', $validator->messages()->all()[0]);
            return back();
        }else{ // => jika validator berhasil
            DB::beginTransaction();
            $filename = Request()->file('banner_konten')->getClientOriginalName();
            $gambar = Image::make(Request()->file('banner_konten'))->resize(300,200)->save('gambar/banner/'. time().'_' .$filename);

            try{
                $content_id = DB::table('konten')->insertGetId([
                    'nama_konten' => $request->nama_konten,
                    'banner_konten' => $gambar->basename,
                    'status' => $request->status,
                    'jenis_konten' => $request->jenis_konten,
                    'id_objek' => $request->objek,
                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),
                ]);

                DB::commit();
                Alert::success('Berhasil!', 'Konten berhasil di tambahkan');
                return redirect('admin/xin/home');
            }catch(\Throwable $e){
                $path = public_path()."/gambar/banner/".$gambar->basename;
                unlink($path);

                DB::rollback();
                throw $e;
            }
        }
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
        $konten = DB::table('konten')
        ->join('objek','objek.id','=','konten.id_objek')
        ->where('konten.id','=',$id)
        ->select('konten.id','konten.nama_konten','konten.banner_konten','konten.status','konten.view','konten.jenis_konten','konten.id_objek')
        ->first();
        $objek = DB::table('objek')->get();

        return view('konten.edit')->with([
            'konten' => $konten,
            'objek' => $objek
        ]);
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
        $validator = Validator::make($request->all(),[
            'nama_konten' => 'required|min:3', // => parameter ketiga adalah nama table
            'status' => 'required',
            'objek' => 'required',
            'jenis_konten' => 'required'
        ],[
            'required' => 'Tidak boleh ada data yang kosong', // => :input adalah request inputan dari frontend
        ]);

        if($validator->fails()){ // => jika validator gagal
            Alert::error('Masalah!', $validator->messages()->all()[0]);
            return back();
        }else{ // => jika validator berhasil
            DB::beginTransaction();
            $gambar = '';
            
            try{
                if($request->banner_konten){
                    $konten = DB::table('konten')->where('id','=',$id)->first();

                    
                    $path = public_path()."/gambar/banner/".$konten->banner_konten;
                    if(is_file($path)){
                        unlink($path);
                    }
                    
                    $filename = Request()->file('banner_konten')->getClientOriginalName();
                    $gambar = Image::make(Request()->file('banner_konten'))->resize(300,200)->save('gambar/banner/'. time().'_' .$filename);

                    DB::table('konten')
                    ->where('id',$id)
                    ->update([
                        'nama_konten' => $request->nama_konten,
                        'banner_konten' => $gambar->basename,
                        'status' => $request->status,
                        'jenis_konten' => $request->jenis_konten,
                        'id_objek' => $request->objek
                    ]);
                }else{
                    DB::table('konten')
                    ->where('id',$id)
                    ->update([
                        'nama_konten' => $request->nama_konten,
                        'status' => $request->status,
                        'id_objek' => $request->objek
                    ]);
                }
                
                DB::commit();
                Alert::success('Berhasil!', 'Konten berhasil di perbarui');
                return redirect()->route('konten.index');
            }catch(\Throwable $e){
                if($gambar){
                    $path = public_path()."/gambar/banner/".$gambar->basename;
                    unlink($path);
                }

                DB::rollback();
                throw $e;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();          
        try{
            $konten = DB::table('konten')->where('id',$id)->select('banner_konten')->first();
            $path = public_path()."/gambar/banner/".$konten->banner_konten;
            if(is_file($path)){
                unlink($path);
            }

            $konten_detail = DB::table('konten_detail')
            ->where([
                ['id_konten','=',$id],
                ['jenis','=','2']
            ])
            ->select('isi')
            ->get();

            for($a = 0; $a < count($konten_detail); $a++){
                $path_detail = public_path()."/gambar/detail/".$konten_detail[$a]->isi;
                if(is_file($path_detail)){
                    unlink($path_detail);
                }
            }

            // Hapus
            DB::table('konten')->delete($id);
            DB::table('konten_detail')->where('id_konten', $id)->delete();

            DB::commit();
            Alert::success('Berhasil!', 'Konten berhasil di hapus');
            return redirect()->route('konten.index');
        }catch(\Throwable $e){
            DB::rollback();
            throw $e;
        }
    }
}
