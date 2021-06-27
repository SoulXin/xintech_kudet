@foreach($konten as $isi_konten)
    <a href="{{ route('detail',['id'=>$isi_konten->id]) }}" class = "col-span-12 mb-10 grid grid-cols-12 gap-4 relative md:border">
        <div class="absolute left-1 top-1 bg-blue-300 p-1 rounded">
            <div class="grid grid-col-3 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 col-start-1 col-end-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                <span class="col-start-2 col-end-3">{{$isi_konten->view}}</span>
            </div>
        </div>
        <img class="h-56 w-full col-span-12 md:col-start-1 md:col-end-5 md:h-40 lg:h-24 xl:h-36" src="{{ url('gambar/banner/' . $isi_konten->banner_konten)}}"/>
        <div class=" ml-3 mb-2 mt-0 col-span-12 md:col-start-5 md:col-end-11">
            <p class="md:font-bold md:text-xl md:mt-3 lg:mt-1 lg:text-sm xl:text-xl"><span class="font-bold">{{ $isi_konten->nama_objek }}</span> - {{$isi_konten->nama_konten}} </p>
        </div>
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

@push('script')
    <script>
        if(window.screen.width > 300 && window.screen.width < 500){
            var page = 1;
            var limit = false;

            $(window).scroll(function() {
                if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    page++;
                    loadMoreData(page);
                }
            });


            function loadMoreData(page){
                if(!limit){ 
                    $.ajax({
                        url: '?page=' + page,
                        type: "get"
                    })
                    .done(function(data){
                        if(data.html == ""){
                            limit = true;
                            return;
                        }
                        $("#post-data-game_event").append(data.html);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError){
                        alert('Terjadi kesalahan pada server');
                    });
                }
            }
        }
    </script>
@endpush
