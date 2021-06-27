@extends('client.welcome')

@section('content')
<!-- Main -->
<div class="col-span-12 lg:col-start-3 lg:col-end-8 lg:border lg:rounded lg:mt-5 xl:col-start-4 xl:col-end-9 px-0 mt-3 md:mt-0 md:p-5" id="post-data-game_event">
    @include('client.sub_menu.game_event')
    <div class="invisible md:visible text-center">
        {{ $konten->links('client.pagination.index') }}
    </div>
</div>

<!-- Side -->
<div class="invisible md:visible md:col-span-12 lg:col-start-8 lg:col-end-11 xl:col-start-9 xl:col-end-11 p-3">
    <p class="text-3xl border-b-2 mb-2">Trending</p>
    @include('client.trending.index')
</div>
@endsection