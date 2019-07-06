@extends('layouts.app')

@section('content')
    <section class="pb-6 border-b border-side-focus">
        <header class="mb-4">
            <h3 class="font-semibold text-base text-text">Ultimos videos</h3>
        </header>

        <div class="flex items-center flex-wrap -mx-4">
            @for ($i = 0; $i <= 10; $i++)
                <div class="w-56 mx-4 mb-6">
                    <a class="text-text" href="#">
                        <img src="https://unsplash.it/id/{{ $i * 100 }}/600/400" alt="Video" class="w-full h-32">

                        <h4 class="text-sm font-semibold my-2">Desafio: Voyage Turbo TOMISSIL X Audi A3 Ruiva</h4>
                    </a>

                    <a class="text-sm text-text" href="#">
                        <span>Auto Super</span>
                        <i class="mdi mdi-checkbox-marked-circle"></i>
                    </a>

                    <div class="text-xs text-text">
                        <span>8 mil visualizações</span>
                        <span>&bull;</span>
                        <span>29 minutos atrás</span>
                    </div>
                </div>
            @endfor
        </div>
    </section>

    <section class="pb-6 border-b border-side-focus mt-4">
        <header class="mb-4">
            <h3 class="font-semibold text-base text-text">Ultimos vistos</h3>
        </header>

        <div class="flex items-center flex-wrap -mx-4">
            @for ($i = 0; $i <= 10; $i++)
                <div class="w-56 mx-4 mb-6">
                    <a class="text-text" href="#">
                        <img src="https://unsplash.it/id/{{ $i * 100 }}/600/400" alt="Video" class="w-full h-32">

                        <h4 class="text-sm font-semibold my-2">Desafio: Voyage Turbo TOMISSIL X Audi A3 Ruiva</h4>
                    </a>

                    <a class="text-sm text-text" href="#">
                        <span>Auto Super</span>
                        <i class="mdi mdi-checkbox-marked-circle"></i>
                    </a>

                    <div class="text-xs text-text">
                        <span>8 mil visualizações</span>
                        <span>&bull;</span>
                        <span>29 minutos atrás</span>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
