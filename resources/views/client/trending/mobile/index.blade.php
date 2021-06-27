@extends('client.welcome')

@section('content')
    @foreach($trending as $isi_konten)
    <a href="{{ route('detail',['id'=>$isi_konten->id]) }}" class = "col-span-12 md:mx-5 lg:mx-0 lg:col-start-3 lg:col-end-11 xl:col-start-4 xl:col-end-11 mt-3 mb-3 grid grid-cols-12 gap-4 md:border relative">
        <div class="absolute left-1 top-1 bg-blue-300 p-1 rounded">
            <div class="grid grid-col-3 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 col-start-1 col-end-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                <span class="col-start-2 col-end-3">{{$isi_konten->view}}</span>
            </div>
        </div>
        <img class="col-span-12 h-56 w-full md:col-start-1 md:col-end-5" src="https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" data-original="{{ url('gambar/banner/' . $isi_konten->banner_konten)}}"/>
        <p class="col-span-12 text-sm ml-3 mb-2 mt-0 md:col-start-5 md:col-end-11 md:font-bold md:text-xl"><span class="text-sm font-bold">{{ $isi_konten->nama_objek }}</span> - {{$isi_konten->nama_konten}} </p>
        <span class="bg-blue-300 absolute right-1 top-1 p-1 rounded text-xs" style="{{ $isi_konten->status == 0 ? 'visibility:hidden;' : '' }}">
            @if($isi_konten->status == 1)
                Informasi
            @elseif($isi_konten->status == 2)
                Maintaince
            @else
                Update
            @endif
        </span>
    </a>
    @endforeach
@endsection