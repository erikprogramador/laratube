@extends('layouts.auth')

@section('content')
    <form action="{{ route('login') }}" method="POST" class="mx-auto my-20 py-8 px-12 w-2/6 border border-side-focus rounded-lg text-center">
        @csrf

        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Laratube" class="w-24 mx-auto mb-6">
        </a>

        <h1 class="text-text text-lg mb-2">Login</h1>

        <p class="text-text text-sm mb-6">Prosseguir com login no Laratube</p>

        <div class="w-full relative mb-8 text-left">
            <label class="absolute pin-l pin-t {{ $errors->has('email') ? 'text-main' : 'text-link' }} -mt-3 ml-3 bg-default px-1" for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="E-mail" class="outline-none w-full py-3 px-2 border-2 {{ $errors->has('email') ? 'border-main focus:border-main' : 'border-side-focus focus:border-link' }} rounded" autofocus>


            @error('email')
                <span class="text-xs text-main font-semibold tracking-widest"><i class="mdi mdi-alert-circle mr-1"></i>{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full relative mb-3">
            <label class="absolute pin-l pin-t text-link -mt-3 ml-3 bg-default px-1" for="password">Senha</label>
            <input type="password" name="password" id="password" placeholder="Senha" class="outline-none w-full py-3 px-2 border-2 border-side-focus focus:border-link rounded">
        </div>

        <input type="hidden" name="remember" id="remember" value="true">

        <div class="text-left">
            <a class="text-link font-semibold text-sm" href="#">Esqueceu sua senha?</a>
        </div>

        <div class="flex items-center justify-between mt-8">
            <a class="text-link text-sm font-hairline" href="{{ route('register') }}">Criar conta</a>

            <button class="text-default bg-link font-semibold tracking-wide text-sm px-6 py-2 rounded">Logar</button>
        </div>
    </form>
@endsection
