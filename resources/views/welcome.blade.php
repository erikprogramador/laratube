@extends('layouts.app')

@section('content')
    <section class="pb-6 border-b border-side-focus">
        <header class="mb-4">
            <h3 class="font-semibold text-base text-text">Ultimos videos</h3>
        </header>

        <div class="flex items-center flex-wrap -mx-4">
            @for ($i = 0; $i <= 10; $i++)
                @include('videos._card')
            @endfor
        </div>
    </section>

    <section class="pb-6 border-b border-side-focus mt-4">
        <header class="mb-4">
            <h3 class="font-semibold text-base text-text">Ultimos vistos</h3>
        </header>

        <div class="flex items-center flex-wrap -mx-4">
            @for ($i = 0; $i <= 10; $i++)
                @include('videos._card')
            @endfor
        </div>
    </div>
@endsection
