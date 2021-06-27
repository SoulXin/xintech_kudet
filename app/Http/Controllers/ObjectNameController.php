<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Alert;

class ObjectNameController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('objek.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_objek' => 'required|min:3|unique:objek', // => parameter ketiga adalah nama table
        ],[
            'unique' => 'Nama objek ":input" tidak bisa digunakan.', // => :input adalah request inputan dari frontend
        ]);
        if($validator->fails()){ // => jika validator gagal
            Alert::error('Masalah!', $validator->messages()->all()[0]);
            return back();
        }else{
            DB::beginTransaction();

            try{
                DB::table('objek')->insert([
                    'nama_objek' => $request->nama_objek,
                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
                DB::commit();
                Alert::success('Berhasil!', 'Nama objek berhasil di tambahkan');
                return redirect('home');
            }catch(\Throwable $e){
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
