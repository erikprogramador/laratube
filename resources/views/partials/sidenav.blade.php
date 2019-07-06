<div class="bg-side w-64 pt-16 h-screen overflow-y-auto">
    @foreach (config('laratube.menu.items') as $items)
        <ul class="py-2 border-b border-side-focus">
            @foreach ($items as $item)
                <li>
                    <a class="flex items-center w-full px-6 py-1 text-sm text-text {{ $loop->last ? 'font-semibold' : '' }} hover:bg-side-focus" href="{{ route($item['route']) }}">
                        <i class="mdi mdi-{{ $item['icon'] }} text-2xl mr-6 {{ $loop->last ? 'text-main' : 'text-icon' }}"></i>
                        <span>{{ $item['text'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endforeach

    <h4 class="mt-3 mb-2 ml-6 text-side-heading text-sm font-semibold uppercase">Inscrições</h4>

    <ul class="py-2 border-b border-side-focus">
        <li>
            <a class="flex items-center w-full px-6 py-2 text-sm text-text hover:bg-side-focus" href="#">
                <img src="https://unsplash.it/30/30" alt="Adam Wathan" class="w-8 h-8 mr-6 rounded-full">
                <span>Adam Wathan</span>
            </a>
        </li>
    </ul>
</div>
