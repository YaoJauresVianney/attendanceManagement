<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Gestion pointage | @yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/pricing/">
    <link rel="shortcut icon" href="{{ asset('img/logo.jpg') }}" type="image/jpg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/css/select2.min.css" rel="stylesheet" />
    
    <!-- Bootstrap core CSS -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      
      .active {
        color: #007bff !important;
        font-size: 30px;
        transition: .3s
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
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
                                    <a id="" class="nav-link" href="#" role="button">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div>
                                        <a class="btn btn-outline-warning" href="{{ route('logout') }}"
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

<div style="margin: 10px; min-heigth: 600px;">
      @yield('content')
</div>
  
<footer class="pt-4 my-md-5 pt-md-5 border-top">
  <div class="row">
    <div class="col-md-12 text-center">
      <img class="mb-2" src="{{ asset('img/logo.jpg') }}" alt="" width="24" height="24">
      <small class="d-block mb-3 text-muted">DITT 2019&copy;</small>
      <span class="float-right text-muted">{{ date('Y-m-d H:i') }}</span>
    </div>
  </div>
</footer>

</body>
</html>
