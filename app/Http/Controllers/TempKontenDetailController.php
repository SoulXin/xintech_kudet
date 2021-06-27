<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Alert;
use stdClass;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class TempKontenDetailController extends Controller
{
    // Fungsi untuk menampilkan view per komponen
    public function create_judul($id,$id_konten,$edit){
        if($edit){
            $isi = DB::table('konten_detail')->where('id',$id)->first();
            return view('konten_detail.form.judul',[
                'id' => $id,
                'id_konten' => $id_konten,
                'edit' => $edit,
                'isi' => $isi->isi
            ]);
        }else{
            return view('konten_detail.form.judul',[
                'id' => $id,
                'id_konten' => $id_konten,
                'edit' => $edit,
                'isi' => ''
            ]);
        }
    }
    public function create_paragraf($id,$id_konten,$edit){
        if($edit){
            $isi = DB::table('konten_detail')->where('id',$id)->first();
            return view('konten_detail.form.paragraf',[
                'id' => $id,
                'id_konten' => $id_konten,
                'edit' => $edit,
                'isi' => $isi->isi
            ]);
        }else{
            return view('konten_detail.form.paragraf',[
                'id' => $id,
                'id_konten' => $id_konten,
                'edit' => $edit,
                'isi' => ''
            ]);
        }
    }
    public function create_gambar($id,$id_konten,$edit){
        if($edit){
            $isi = DB::table('konten_detail')->where('id',$id)->first();
            return view('konten_detail.form.gambar',[
                'id' => $id,
                'id_konten' => $id_konten,
                'edit' => $edit,
                'isi' => $isi->isi
            ]);
        }else{
            return view('konten_detail.form.gambar',[
                'id' => $id,
                'id_konten' => $id_konten,
                'edit' => $edit,
                'isi' => ''
            ]);
        }
    }
    public function create_vidio($id,$id_konten,$edit){
        if($edit){
            $isi = DB::table('konten_detail')->where('id',$id)->first();
            return view('konten_detail.form.vidio',[
                'id' => $id,
                'id_konten' => $id_konten,
                'edit' => $edit,
                'isi' => $isi->isi
            ]);
        }else{
            return view('konten_detail.form.vidio',[
                'id' => $id,
                'id_konten' => $id_konten,
                'edit' => $edit,
                'isi' => ''
            ]);
        }
    }
    // Fungsi untuk simpan isi konten pada setiap komponen yang di panggil (judul ,paragraf, gambar, vidio)
    public function detail_store(Request $request,$jenis,$id_konten){
        $validator = Validator::make($request->all(),[
            'isi' => 'required|min:3|unique:konten_detail', // => parameter ketiga adalah nama table
        ],[
            'unique' => 'Isi konten ":input" tidak bisa digunakan.', // => :input adalah request inputan dari frontend
        ]);

        if($validator->fails()){ // => jika validator gagal
            Alert::error('Masalah!', $validator->messages()->all()[0]);
            return back();
        }else{ // => jika validator berhasil
            DB::beginTransaction();
            try{
                if($jenis != '2'){
                    DB::table('konten_detail')->insert([
                        'id_konten' => $id_konten ? $id_konten : null,
                        'jenis' => $jenis,
                        'isi' => $request->isi,
                        'sementara' => $id_konten > 0 ? 0 : 1
                    ]);
                }else{
                    $filename = Request()->file('isi')->getClientOriginalName();
                    $gambar = Image::make(Request()->file('isi'))->resize(300,200)->save('gambar/detail/'. time().'_' .$filename);

                    DB::table('konten_detail')->insert([
                        'id_konten' => $id_konten ? $id_konten : null,
                        'jenis' => $jenis,
                        'isi' => $gambar->basename,
                        'sementara' => $id_konten > 0 ? 0 : 1
                    ]);
                }

                DB::commit();
                Alert::success('Berhasil!', 'Isi konten berhasil di tambahkan');

                if($id_konten){
                    return redirect('admin/xin/konten_detail/'.$id_konten.'/edit');
                }else{
                    return redirect()->route('konten_detail.create');
                }
            }catch(\Throwable $e){
                DB::rollback();
                throw $e;
            }
        }
    }

    public function detail_update(Request $request, $id, $jenis){
        DB::beginTransaction();
        try{
            $id_konten = DB::table('konten_detail')->where('id',$id)->select('id_konten')->first();
            if($jenis != '2'){
                DB::table('konten_detail')
                ->where('id',$id)
                ->update([
                    'isi' => $request->isi
                ]);
            }else{
                // Hapus gambar, jika yang dihapus merupakan komponen gambar
                $check_gambar = DB::table('konten_detail')->where('id',$id)->select('isi')->first();
                $path = public_path()."/gambar/detail/".$check_gambar->isi;
                if(is_file($path)){
                    unlink($path);
                }

                $filename = Request()->file('isi')->getClientOriginalName();
                $gambar = Image::make(Request()->file('isi'))->resize(300,200)->save('gambar/detail/'. time().'_' .$filename);  

                DB::table('konten_detail')
                ->where('id',$id)
                ->update([
                    'isi' => $gambar->basename
                ]);
            }
            
            DB::commit();
            Alert::success('Berhasil!', 'Isi konten berhasil di update');
            if($id_konten->id_konten){
                return redirect('admin/xin/konten_detail/'.$id_konten->id_konten.'/edit');
            }else{
                return redirect('konten_detail/create');
            }
        }catch(\Throwable $e){
            DB::rollback();
            throw $e;
        }
    }

    // Fungsi untuk hapus isi konten pada komponen yang dituju (judul ,paragraf, gambar, vidio)
    public function detail_destroy($id,$jenis){
        DB::beginTransaction();
        try{
            // Hapus gambar, jika yang dihapus merupakan komponen gambar
            $check_gambar = DB::table('konten_detail')->where('id',$id)->select('isi')->first();
            $path = public_path()."/gambar/detail/".$check_gambar->isi;
            if(is_file($path)){
                unlink($path);
            }
            
            DB::table('konten_detail')->where('id',$id)->delete();
            DB::commit();
            Alert::success('Berhasil!', 'Isi konten berhasil di hapuskan');
            return redirect()->back();
        }catch(\Throwable $e){
            DB::rollback();
            throw $e;
        }
    }

    public function home(){
        DB::beginTransaction();
            try{
                $check_gambar = DB::table('konten_detail')->where('sementara','=','1')->select('isi')->get();
                for($a = 0 ; $a < count($check_gambar); $a++){
                    $path = public_path()."/gambar/detail/".$check_gambar[$a]->isi;
                    if(is_file($path)){
                        unlink($path);
                    }
                }
                DB::table('konten_detail')->where('sementara','=','1')->delete();
                DB::commit();
                return redirect()->route('home');
            }catch(\Throwable $e){
                DB::rollback();
                throw $e;
            }

    }
}