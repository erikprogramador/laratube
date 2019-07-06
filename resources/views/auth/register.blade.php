@extends('layouts.auth')

@section('content')
    <form action="{{ route('register') }}" method="POST" class="mx-auto my-20 py-8 px-12 w-2/6 border border-side-focus rounded-lg text-center">
        @csrf

        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Laratube" class="w-24 mx-auto mb-6">
        </a>

        <h1 class="text-text text-lg mb-2">Login</h1>

        <p class="text-text text-sm mb-6">Prosseguir com login no Laratube</p>

        <div class="w-full relative mb-8 text-left">
            <label class="absolute pin-l pin-t {{ $errors->has('name') ? 'text-main' : 'text-link' }} -mt-3 ml-3 bg-default px-1" for="name">Nome</label>
            <input type="text" name="name" id="name" placeholder="Nome" class="outline-none w-full py-3 px-2 border-2 {{ $errors->has('name') ? 'border-main focus:border-main' : 'border-side-focus focus:border-link' }} rounded" autofocus>

            @error('name')
                <span class="text-xs text-main font-semibold tracking-widest"><i class="mdi mdi-alert-circle mr-1"></i>{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full relative mb-8 text-left">
            <label class="absolute pin-l pin-t {{ $errors->has('email') ? 'text-main' : 'text-link' }} -mt-3 ml-3 bg-default px-1" for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="E-mail" class="outline-none w-full py-3 px-2 border-2 {{ $errors->has('email') ? 'border-main focus:border-main' : 'border-side-focus focus:border-link' }} rounded">

            @error('email')
                <span class="text-xs text-main font-semibold tracking-widest"><i class="mdi mdi-alert-circle mr-1"></i>{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full relative mb-8 text-left">
            <label class="absolute pin-l pin-t {{ $errors->has('password') ? 'text-main' : 'text-link' }} -mt-3 ml-3 bg-default px-1" for="password">Senha</label>
            <input type="password" name="password" id="password" placeholder="Senha" class="outline-none w-full py-3 px-2 border-2 border-side-focus focus:border-link  {{ $errors->has('password') ? 'border-main focus:border-main' : 'border-side-focus focus:border-link' }}rounded">

            @error('password')
                <span class="text-xs text-main font-semibold tracking-widest"><i class="mdi mdi-alert-circle mr-1"></i>{{ $message }}</span>
            @enderror
        </div>

        <div class="w-full relative mb-8 text-left">
            <label class="absolute pin-l pin-t text-link -mt-3 ml-3 bg-default px-1" for="password_confirmation">Confirmação de senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmação de senha" class="outline-none w-full py-3 px-2 border-2 border-side-focus focus:border-link rounded">
        </div>

        <div class="flex items-center justify-between mt-8">
            <a class="text-link text-sm font-hairline" href="{{ route('login') }}">Fazer login</a>

            <button class="text-default bg-link font-semibold tracking-wide text-sm px-6 py-2 rounded">Cadastrar</button>
        </div>
    </form>
@endsection
