@extends('layouts.video')

@section('content')
    <div class="flex justify-between -mx-2 mb-10">
        <div class="mx-2 w-2/3 bg-default shadow">
            <div class="w-full">
                <img src="https://unsplash.it/1920/1080" alt="Example" class="w-full">
            </div>

            <h1 class="mt-2 mb-3 text-text font-semibold text-xl ml-2">ESTÁ CHEGANDO A SEMANA DEVOPS 2019!</h1>

            <div class="border-b border-side-focus flex items-center justify-between px-2">
                <span class="text-icon">615 visualizações</span>

                <div>
                    <button class="px-4 py-2 text-link border-b-2 inline-block text-sm"><i class="mdi mdi-thumb-up"></i> <span class="ml-2">75</span></button>
                    <button class="px-4 py-2 text-main border-b-2 inline-block text-sm"><i class="mdi mdi-thumb-down"></i> <span class="ml-2">12</span></button>
                </div>
            </div>

            @include('videos._description')

            @include('comments._comments')
        </div>

        <div class="mx-2 w-1/3 bg-default shadow">
            @include('videos._list')
        </div>
    </div>
@endsection
