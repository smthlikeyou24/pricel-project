@extends('layouts.main')

@section('title', Auth::user()->name. " | Pricel")


@section('content')

<div class='bg-[#FFF] lg:w-[32rem] lg:mx-auto py-5 rounded-lg'>
    <div class="flex justify-between">
        <button class="mx-5 border-4 rounded-lg p-2"><i data-feather="edit" onclick="toggleModal('profile')"></i></button>
        <button class="mx-5 border-4 rounded-lg p-2"><i data-feather="share-2" onclick="toggleModal('share')"></i></button>
    </div>
    <div class="flex justify-center">
        <button class="mr-1 "><i data-feather="edit" onclick="toggleModal('image')"></i></button>
        <div class="rounded-full overflow-hidden bg-white h-20 w-20 flex-shrink-0 mr-7 border-4">
            <img src="{{ asset('storage/profileImages/'. Auth::user()->image) }}" alt="" class='w-full h-full object-cover' />
        </div>
    </div>
    <div class='text-center'>

        <h1 class='mt-2 font-bold flex justify-center'>
            {{ Auth::user()->name }}
        </h1>
        
        <h1 class='mt-2 px-2'>
            {{ Auth::user()->description }}
        </h1>

        <div class="flex mt-2 mx-auto justify-center">
            <a href="https://wa.me/{{ Auth::user()->wa_number }}">
                <img src="{{ asset('/main/socialmedia/wa.svg') }}" class='w-10 h-10' alt="" />
            </a>
            <a href="https://www.instagram.com/{{ Auth::user()->ig_username }}">
                <img src="{{ asset('/main/socialmedia/instagram.svg') }}" class='w-10 h-10' alt="" />
            </a>
        </div>
        <button class="btn btn-warning mt-5" onclick="toggleModal('addlist')"><i class="mr-1" data-feather="plus" ></i>Add list</button>
        
    </div>
    <div class="ml-5 mt-2">
        @error('image')
            <h1 class="label-text text-red-500">Failed to edit image: {{ $message }}</h1>
        @enderror
        @error('name')
        <h1 class="label-text text-red-500">Failed to edit profile: {{ $message }}</h1>
        @enderror
        @error('description')
        <h1 class="label-text text-red-500">Failed to edit profile: {{ $message }}</h1>
        @enderror
        @error('wa_number')
        <h1 class="label-text text-red-500">Failed to edit profile: {{ $message }}</h1>
        @enderror
        @error('ig_username')
        <h1 class="label-text text-red-500">Failed to edit profile: {{ $message }}</h1>
        @enderror
        @error('product_name')
            <h1 class="label-text text-red-500">Failed to add: {{ $message }}</h1>
        @enderror
        @error('product_image')
            <h1 class="label-text text-red-500">Failed to add: {{ $message }}</h1>
        @enderror
        @error('product_description')
            <h1 class="label-text text-red-500">Failed to add: {{ $message }}</h1>
        @enderror
        @error('product_stock')
            <h1 class="label-text text-red-500">Failed to add: {{ $message }}</h1>
        @enderror
        @error('product_price')
            <h1 class="label-text text-red-500">Failed to add: {{ $message }}</h1>
        @enderror
    </div>

    <h1></h1>

    @foreach ($data as $datas => $row)
    <div class="rounded-lg py-2 mx-5 mt-5 bg-[#fff3e2ef] shadow-md flex">
        <div class="rounded-lg overflow-hidden bg-white h-20 w-20 ml-2 flex-shrink-0">
            <img src="{{ asset('storage/listImages/'. $row->product_image) }}" alt="" class='w-full h-full object-cover' />
        </div>
        <div class="px-2 my-auto flex-grow overflow-y-">
            <div class="flex justify-between">
                <h1 class="font-bold">{{ Str::limit($row->product_name, 15) }} </h1>
                <div class="dropdown dropdown-end">
                    <button class=""><i class="mr-1" data-feather="menu"></i></button>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box max-w-xs">
                        <li><a aria-disabled="true"><i data-feather="edit-2" ></i>Edit</a></li>
                        <li><a href="/delete/{{ Auth::user()->slug }}/{{ $row->id }}"><i data-feather="trash-2" ></i>Delete</a></li>
                    </ul>
                </div>
            </div>
            <h1 class="text-sm">Price: <label class="font-bold">@currency($row->product_price)</label></h1>
            <div class="flex justify-between text-sm">
                <label>Stock: <label class="font-bold">{{ $row->product_stock }}</label></label>
                <button class="underline me-2"><a href="/{{ Auth::user()->slug }}">See detail</a></button>
            </div>
        </div>
    </div>
    @endforeach

    

    <div class="mt-5 mx-5">
        <label for="" class="flex border-4 rounded-lg p-2">
            <i data-feather="edit" class="mr-3 "></i> Edit your profile
        </label>
        <label for="" class="flex mt-2 border-4 rounded-lg p-2">
            <i data-feather="share-2" class="mr-3"></i> Share your link
        </label>
        <label for="" class="flex mt-2 border-4 rounded-lg p-2">
            <i data-feather="edit-2" class="mr-3"></i> Edit your list (Added soon)
        </label>
        <label for="" class="flex mt-2 border-4 rounded-lg p-2">
            <i data-feather="trash-2" class="mr-3"></i> Delete your list
        </label>
    </div>
    

    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden" id="addlist">
        <div class="p-4 bg-white rounded-lg max-w-sm mx-auto px-4 mt-10">
            <h1 class="font-bold mb-2">Add list</h1>
            <form action="/addlist" method="POST" class="px-2" enctype="multipart/form-data">
            @csrf
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                    <span class="label-text">Product name</span>
                    </label>
                    <input type="text" placeholder="Type here" class="input input-bordered w-full h-10" name="product_name" />
                </div>
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                    <span class="label-text">Image</span>
                    </label>
                    <input type="file" class="file-input file-input-bordered file-input-warning w-full max-w-xs" name="product_image" />
                </div>
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                    <span class="label-text">Description</span>
                    </label>
                    <textarea placeholder="Description" class="textarea textarea-bordered textarea-md w-full max-w-xs" name="product_description" rows="2"></textarea>
                </div>
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                    <span class="label-text">Stock</span>
                    </label>
                    <input type="number" placeholder="Type here" class="input input-bordered w-full h-10" name="product_stock" min="0"/>
                </div>
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                      <span class="label-text">Price</span>
                    </label>
                    <label class="input-group">
                      <span>Rp.</span>
                      <input type="number" placeholder="15000" value="{{ Auth::user()->ig_username }}" class="input input-bordered w-full h-10" name="product_price" />
                    </label>
                </div>
                <button type="submit" class="bg-success flex text-white px-4 py-2 rounded-lg ml-auto mt-4"><i data-feather="arrow-right"></i></button>
                
            </form>
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-4" onclick="toggleModal('addlist')">Close</button>
            
        </div>
    </div>
    

<!-- Modal pertama -->
<div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden" id="profile">
    <div class="p-4 bg-white rounded-lg max-w-sm mx-auto px-4 mt-10">
        <h1 class="font-bold mb-2">Edit your profile</h1>
            <form action="/settingsProfile" method="POST" class="px-2">
            @csrf
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                    <span class="label-text">Custom Slug</span>
                    </label>
                    <input type="text" placeholder="Added soon" class="input input-bordered w-full h-10" name="" disabled />
                </div>
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                    <span class="label-text">Name</span>
                    </label>
                    <input type="text" placeholder="Type here" value="{{ Auth::user()->name }}" class="input input-bordered w-full h-10" name="name" />
                </div>
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                    <span class="label-text">Bio</span>
                    </label>
                    <textarea placeholder="Description" class="textarea textarea-bordered textarea-md w-full max-w-xs" name="description" rows="2">{{ Auth::user()->description }}</textarea>
                </div>
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                      <span class="label-text">WhatsApp number</span>
                    </label>
                    <label class="input-group">
                      <span>https://wa.me/</span>
                      <input type="number" placeholder="6282178274067" value="{{ Auth::user()->wa_number }}" class="input input-bordered w-full h-10" name="wa_number" />
                    </label>
                </div>
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                      <span class="label-text">Instagram username</span>
                    </label>
                    <label class="input-group">
                      <span>https://instagram.com/</span>
                      <input type="text" placeholder="smthlikeyou24" value="{{ Auth::user()->ig_username }}" class="input input-bordered w-full h-10" name="ig_username" />
                    </label>
                </div>
                <button type="submit" class="bg-success flex text-white px-4 py-2 rounded-lg ml-auto mt-4"><i data-feather="arrow-right"></i></button>
            </form>
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-4" onclick="toggleModal('profile')">Close</button>
    </div>
</div>

<!-- Modal kedua -->
<div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden" id="image">
    <div class="p-4 bg-white rounded-lg max-w-sm mx-auto px-4 mt-10">
        <form action="/settingsImage" method="POST" class="px-2" enctype="multipart/form-data">
            @csrf
                <div class="form-control w-full max-w-lg">
                    <label class="label">
                    <span class="label-text">Image</span>
                    </label>
                    <input type="file" class="file-input file-input-bordered file-input-warning w-full max-w-xs" name="image" />
                </div>
                <button type="submit" class="bg-success flex text-white px-4 py-2 rounded-lg ml-auto mt-4"><i data-feather="arrow-right"></i></button>
            </form>
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-4" onclick="toggleModal('image')">Close</button>
    </div>
</div>

<div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden" id="share">
    <div class="p-4 bg-white rounded-lg max-w-sm mx-auto px-4 mt-10">
        <h1 class="font-bold">Share your link</h1>
        <div class="mt-3 items-center mx-auto justify-center ml-5">
            <input type="text" placeholder="Type here" class="input input-bordered w-full" value="127.0.0.1:8000/{{ Auth::user()->slug }}" readonly />
            <p id="copyMessage" class="text-success mt-3"></p>
        </div>
            <button class="bg-success flex text-white px-4 py-2 rounded-lg ml-auto mt-4" onclick="copyText()"><i data-feather="copy" class="mr-2"></i> Copy</button>
            
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-4" onclick="toggleModal('share')">Close</button>
    </div>
</div>


@include('partials.footer')

</div>

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
    

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle("hidden");
    }
</script>

@endsection