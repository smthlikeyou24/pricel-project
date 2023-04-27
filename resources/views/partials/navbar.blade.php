<div class="navbar bg-base-100 ">
    <div class="flex-1">
      <a class="normal-case text-xl lg:ml-5 ml-2" href="/"><img src="{{ asset('storage/public/pricel.png') }}" class="w-[90px] " alt=""></a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1">
        @if (Auth::user())
          <li><a class="lg:mr-5 hover:underline" href="/{{ Auth::user()->slug }}">My Pricel</a></li>
        @endif

        @if (!Auth::user())
          <li><a class="lg:mr-5 hover:underline" href="/login">My Pricel</a></li>
        @endif

        <li><a class="lg:mr-5 hover:underline" href="/settings">Settings</a></li>

        @if (Auth::user())
          <li><a href="/logout" class="border btn-[#fff] lg:mr-5"><i data-feather="log-out"></i></a></li>
        @endif

        @if (!Auth::user())
        <li><a href="/logout" class="border btn-[#fff] lg:mr-5"><i data-feather="log-in"></i>Log in</a></li>
        @endif

      </ul>
    </div>
  </div>