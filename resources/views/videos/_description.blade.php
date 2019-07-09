<div class="border-b border-side-focus py-4 px-2">
    <header class="flex items-center justify-between">
        <a class="inline-flex items-center" href="#">
            <img src="https://unsplash.it/50/50" alt="Logo canal" class="w-12 h-12 rounded-full mr-4">

            <div class="">
                <h5 class="text-text font-semibold text-base mb-0 leading-none">{{ $video->channel->name }}</h5>
                <small class="text-icon text-xs leading-none">Publicado em {{ $video->created_at->format('d') }} de {{ $video->created_at->format('M') }} de {{ $video->created_at->format('Y') }}</small>
            </div>
        </a>

        <div class="flex items-center">
            <subscribe
                :channel="{{ $video->channel }}"
                subscriptions="{{ $video->channel->subscriptions->count() }}"
                data-subscribed="{{ $video->channel->isSubscribed(auth()->user() ?? new \App\User()) }}"></subscribe>

{{--
            <form action="#">
                <button class="py-2 px-4 text-text"><i class="mdi mdi-bell-outline text-lg"></i></button>
            </form> --}}
        </div>
    </header>

    <div class="ml-16 py-6 text-text text-sm leading-relaxed">
        {!! nl2br($video->description) !!}
    </div>

    <div class="ml-16">
        @foreach ($video->tags as $tag)
            <a href="#" class="bg-side text-text py-1 px-3 rounded text-xs">{{ $tag->name }}</a>
        @endforeach
    </div>
</div>
