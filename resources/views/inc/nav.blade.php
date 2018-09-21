
    <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ request()->route()->named('spa') ? '#' : route('welcome') }}">
                {{ config('app.name', 'Pastry Shop') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ request()->route()->named('spa') ? '#' : route('index') }}">{{ __('Home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ request()->route()->named('spa') ? '#cart' : route('cart') }}">{{ __('Shopping Cart') }}</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

                @if (\Request::route()->getName() != 'spa')
                    @if (!session('logged'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product') }}">{{ __('Add Product') }}</a>
                        </li>

                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                {{ session()->get('logged') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('products')}}">
                                    {{__('Products')}}
                                </a>
                                <a class="dropdown-item" href="{{route('orders')}}">
                                    {{__('Orders')}}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    @endif

                @else
                        <li class="nav-item guest">
                            <a class="nav-link" href="#login">{{ __('Login') }}</a>
                        </li>

                        <li class="nav-item auth">
                            <a class="nav-link" href="#product">{{ __('Add Product') }}</a>
                        </li>

                        <li class="nav-item dropdown auth">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"></a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#products">
                                        {{__('Products')}}
                                </a>
                                <a class="dropdown-item" href="#orders">
                                    {{__('Orders')}}
                                </a>
                                <a class="dropdown-item" href="#logout">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                @endif

                </ul>
            </div>
        </div>
    </nav>
