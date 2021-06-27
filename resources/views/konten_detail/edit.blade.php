@extends('layouts.app')

@section('content')
<div class="col-start-3 col-end-11 border rounded">
    <div class="col-span-12 mt-2 p-5 border-b-2 text-center relative">
        <a class="bg-gray-400 p-2 rounded absolute top-3 left-5" href = "{{route('konten.index')}}">
            <button>Kembali</button>
        </a>
        <h1 class="text-2xl">Konten Detail</h1>
    </div>

    <div class = "col-span-12 grid grid-cols-12 gap-4 p-5">
        <a href = "{{route('detail_content_create_judul',['id' => 0, 'id_konten' => $id_konten, 'edit' => 0])}}" class = "col-span-3"> 
            <button type = "button" class = "bg-green-400 p-2 rounded w-full">Tambah Judul</button>
        </a>
        <a href = "{{route('detail_content_create_paragraf',['id' => 0, 'id_konten' => $id_konten, 'edit' => 0])}}" class = "col-span-3"> 
            <button type = "button" class = "bg-green-400 p-2 rounded w-full">Tambah Paragraf</button>
        </a>
        <a href = "{{route('detail_content_create_gambar',['id' => 0, 'id_konten' => $id_konten, 'edit' => 0])}}" class = "col-span-3"> 
            <button type = "button" class = "bg-green-400 p-2 rounded w-full">Tambah Gambar</button>
        </a>
        <a href = "{{route('detail_content_create_vidio',['id' => 0, 'id_konten' => $id_konten, 'edit' => 0])}}" class = "col-span-3"> 
            <button type = "button" class = "bg-green-400 p-2 rounded w-full">Tambah Vidio</button>
        </a>
    </div>

    <div class = "col-span-12 grid grid-cols-12 gap-4 p-5">
        @if($konten_detail)
            @foreach($konten_detail as $detail)
                @if($detail->jenis == '0') <!-- Judul -->
                <div class="col-span-12 grid grid-cols-12 gap-4 p-2 border rounded ">
                    <h1 class="text-2xl font-bold col-span-9">{{$detail->isi}}</h1>
                    <div class="grid grid-cols-12 gap-4 col-span-3">
                        <div class="col-span-6 w-full">
                            <a href = "{{ route('detail_content_create_judul',['id' => $detail->id, 'id_konten' => $detail->id_konten, 'edit' => 1]) }}">
                                <button class="bg-green-400 p-2 rounded w-full">Ubah</button>
                            </a>
                        </div>

                        <div class="col-span-6 w-full">
                            <form action = "{{route('detail_content_destroy',['id' => $detail->id,'jenis' => 0])}}" method = "POST" >
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type = "submit" class="bg-red-400 p-2 rounded w-full">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>

                @elseif($detail->jenis == '1') <!-- Paragraf -->
                <div class="col-span-12 grid grid-cols-12 gap-4 p-2 border rounded ">
                    <h1 class="col-span-9">{{$detail->isi}}</h1>
                    <div class="grid grid-cols-12 gap-4 col-span-3">
                        <div class="col-span-6 w-full">
                        <a href = "{{ route('detail_content_create_paragraf',['id' => $detail->id, 'id_konten' => $detail->id_konten, 'edit' => 1]) }}">
                                <button class="bg-green-400 p-2 rounded w-full">Ubah</button>
                            </a>
                        </div>

                        <div class="col-span-6 w-full">
                        <form action = "{{route('detail_content_destroy',['id' => $detail->id,'jenis' => 1])}}" method = "POST" >
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type = "submit" class="bg-red-400 p-2 rounded w-full">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>

                @elseif($detail->jenis == '2') <!-- Gambar -->
                <div class="col-span-12 grid grid-cols-12 gap-4 p-2 border rounded ">
                    <img src = "{{ url('/gambar/detail/' . $detail->isi) }}" class="col-span-9 w-full"/>
                    <div class="grid grid-cols-12 gap-4 col-span-3">
                        <div class="col-span-6 w-full">
                        <a href = "{{ route('detail_content_create_gambar',['id' => $detail->id, 'id_konten' => $detail->id_konten, 'edit' => 1]) }}">
                                <button class="bg-green-400 p-2 rounded w-full">Ubah</button>
                            </a>
                        </div>

                        <div class="col-span-6 w-full">
                        <form action = "{{route('detail_content_destroy',['id' => $detail->id,'jenis' => 2])}}" method = "POST" >
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type = "submit" class="bg-red-400 p-2 rounded w-full">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif($detail->jenis == '3') <!-- Vidio -->
                <div class="col-span-12 grid grid-cols-12 gap-4 p-2 border rounded ">
                    <div class="col-span-9">
                        <iframe width="100%" height="450" src="{{$detail->isi}}" title="YouTube video player" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                        
                    </div>
                    <div class="grid grid-cols-12 gap-4 col-span-3">
                        <div class="col-span-6 w-full">
                        <a href = "{{ route('detail_content_create_vidio',['id' => $detail->id, 'id_konten' => $detail->id_konten, 'edit' => 1]) }}">
                                <button class="bg-green-400 p-2 rounded w-full">Ubah</button>
                            </a>
                        </div>

                        <div class="col-span-6 w-full">
                        <form action = "{{route('detail_content_destroy',['id' => $detail->id,'jenis' => 3])}}" method = "POST" >
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type = "submit" class="bg-red-400 p-2 rounded w-full">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>


</div>
@endsection