@extends('layouts.app')

@section('content')
<div class="col-start-4 col-end-10 border rounded">
    <div class="col-span-12 mt-2 p-5 border-b-2 text-center relative">
        <a class="bg-gray-400 p-2 rounded absolute top-3 left-5" href = "{{route('home')}}">
            <button>Kembali</button>
        </a>
        <h1 class="text-2xl">Tambah Konten Baru</h1>
    </div>

    <form class="col-span-12 grid grid-cols-12 gap-4 p-5" method="POST" action="{{route('konten.store')}}" enctype="multipart/form-data">
        @csrf
        <!-- Nama Konten -->
        <div class="col-span-12 grid grid-cols-12 gap-4 border p-2">
            <label class="col-span-12 border-b-2 p-1" for="nama_konten">{{ __('Nama Konten') }}</label>
            <input id="nama_konten" type="text" class="border rounded p-1 col-span-12 w-full @error('nama_konten') border-red-700 @enderror" name="nama_konten" value="{{ old('nama_konten') }}" required autocomplete="nama_konten" autofocus>
            @error('nama_konten')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Banner -->
        <div class="col-span-12 grid grid-cols-12 gap-4 border p-2">
            <label for="banner_konten" class="col-span-12 border-b-2 p-1">{{ __('Banner Konten') }}</label>
            <input id="banner_konten" type="file" class="border rounded p-1 col-span-12 w-full @error('banner_konten') border-red-700 @enderror" name="banner_konten" value="{{ old('banner_konten') }}" required autocomplete="banner_konten" autofocus>

            @error('banner_konten')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Status -->
        <div class="col-span-12 grid grid-cols-12 gap-4 border p-2">
            <label class="col-span-12 border-b-2 p-1">Status</label>
            <select class="col-span-12 border p-2" aria-label="status" name="status">
                <option selected disabled>Pilih Status Konten</option>
                <option value="1">Informasi</option>
                <option value="2">Maintaince</option>
                <option value="3">Update</option>

                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </select>
        </div>

        <!-- Objek -->
        <div class="col-span-12 grid grid-cols-12 gap-4 border p-2">
            <label class="col-span-12 border-b-2 p-1">Nama Objek</label>
            <select class="col-span-12 border p-2" aria-label="objek" name="objek">
                <option selected disabled>Pilih Objek Konten</option>
                @foreach($objek as $list_objek)
                    <option value="{{$list_objek->id}}">{{$list_objek->nama_objek}}</option>
                @endforeach

                @error('objek')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </select>
        </div>

        <!-- Jenis -->
        <div class="col-span-12 grid grid-cols-12 gap-4 border p-2">
            <label class="col-span-12 border-b-2 p-1">Jenis Konten</label>
            <select class="col-span-12 border p-2" aria-label="jenis_konten" name="jenis_konten">
                <option selected disabled>Pilih Jenis Konten</option>
                <option value = "game_event">Game & Event</option>
                <option value = "hardware">Hardware</option>
                <option value = "cryptocurrency">Cryptocurrency</option>
                <option value = "entertainment">Entertainment</option>

                @error('jenis_konten')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </select>
        </div>


        <button type = "submit" class = "col-span-12 bg-green-400 p-2 rounded"> Tambah </button>
    </form>
</div>
@endsection