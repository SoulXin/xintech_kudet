<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Alert;
use stdClass;
use Intervention\Image\ImageManagerStatic as Image;

class KontenDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // Fungsi untuk menampilkan seluruh detail yang telah dibuat dan masih bersifat sementara ( blm di publish )
    public function create()
    {
        DB::beginTransaction();
        try{
            // Query untuk konten yang belum ada detail / isinya alias KONTEN BARU
            $konten_baru = DB::table('konten')
            ->leftJoin('konten_detail', 'konten.id', '=', 'konten_detail.id_konten')
            ->where('id_konten','=',null)
            ->select('konten.id as id_konten','konten.nama_konten')
            ->get();

            $konten_detail_sementara = DB::table('konten_detail')
            ->where('sementara','=','1')
            ->get();

            DB::commit();
            return view('konten_detail.create',[
                'konten_baru' => $konten_baru,
                'konten_detail_sementara' => $konten_detail_sementara
            ]);
        }catch(\Throwable $e){
            DB::rollback();
            throw $e;
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'objek' => 'required', // => parameter ketiga adalah nama table
        ],[
            'required' => 'Masukan nama objek terlebih dahulu.',
        ]);

        if($validator->fails()){ // => jika validator gagal
            Alert::error('Masalah!', $validator->messages()->all()[0]);
            return back();
        }else{ // => jika validator berhasil
            DB::beginTransaction();
            try{
                // Hitung isi row pada temporary table
                $count_temporary = DB::table('konten_detail')->where('sementara','=','1')->count();
                
                if($count_temporary > 0){
                    DB::table('konten_detail')
                    ->where('sementara','=','1')
                    ->update([
                        'id_konten' => $request->objek,
                        'sementara' => 0
                    ]);
                    DB::commit();
                    Alert::success('Berhasil!', 'Isi detail konten berhasil di tambahkan');
                    return redirect()->route('home');
                }else{
                    Alert::error('Masalah!', 'Isi detail konten belum di tambahkan');
                    return back();
                }
            }catch(\Throwable $e){
                DB::rollback();
                throw $e;
            }
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        DB::beginTransaction();
        try{
            $konten_detail = DB::table('konten_detail')->where('id_konten',$id)->get();
            
            DB::commit();
            return view('konten_detail.edit',[
                'id_konten' => $id,
                'konten_detail' => $konten_detail
            ]);
        }catch(\Throwable $e){
            DB::rollback();
            throw $e;
        }
    }

    public function update(Request $request, $id){

    }

    public function destroy($id){
        
    }
}
