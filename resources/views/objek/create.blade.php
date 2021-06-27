@extends('layouts.app')

@section('content')
<div class="col-start-4 col-end-10 border rounded">
    <div class="col-span-12 mt-2 p-5 border-b-2 text-center relative">
        <a class="bg-gray-400 p-2 rounded absolute top-3 left-5" href = "{{route('home')}}">
            <button>Kembali</button>
        </a>
        <h1 class="text-2xl">Tambah Objek Baru</h1>
    </div>

    <form class="col-span-12 grid grid-cols-12 gap-4 p-5" method="POST" action="{{route('objek.store')}}">
        @csrf
        <!-- Nama Anime -->
        <div class="col-span-12 grid grid-cols-12 gap-4 border p-2">
            <label for="nama_objek" class="col-span-12 border-b-2 p-1">{{ __('Nama Objek') }}</label>
            <input id="nama_objek" type="text" class="border rounded p-1 col-span-12 w-full @error('nama_objek') border-red-700 @enderror" name="nama_objek" value="{{ old('nama_objek') }}" required autocomplete="nama_objek" autofocus>

            @error('nama_objek')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>                        
        <button type = "submit" class = "col-span-12 bg-green-400 p-2 rounded"> Tambah </button>
    </form>
</div>
@endsection