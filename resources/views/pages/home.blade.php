@extends('layouts.main')

@section('title', 'PriceList link in bio tool: Make price list in one link | Pricel')

@section('content')

    <div class="flex justify-center items-center mt-5 mb-5">
        <div class="text-center">
          <a href="/">
            <img class="mx-auto lg:mt-20" src="{{ asset('storage/public/pricel.png') }}" alt=""><h1 class="text-xs font-extrabold mt-1 text-center mx-auto">.BETA</h1>
          </a>
          <div class="mt-10 w-full mx-auto">
            <h1 class="text-3xl sm:text-5xl text-center font-semibold lg:w-[50%] lg:justify-center lg:mx-auto text-[#1B1A1E]">
              Various price lists in one link : Efficient, Effective, and Creative!
            </h1>
          </div>
          <button class="btn btn-success btn-xl mt-10 lg:px-10 lg:h-20"><a href="/login" class="text-xl">Try it for free now!</a></button>
            <div class="flex justify-center items-center">
                <div class="mt-10 border-4 w-[20rem] h-full shadow-xl">
                    <img src="{{ asset('storage/public/pricel-list.png') }}" class="w-[40rem]" alt="">
                </div>
            </div>

            <h1 class="mt-20 text-4xl font-bold">
              Features
                <h1 class="mt-5 text-2xl font-bold">
                  1. <u>Efficient: </u>
                  <h1 class="text-xl mt-3 bg-white rounded-lg py-2 px-2">Easy to use and make customers faster and more focused on viewing product lists quickly.</h1>
                </h1>
              
              <h1 class="mt-5 text-2xl font-bold">
                  2. <u>Effective: </u>
                  <h1 class="text-xl mt-3 bg-white rounded-lg py-2 px-2">Pricel is a free application, which does not cost anything.</h1>
              </h1>
              <h1 class="mt-5 text-2xl font-bold ">
                3. <u>Creative: </u>
                <h1 class="text-xl mt-3 bg-white rounded-lg py-2 px-2">Use images to attract customer attention and fill your social media.</h1>
              </h1>
            </h1>

            <h1 class="mt-20 text-4xl font-bold">
                Contact
                <h1 class="mt-5 text-xl">
                    Want to know more? or having problems? Please contact the following contacts:
                </h1>
                <button class="btn btn-warning px-10 h-20 mt-5"><a href="https://wa.me/6282178274067" class="text-xl flex"><i data-feather="phone" class="mr-2"></i>Contact me on WhatsApp</a></button>
            </h1>
            <div class="mt-20 text-xl bg-white py-2 rounded-lg w-[20rem] flex mx-auto justify-center">
                @include('partials.footer')
            </div>
            
        </div>
      </div>



@endsection