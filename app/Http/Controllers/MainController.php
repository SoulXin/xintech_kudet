<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{
    // Halaman utama
    public function index(Request $request){
        $konten = DB::table('konten')
        ->join('konten_detail','konten.id','=','konten_detail.id_konten')
        ->join('objek','objek.id','=','konten.id_objek')
        ->select('konten.id','konten.nama_konten','konten.banner_konten','konten.status','konten.view','konten.created_at','objek.nama_objek')
        ->distinct()
        ->paginate(6);
        
        if ($request->ajax()) {
    		$view = view('client.konten.index',compact('konten'))->render();
            return response()->json(['html'=>$view]);
        }

    	return view('client.main',compact('konten'));
    }

    // Halaman detail
    public function detail(Request $request,$id){
        $check_ip = DB::table('konten_check')
        ->join('konten','konten_check.id_konten','=','konten.id')
        ->where([
            ['konten_check.ip_client',$request->ip()],
            ['konten.id',$id]
        ])
        ->first();
        
        DB::beginTransaction();
        try{
            if(!$check_ip){
                DB::table('konten_check')->insert([
                    'ip_client' => $request->ip(),
                    'id_konten' => $id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
    
                $total_view = DB::table('konten')
                ->where('id', $id)
                ->update([
                    'view' => 1
                ]);
                DB::commit();
             }
        }catch(\Throwable $e){
            DB::rollback();
            throw $e;
        }

        $konten = DB::table('konten')
        ->join('objek','objek.id','=','konten.id_objek')
        ->select('konten.id','konten.nama_konten','konten.banner_konten','konten.status','objek.nama_objek')
        ->inRandomOrder()
        ->limit(3)
        ->get();
        $konten_detail = DB::table('konten_detail')
        ->where('id_konten',$id)
        ->get();

        return view('client.konten_detail.index',[
            'konten' => $konten,
            'konten_detail' => $konten_detail
        ]);
    }

    // Fungsi Untuk Pencarian
    public function search(Request $request){
        $konten = DB::table('konten')
        ->join('konten_detail','konten.id','=','konten_detail.id_konten')
        ->join('objek','objek.id','=','konten.id_objek')
        ->where('nama_konten','LIKE','%'.$request->search.'%')
        ->orwhere('objek.nama_objek','LIKE','%'.$request->search.'%')
        ->select('konten.id','konten.nama_konten','konten.banner_konten','konten.status','konten.view','konten.created_at','objek.nama_objek')
        ->distinct()
        ->paginate(6);

        if ($request->ajax()) {
    		$view = view('client.konten.index',compact('konten'))->render();
            return response()->json(['html'=>$view]);
        }

        return view('client.main', compact('konten'));
    }

    // Menampilkan konten yang trending
    public function trending(Request $request){
        $trending = DB::table('konten')
        ->join('objek','objek.id','=','konten.id_objek')
        ->select('konten.id','konten.nama_konten','konten.banner_konten','konten.status','konten.view','objek.nama_objek')
        ->orderBy('view','DESC')
        ->limit(5)
        ->get();
        if ($request->ajax()) { // => tampilan desktop
            return response()->json(['trending'=>$trending]);
        }else{ // => tampilan mobile
            return view('client.trending.mobile.index',['trending' => $trending]);
        }
    }

    // Tampilan untuk halaman game dan event
    public function game_event(Request $request){
        $konten = DB::table('konten')
        ->join('konten_detail','konten.id','=','konten_detail.id_konten')
        ->join('objek','objek.id','=','konten.id_objek')
        ->where('konten.jenis_konten','=','game_event')
        ->select('konten.id','konten.nama_konten','konten.banner_konten','konten.status','konten.view','objek.nama_objek')
        ->distinct()
        ->paginate(6);

        if ($request->ajax()) {
    		$view = view('client.sub_menu.game_event',compact('konten'))->render();
            return response()->json(['html'=>$view]);
        }

    	return view('client.sub_menu.main.main_game_event',compact('konten'));
    }

    // Tampilan untuk halaman hardware
    public function hardware(Request $request){
        $konten = DB::table('konten')
        ->join('konten_detail','konten.id','=','konten_detail.id_konten')
        ->join('objek','objek.id','=','konten.id_objek')
        ->where('konten.jenis_konten','=','hardware')
        ->select('konten.id','konten.nama_konten','konten.banner_konten','konten.status','konten.view','objek.nama_objek')
        ->distinct()
        ->paginate(6);

        if ($request->ajax()) {
    		$view = view('client.sub_menu.hardware',compact('konten'))->render();
            return response()->json(['html'=>$view]);
        }

    	return view('client.sub_menu.main.main_hardware',compact('konten'));
    }

    // Tampilan untuk halaman entertaiment
    public function entertaiment(Request $request){
        $konten = DB::table('konten')
        ->join('konten_detail','konten.id','=','konten_detail.id_konten')
        ->join('objek','objek.id','=','konten.id_objek')
        ->where('konten.jenis_konten','=','entertaiment')
        ->select('konten.id','konten.nama_konten','konten.banner_konten','konten.status','konten.view','objek.nama_objek')
        ->distinct()
        ->paginate(6);

        if ($request->ajax()) {
    		$view = view('client.sub_menu.entertaiment',compact('konten'))->render();
            return response()->json(['html'=>$view]);
        }

    	return view('client.sub_menu.main.main_entertaiment',compact('konten'));
    }

    // Fungsi untuk memunculkan nama placeholder pada kolom pencarian
    public function welcome(Request $request){
        $search = DB::table('konten')
        ->join('objek','objek.id','=','konten.id_objek')
        ->select('objek.nama_objek')
        ->limit(5)
        ->inRandomOrder()
        ->first();
        if ($request->ajax()) {
            return response()->json($search);
        }
    }
}
