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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
                
                    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
                        <h5 class="my-0 mr-md-auto font-weight-normal">Gestion pointage</h5>
                        <nav class="my-2 my-md-0 mr-md-3">
                          <a class="p-2 text-dark {{ (request()->is('list-pointages')) ? 'active' : '' }}" href="{{ url('list-pointages') }}">Pointages</a>
                          <a class="p-2 text-dark {{ (request()->is('list-agents')) ? 'active' : '' }}" href="{{ url('list-agents') }}">Agents</a>
                          <a class="p-2 text-dark {{ (request()->is('list-services')) ? 'active' : '' }}" href="{{ url('list-services') }}">Services</a>
                          <a class="p-2 text-dark {{ (request()->is('list-sous-dir')) ? 'active' : '' }}" href="{{ url('list-sous-dir') }}">Sous-directions</a>
                          <a class="p-2 text-dark {{ (request()->is('list-users')) ? 'active' : '' }}" href="{{ url('list-users') }}">Utilisateurs</a>
                        </nav>
                        <!-- Right Side Of Navbar -->
                        
                            <!-- Authentication Links -->
                            @guest
                                
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Se logger') }}</a>
                                
                                @if (Route::has('register'))
                                    
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('S\'enregistrer') }}</a>
                                   
                                @endif
                            @else
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                            @endguest
                        
                  </div>           

        <main class="py-4">
            @yield('content')
        </main>

</body>
</html>
