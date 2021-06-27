@extends('layouts.app')

@section('content')
<div class="col-start-4 col-end-10 border rounded">
    <div class="col-span-12 mt-2 p-5 border-b-2 text-center relative">
        <a class="bg-gray-400 p-2 rounded absolute top-3 left-5" href = "{{route('home')}}">
            <button>Kembali</button>
        </a>
        <h1 class="text-2xl">List Konten</h1>
    </div>

    <div class="grid grid-cols-12 gap-4 px-2 my-2">
        @foreach($list_konten as $konten)
            <div class="col-span-12 grid grid-cols-12 gap-4 border relative">
                <img src="{{ url('gambar/banner/' . $konten->banner_konten)}}" class="col-span-4 px-0">
                <h3 class="my-3 col-span-8">{{$konten->nama_konten}}</h3>
                <p class="bg-blue-200 p-1 w-100 absolute">
                    @if($konten->status == 1)
                        Informasi
                    @elseif($konten->status == 2)
                        Maintaince
                    @else
                        Update
                    @endif
                </p>
                <div class="absolute bottom-2 right-2">
                    <a href = "{{ route('konten_detail.edit',$konten->id) }}">
                        <button class="bg-green-400 p-1 rounded" >Periksa Detail</button>
                    </a>
                    <a href = "{{ route('konten.edit',$konten->id) }}">
                        <button class="bg-green-400 p-1 rounded">Periksa Header</button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection