<header class="w-full shadow flex items-center bg-default fixed pin-t pin-x">
    <div class="w-64 py-3 px-6 flex items-center">
        <button class="text-text text-2xl mr-4"><i class="mdi mdi-menu"></i></button>

        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Youtube" class="w-20">
        </a>
    </div>

    <form action="#" class="flex-1">
        <div class="flex items-center w-7/12 ml-16">
            <input type="text" name="search" id="search" placeholder="Pesquisar" class="border border-side-focus px-2 h-8 rounded-l-sm w-full outline-none focus:border-link">

            <button class="bg-btn-search px-6 h-8 text-lg rounded-r-sm opacity-50 border border-side-focus"><i class="mdi mdi-magnify"></i></button>
        </div>
    </form>

    <nav class="flex items-center px-8">
        <a class="text-text ml-6 text-2xl" href="#"><i class="mdi mdi-video-plus"></i></a>
        <a class="text-text ml-6 text-2xl" href="#"><i class="mdi mdi-bell"></i></a>
        @auth
            <a class="inline-block rounded-full overflow-hidden w-10 h-10 ml-6" href="#">
                <img class="w-full" src="https://unsplash.it/40/40" alt="Usuario"/>
            </a>
        @else
            <a class="inline-flex items-center border border-link text-link pointer ml-6 px-3 py-1 uppercase font-medium rounded-sm" href="{{ route('login') }}">
                <i class="mdi mdi-account-circle text-2xl mr-2"></i>
                Fazer login
            </a>
        @endauth
    </nav>
</header>
