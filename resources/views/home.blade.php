@extends('layouts.app')

@section('content')
<div class="col-start-5 col-end-9">
    <div class="grid grid-cols-12 gap-4 row col-start-5 col-end-9 p-2 border rounded">
        <h1 class="col-span-12 border-b-2 p-1">Data Master</h1>
        <a href="{{route('konten.create')}}" class="col-span-6 mx-2 bg-blue-400 p-2 rounded text-center">
            <button class="btn btn-success w-100">Tambah Konten</button>
        </a>
        <a href="{{route('objek.create')}}" class="col-span-6 mx-2 bg-blue-400 p-2 rounded text-center">
            <button class="btn btn-success w-100">Tambah Object</button>
        </a>
    </div>
    <div class="grid grid-cols-12 gap-4 row col-start-5 col-end-9 p-2 border rounded">
        <h1 class="col-span-12 border-b-2 p-1">Data Detail</h1>
        <a href="{{route('konten_detail.create')}}" class="col-span-12 mx-2 bg-blue-400 p-2 rounded text-center">
            <button>Konten Detail
                @if($konten_baru)
                    <span class="bg-red-400">{{$konten_baru}}</span>
                @endif
            </button>
        </a>
    </div>
    <div class="grid grid-cols-12 gap-4 row col-start-5 col-end-9 p-2 border rounded">
        <h1 class="col-span-12 border-b-2 p-1">List</h1>
        <a href = "{{ route('konten.index') }}" class="col-span-6 mx-2 bg-blue-400 p-2 rounded text-center">
            <button>List Konten</button>
        </a>
        <a href = "" class="col-span-6 mx-2 bg-blue-400 p-2 rounded text-center">
            <button>List Objek</button>
        </a>
    </div>
</div>

@endsection
