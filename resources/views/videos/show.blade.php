@extends('layouts.video')

@section('content')
    <div class="flex justify-between -mx-2 mb-10">
        <div class="mx-2 w-2/3 bg-default shadow">
            <div class="w-full">
                <video class="w-full" controls>
                    <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <h1 class="mt-2 mb-3 text-text font-semibold text-xl ml-2">{{ $video->title }}</h1>

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
