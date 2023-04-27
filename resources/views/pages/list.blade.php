@extends('layouts.main')

@section('title', Auth::user()->name. " | Pricel")

@section('content')

<div class='bg-[#FFF] lg:w-[32rem] lg:mx-auto py-5 rounded-lg shadow-lg'>
    <button class="mx-5 border-4 rounded-lg p-2"><i class="mr-auto" data-feather="share-2" onclick="toggleModal('share')"></i></button>
    <div class="flex justify-center">
        <div class="rounded-full overflow-hidden bg-white h-20 w-20 flex-shrink-0 border-4">
            <img src="{{ asset('storage/profileImages/'. Auth::user()->image) }}" alt="" class='w-full h-full object-cover' />
        </div>
    </div>
    <div class='text-center'>
        <h1 class='mt-2 font-bold'>{{ $data->name }}</h1>
        <h1 class='mt-2 px-2'>{{ $data->description }}</h1>
        <div class="flex mt-2 mx-auto justify-center">
            <a href="https://wa.me/{{ $data->wa_number }}"><img src="{{ asset('/main/socialmedia/wa.svg') }}" class='w-10 h-10' alt="" /></a>
            <a href="https://instagram.com/{{ $data->ig_username }}"><img src="{{ asset('/main/socialmedia/instagram.svg') }}" class='w-10 h-10' alt="" /></a>
        </div>
    </div>

    @foreach ($data_list as $item => $row)
        <div class="rounded-lg py-2 mx-5 mt-5 bg-[#fff3e2ef] shadow-md flex">
            <div class="rounded-lg overflow-hidden bg-white h-20 w-20 ml-2 flex-shrink-0">
                <img src="{{ asset('storage/listImages/'. $row->product_image) }}" alt="" class='w-full h-full object-cover' />
            </div>
            <div class="px-2 my-auto flex-grow overflow-y-">
                <h1 class="font-bold">{{ Str::limit($row->product_name, 15) }}</h1>
                <h1>Price: <label class="font-bold">@currency($row->product_price)</label></h1>
                <div class="flex justify-between">
                    <label>Stock: <label class="font-bold">{{ $row->product_stock }}</label></label>
                    <button class="underline me-2" onclick="toggleModal({{ $row->id }})">See detail</button>
                </div>
            </div>
        </div>

        <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden" id="{{ $row->id }}">
            <div class="p-4 bg-white rounded-lg max-w-sm mx-auto px-4 mt-10 overflow-y-auto" style="max-height: 80vh;">
                <div class="flex justify-between">
                    <h1 class="font-bold mb-2">Detail product</h1>
                    <button class="bg-red-500 text-white px-2 py-2 rounded-lg" onclick="toggleModal('{{ $row->id }}')"><i data-feather="x"></i></button>
                </div>
                <div class="px-2 mt-2">
                    <div class="rounded-lg overflow-hidden bg-white h-80 w-80 ml-2 flex-shrink-0 border-4 shadow-md">
                        <img src="{{ asset('storage/listImages/'. $row->product_image) }}" alt="" class='w-full h-full object-cover' />
                    </div>
                    <h1 class="font-bold ml-3 mt-2 text-xl">{{ $row->product_name }}</h1>
                    <h1 class="ml-3 mt-1 text-sm">Price: <label class="font-bold">@currency($row->product_price)</label></h1>
                    <h1 class="ml-3 mt-1 text-sm">Stock: <label class="font-bold">{{ $row->product_stock }}</label></h1>
                    <h1 class="ml-3 mt-1 text-sm">Description: <label class="font-bold">{{ $row->product_description }}</label></h1>
                </div>
                
            </div>
        </div>
        
          
    @endforeach

    <div class="mt-5 mx-5">
        <label for="" class="flex mt-2 border-4 rounded-lg p-2">
            <i data-feather="share-2" class="mr-3"></i>Share the link
        </label>
    </div>

    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden" id="share">
        <div class="p-4 bg-white rounded-lg max-w-sm mx-auto px-4 mt-10">
            <h1 class="font-bold">Share the link</h1>
            <div class="mt-3 items-center mx-auto justify-center ml-5">
                <input type="text" placeholder="Type here" class="input input-bordered w-full" value="127.0.0.1:8000/{{ Auth::user()->slug }}" readonly />
                <p id="copyMessage" class="text-success mt-3"></p>
            </div>
                <button class="bg-success flex text-white px-4 py-2 rounded-lg ml-auto mt-4" onclick="copyText()"><i data-feather="copy" class="mr-2"></i>Copy</button>
                
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-4" onclick="toggleModal('share')">Close</button>
        </div>
    </div>

    @include('partials.footer')
</div>
    
    
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle("hidden");
    }
</script>

<script>
    function copyText() {
      var copyText = document.querySelector("#share input");
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      document.execCommand("copy");
      
      var copyMessage = document.querySelector("#copyMessage");
      copyMessage.innerText = "Link copied: " + copyText.value;
    }
</script>

@endsection