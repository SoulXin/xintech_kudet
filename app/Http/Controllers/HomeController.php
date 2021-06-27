<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        DB::beginTransaction();
        try{
            $konten_baru = DB::table('konten')
            ->leftJoin('konten_detail', 'konten.id', '=', 'konten_detail.id_konten')
            ->where('id_konten','=',null)
            ->select('konten.id as id_konten','konten.nama_konten')
            ->get()
            ->count();

            DB::commit();
            return view('home',[
                'konten_baru' => $konten_baru
            ]);
        }catch(\Throwable $e){
            DB::rollback();
            throw $e;
        }
    }
}
