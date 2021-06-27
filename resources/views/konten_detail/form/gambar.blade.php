@extends('layouts.app')

@section('content')

<div class="col-start-4 col-end-10 border rounded">
    <div class="col-span-12 mt-2 p-5 border-b-2 text-center relative">
        <a class="bg-gray-400 p-2 rounded absolute top-3 left-5" href = "{{route('konten_detail.create')}}">
            <button>Kembali</button>
        </a>
        <h1 class="text-2xl">Tambah Konten Baru</h1>
    </div>
    <form class="col-span-12 grid grid-cols-12 gap-4 p-5" method="POST" action="{{ $edit ? route('detail_update',['id' => $id, 'jenis' => 2]) : route('detail_content_store',['jenis' => 2,'id_konten' => $id_konten])}}" enctype="multipart/form-data">
        @csrf
        @if($edit)
            {{ method_field('PUT') }}
        @endif
        <div class="col-span-12 grid grid-cols-12 gap-4 border p-2">
            <label for="isi" class="col-span-12 border-b-2 p-1">{{ __('Masukan Gambar') }}</label>
            <input id="isi" type="file" class="border rounded p-1 col-span-12 w-full @error('isi') border-red-700 @enderror" name="isi" value="{{ $isi }}" required autocomplete="isi" autofocus>

            @error('isi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>                         
        <button type = "submit" class = "col-span-12 bg-green-400 p-2 rounded"> {{ $edit ? 'Ubah' : 'Tambah' }} </button>
    </form>
</div>
@endsection