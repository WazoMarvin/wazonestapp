<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/watch.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar pl-5 pr-6 fixed-top navbar-expand-lg navbar-dark bg-primary">
              <a @click.prevent="showHideSideBar" class="navbar-brand py-0 text-white" href="#!"> <span class="">&#9776;</span> 
              &nbsp; Wazonest App
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            
              <div class="collapse navbar-collapse " id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                  {{-- <input class="form-control" type="text"> --}}
                </ul>
                <div class="d-flex text-white">
                  <div class="">
                    <img width="40" height="40" class="rounded-circle" src="{{asset('img/profile.jpg')}}" alt="" srcset="">
                  </div>
                  <div class="px-2">  
                    <p class="my-0 mb--2">{{auth()->user()->name}}</p> 
                    <small class="my-0">{{auth()->user()->user_role}}</small>
                  </div>
                </div>
              </div>
          </nav>

        <main class="py-4">
          <div id="mySidenav" class="sidenav pt-6">
              <a class="{{isLinkActive(['home'])}}" href="/home"><span class=" fa fa-users"></span> Customers</a>
              <a class="{{isLinkActive(['users'])}}" href="/users"> <span class="fa fa-user"></span> Users</a>
              <a onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"  href="#"> <span class="fa fa-sign-out"></span> 
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                LogOut</a>
          </div>
          <div class="pt-6" id="main">
            <div class="px-4">
              @yield('content')
            </div>
          </div>
        </main>
    </div>


</body>
</html>
