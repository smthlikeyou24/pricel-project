@extends('layouts.auth')

@section('content')

<a class="normal-case text-xl lg:ml-5 justify-center flex mb-5" href="/"><img src="{{ asset('storage/public/pricel.png') }}" class="w-[100px] " alt=""></a>

<div class='bg-[#FFF] lg:mx-auto py-5 flex items-center rounded-lg'>
    <div class="mx-auto">
        <div class="flex justify-center">
            <img src="{{ asset('/socialmedia/logo.svg') }}" alt="" class='w-30 h-30 object-cover' />
        </div>
        <h5 class='mt-2 font-bold text-[2rem] text-center'>Log in</h5>
        <form action="/login" method="POST" class="px-5 mt-6">
            @csrf
            <div>
                <label for="email" class="block mb-2 text-sm font-medium">Your email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-[20rem] p-2.5" placeholder="name@company.com" required="">
            </div>
            <div>
                <label for="password" class="block mt-2 mb-2 text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-[20rem] p-2.5 "required="">
            </div>
            @if (Session::has('error'))
            <label class="block mt-2 text-sm text-red-500 font-medium">{{ session('error') }}</label>
            @endif
            <button type="submit" class="w-[20rem] bg-[#FFF3E2] mt-6 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Sign in</button>
        </form>
        <label for="email" class="block mb-2 text-sm font-medium px-5 mt-6">Don't have an account? <a href="/register"><u>Register</u></a></label>
    </div>
</div>


@endsection