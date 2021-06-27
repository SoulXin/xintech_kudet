@extends('layouts.app')

@section('content')
<div class="col-start-6 col-end-8 border rounded">
    <form class="col-span-12 grid grid-cols-12 gap-4 p-5" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="col-span-12 grid grid-cols-12 gap-4">
            <label class="col-span-12 border-b-2 p-1">{{ __('E-Mail Address') }}</label>
            <div class="col-span-12">
                <input id="email" type="email" class="col-span-12 w-full rounded border p-1" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-span-12 grid grid-cols-12 gap-4">
            <label class="col-span-12 border-b-2 p-1" for="password">{{ __('Password') }}</label>

            <div class="col-span-12">
                <input id="password" type="password" class="w-full rounded border p-1" name="password" required autocomplete="off">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="col-span-12 bg-green-400 p-2 rounded">
            {{ __('Login') }}
        </button>
    </form>
</div>
@endsection