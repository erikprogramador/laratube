<div class="py-8 px-4">
    <h3>{{ $video->comments->count() }} comentários</h3>

    <form action="" class="flex mt-2 mb-6">
        <img src="https://unsplash.it/50/50" alt="Logo canal" class="w-12 h-12 rounded-full mr-4">

        <div class="flex-1">
            <textarea class="outline-none w-full border-b-2 border-side focus:border-link h-24 resize-none" name="body" id="body" placeholder="Adicionar um comentário publico"></textarea>

            <div class="text-right mt-1">
                <button class="bg-side uppercase font-semibold text-sm py-2 px-6 text-text rounded">Cancelar</button>
                <button class="bg-main uppercase font-semibold text-sm py-2 px-6 text-default rounded">Comentar</button>
            </div>
        </div>
    </form>

    <ul class="list-reset w-full">
        @foreach($video->comments as $comment)
            <li class="flex py-4">
                <img src="https://unsplash.it/50/50" alt="Logo canal" class="w-12 h-12 rounded-full mr-4">

                <div>
                    <div class="flex items-center mb-2">
                        <h6 class="text-text font-semibold mr-2">{{ $comment->owner->name }}</h6>
                        <small class="text-icon">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>

                    <div class="text-sm text-text leading-relaxed">
                        {!! nl2br($comment->body) !!}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
