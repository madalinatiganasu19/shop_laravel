<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shop Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Load the jQuery JS library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Custom JS script -->
    <script type="text/javascript">
        function getUrlVars()
        {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                hash[1] = unescape(hash[1]);
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }

            return vars;
        }
        var urlVars = getUrlVars();

        $(document).ready(function () {

            function renderList(products, href) {
                html = [];

                $.each(products, function (key, product) {
                    html += [
                        '<tr>',
                        '<td><img class="img-thumbnail" src="{{\Illuminate\Support\Facades\Storage::url('images/')}}'+ product.image+'"></td>',
                        '<td>&nbsp;&nbsp;&nbsp;</td>',
                        '<td>',
                        '<p class="lead">' + product.title + '</p>',
                        '<p>' + product.description + '</p>',
                        '<p class="lead"> {{ __('$') }}' + product.price + '</p>',
                        '</td>',
                        '<td>&nbsp;&nbsp;&nbsp;</td>',
                        '<td class="custom-column"><a href="#'+href+'?id='+ product.id +'" class="btn btn-sm btn-dark">{{__('Add to Cart')}}</a></td>',
                        '</tr>'
                    ].join('');
                });

                return html;
            }

            function renderOrders(orders, href) {
                html = [
                    '<tr class="bg-dark text-white text-center">',
                    '<th><p class="lead">{{__('NAME')}}</p></th>',
                    '<th>&nbsp;&nbsp;&nbsp;</th>',
                    '<th><p class="lead">{{__('EMAIL')}}</p></th>',
                    '<th>&nbsp;&nbsp;&nbsp;</th>',
                    '<th><p class="lead">{{__('TOTAL')}}</p></th>',
                    '<th></th>',
                    '<th></th>',
                    '</tr>'
                ];

                $.each(orders, function (key, order) {
                    html += [
                        '<tr>',
                        '<td><p >' + order.name + '</p></td>',
                        '<td>&nbsp;&nbsp;&nbsp;</td>',
                        '<td><p>' + order.email + '</p></td>',
                        '<td>&nbsp;&nbsp;&nbsp;</td>',
                        '<td><p > {{ __("$") }}' + order.total + '</p></td>',
                        '<td>&nbsp;&nbsp;&nbsp;</td>',
                        '<td><a href="#'+href+'?id='+ order.id +'" class="btn btn-sm btn-dark">{{__('View Order')}}</a></td>',
                        '</tr>'
                    ].join('');
                });

                return html;
            }

            /**
             * URL hash change handler
             */
            window.onhashchange = function () {
                // First hide all the pages
                $('.page').hide();

                switch(window.location.hash) {

                    case '#cart':
                        // Show the cart page
                        $('.cart').show();
                        // Load the cart products from the server
                        $.ajax('/cart', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the cart list
                                $('.cart .list').html(renderList(response, 'cart'));
                                $('.custom-column').append('');
                            }
                        });
                        break;

                    case '#login':
                        // Show the login page
                        $('.login').show();
                        //
                        $.ajax('/login', {
                            dataType: 'json',
                            success: function (response) {
                                //
                            }

                        });

                        $( ".login-form" ).on( "submit", function( event ) {

                            event.preventDefault();

                            email = $('#email').val();
                            password = $('#password').val();

                            console.log(email + "\n" + password);

                        });

                        break;

                    case '#products':
                        // Show the products page
                        $('.products').show();
                        // Load the products products from the server
                        $.ajax('/products', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the products list
                                $('.products .list').html(renderList(response, 'products'));
                                $('.custom-column').append('');

                            }
                        });
                        break;

                    case '#orders':
                        // Show the orders page
                        $('.orders').show();
                        // Load the orders list from the server
                        $.ajax('/orders', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the orders in the orders list
                                $('.orders .list').html(renderOrders(response, 'orders'));
                            }
                        });
                        break;

                    case '#order':
                        // Show the order page
                        $('.order').show();
                        id = getUrlVars()["id"];
                        // Load the order products from the server
                        $.ajax('/order', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the order list
                                $('.order .list').html(renderList(response, 'order'));
                            }
                        });
                        break;

                    default:
                        // If all else fails, always default to index
                        // Show the index page
                        $('.index').show();

                        // Load the index products from the servers
                        $.ajax('/index', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the index list
                                $('.index .list').html(renderList(response, ''));
                                $('.custom-column').append('');
                            }
                        });
                        break;
                }
            };

            window.onhashchange();
        });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include("inc.nav")

        <main class=" container py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
