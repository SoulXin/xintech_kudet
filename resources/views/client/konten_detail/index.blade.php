@extends('client.welcome')

@section('content')
    <div class=" border-b-2 p-2 mt-3 col-span-12 md:p-5 md:mt-0 lg:col-start-3 lg:col-end-11 xl:col-start-4 xl:col-end-10">
        @foreach($konten_detail as $detail)
            @if($detail->jenis == 0)
                <p class="text-2xl font-bold border-b-2 my-5">{{$detail->isi}}</p>
            @elseif($detail->jenis == 1)
                <p class="my-5">{{$detail->isi}}</p>
            @elseif($detail->jenis == 2)
                <img class="lazyload p-5" src="https://miro.medium.com/max/1158/1*9EBHIOzhE1XfMYoKz1JcsQ.gif" data-original="{{ url('gambar/detail/' . $detail->isi)}}" width="100%" height="100%">
            @else
                <iframe class="p-5" width="100%" height="450" src="{{$detail->isi}}" title="YouTube video player" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                        
            @endif
        @endforeach
    </div>

    <div class="rounded grid grid-cols-12 gap-4 col-span-12 md:p-10 lg:col-start-3 lg:col-end-11 lg:p-0 xl:col-start-4 xl:col-end-10">
        <h1 class="col-span-12 p-3 bg-gray-200">Artikel Lain nya</h1>
        @foreach($konten as $isi_konten)
            <a href="{{ route('detail',['id'=>$isi_konten->id]) }}" class = "col-span-12 lg:col-span-4 grid grid-cols-12 gap-4 mb-5 md:border relative">
                <img class="w-full col-span-12 md:h-40 md:col-start-1 md:col-end-5 lg:col-span-12 h-56" src="https://miro.medium.com/max/1158/1*9EBHIOzhE1XfMYoKz1JcsQ.gif"   data-original ="{{ url('gambar/banner/' . $isi_konten->banner_konten)}}"/>
                <p class="col-span-12 md:col-start-5 md:col-end-11 md:font-bold md:text-xl lg:col-span-12 lg:text-sm ml-3 mb-2 mt-0 "><span class="md:text-xl lg:text-sm font-bold">{{ $isi_konten->nama_objek }}</span> - {{$isi_konten->nama_konten}} </p>
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
    </div>
@endsection