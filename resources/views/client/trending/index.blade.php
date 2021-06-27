<div class="p-2" id="result_trending">
    <div class="loader"></div>
</div>

@push('css')
    <style>
        .loader,
        .loader:before,
        .loader:after {
        background: black;
        -webkit-animation: load1 1s infinite ease-in-out;
        animation: load1 1s infinite ease-in-out;
        width: 1em;
        height: 4em;
        }
        .loader {
        color: black;
        text-indent: -9999em;
        margin: 88px auto;
        position: relative;
        font-size: 11px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
        }
        .loader:before,
        .loader:after {
        position: absolute;
        top: 0;
        content: '';
        }
        .loader:before {
        left: -1.5em;
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
        }
        .loader:after {
        left: 1.5em;
        }
        @-webkit-keyframes load1 {
        0%,
        80%,
        100% {
            box-shadow: 0 0;
            height: 4em;
        }
        40% {
            box-shadow: 0 -2em;
            height: 5em;
        }
        }
        @keyframes load1 {
        0%,
        80%,
        100% {
            box-shadow: 0 0;
            height: 4em;
        }
        40% {
            box-shadow: 0 -2em;
            height: 5em;
        }
        }
    </style>
@endpush

@push('script')
    <script>
        $.ajax({
            type: 'GET',
            url: '{{ route("trending") }}',
            beforeSend: () => {
                $('.loader').show();
            },
            success: (data) => {
                var list_data = '';
                data.trending.forEach((list,index) => {
                    list_data += `<a href="/detail/${list.id}" class = "grid grid-cols-6 gap-1 mb-3 border">
                        <img class = "col-span-2 md:h-40 lg:h-12 xl:h-16" src = "{{ url('gambar/banner/')}}/${list.banner_konten}" width="100%"/>
                        <span class = "col-span-4 p-1 md:text-xl lg:text-sm">${list.nama_konten}</span>
                    </a>`;
                });
                $('#result_trending').html(list_data);
            },
            complete: () => {
                $('.loader').hide();
            },
            error: (error) => { 
                console.log(error);
            }
        });
    </script>
@endpush