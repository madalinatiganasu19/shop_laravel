
<script type="text/javascript">

        function getUrlVars() {
            var vars = {};
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

            for (i = 0; i < hashes.length; i++) {
                var hash = hashes[i].split('=');
                vars[hash[0]] = hash[1];
            }
            return vars;
        }

        $(document).ready(function () {

            $.ajax('/check',  {
                dataType: 'json',
                success: function (response) {

                if (response.success) {
                    $('#navbarDropdown').html(response.success);
                    $('.auth').show();
                    $('.guest').hide();
                } else {
                    $('.auth').hide();
                    $('.guest').show();
                }
            }
            });

            function renderList(products, location) {
                var html = [];

                $.each(products, function (key, product) {
                    html += [
                        '<tr>',
                            '<td>',
                                '<img class="img-thumbnail" src="{{\Illuminate\Support\Facades\Storage::url('images/')}}'+ product.image+'">',
                            '</td>',
                            '<td>&nbsp;&nbsp;&nbsp;</td>',
                            '<td>',
                                '<p class="lead">' + product.title + '</p>',
                                '<p>' + product.description + '</p>',
                                '<p class="lead"> {{ __('$') }}' + product.price + '</p>',
                            '</td>',
                            '<td>&nbsp;&nbsp;&nbsp;</td>'
                    ].join('');

                    if (location === '') {
                        html += [
                            '<td class="text-center">',
                                '<a href="#?id='+ product.id +'" class="btn btn-sm btn-dark">{{__('Add to Cart')}}</a>',
                            '</td>'
                        ].join('');
                    } else if (location === 'cart') {
                        html += [
                            '<td class="text-center">',
                                '<a href="#cart?id='+ product.id +'" class="btn btn-sm btn-dark">{{__('Remove from Cart')}}</a>',
                            '</td>'
                        ].join('');
                    } else if (location === 'products') {
                        html += [
                            '<td class="text-center">',
                                '<a href="#product?id='+ product.id +'" class="btn btn-sm btn-success my-1">{{__('Update')}}</a>',
                                '<a href="#products?id='+ product.id +'" class="btn btn-sm btn-danger my-1">{{__('Delete')}}</a>',
                            '</td>'
                        ].join('');
                    }

                    html += '</tr>';
                });

                return html;
            }
            function renderOrders(orders) {
                var html = [
                    '<tr class="bg-dark text-white text-center">',
                        '<th>',
                            '<p class="lead">{{__('NAME')}}</p>',
                        '</th>',
                        '<th>&nbsp;&nbsp;&nbsp;</th>',
                        '<th>',
                            '<p class="lead">{{__('EMAIL')}}</p>',
                        '</th>',
                        '<th>&nbsp;&nbsp;&nbsp;</th>',
                        '<th>',
                            '<p class="lead">{{__('TOTAL')}}</p>',
                        '</th>',
                        '<th></th>',
                        '<th></th>',
                    '</tr>'
                ].join('');

                $.each(orders, function (key, order) {
                    html += [
                        '<tr>',
                            '<td>',
                                '<p >' + order.name + '</p>',
                            '</td>',
                            '<td>&nbsp;&nbsp;&nbsp;</td>',
                            '<td>',
                                '<p>' + order.email + '</p>',
                            '</td>',
                            '<td>&nbsp;&nbsp;&nbsp;</td>',
                            '<td>',
                                '<p > {{ __("$") }}' + order.total + '</p>',
                            '</td>',
                            '<td>&nbsp;&nbsp;&nbsp;</td>',
                            '<td class="text-center">',
                                '<a href="#order?id='+ order.id +'" class="btn btn-sm btn-dark">{{__('View Order')}}</a>',
                            '</td>',
                        '</tr>'
                    ].join('');


                });

                return html;
            }
            function renderErrors(response) {
                var errors = response.responseJSON.errors;
                var error_list = [];

                for (var name in errors) {
                    error_list.push('<p>' + errors[name] + '</p>');
                }

                $('.alert').html(error_list.join(''));
            }

            //send email
            $('.checkout-form').submit(function(event) {
                event.preventDefault();

                var formData = $('.checkout-form').serialize();

                $.ajax('/cart',  {
                    dataType: 'json',
                    type: 'POST',
                    data: formData,

                    success: function (response) {
                    if (response.success) {
                        location.href = '#';

                        $('.name').val('');
                        $('.email').val('');
                        $('.comments').val('');
                    }
                },
                    error: function (response) {

                    renderErrors(response);
                    $('.alert').show();
                }
                });

            });
            //add or update product
            $('.add-product').submit(function(event) {
                event.preventDefault();

                var productData = new FormData(this);
                var id = getUrlVars().id;

                $.ajax('/product' + (id ? '?id='+id : ''),  {
                    dataType: 'json',
                    type: 'POST',
                    data: productData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                    location.href = '#products';
                },

                    error: function (response) {
                    renderErrors(response);
                    $('.alert').show();
                }
                });

            });
            //login
            $('.login-form').submit(function(event) {
                event.preventDefault();

                var loginData = $('.login-form').serialize();

                $.ajax('/login',  {
                    dataType: 'json',
                    type: 'POST',
                    data: loginData,
                    success: function (response) {
                    if (response.success) {
                        location.href = '#products';

                        $('.guest').hide();
                        $('#navbarDropdown').html(response.success);
                        $('.auth').show();

                        $('.email').val('');
                        $('.password').val('');
                    }
                },
                    error: function (response) {
                    renderErrors(response);
                    $('.alert').show();
                }
                });

            });

            //add csrf
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /**
             * URL hash change handler
             */
            window.onhashchange = function () {

                // First hide all the pages
                $('.page').hide();
                $('.alert').hide();

                switch (window.location.hash) {

                    case '#cart':
                        // Show the cart page
                        $('.cart').show();

                        // Load the cart products from the server
                        $.ajax('/cart', {
                            dataType: 'json',
                            success: function (response) {
                        // Render the products in the cart list
                        $('.cart .list').html(renderList(response, 'cart'));
                    }
                });

                break;

            case '#cart?id='+getUrlVars().id:
                        //remove product from cart
                        if (getUrlVars().id) {
                            $.ajax('/cart', {
                                data: {'id': getUrlVars().id},
                                dataType: 'json',
                                success: function (response) {
                                location.href = '#cart';
                            }
                            });
                        }
                        break;

                    case '#login':
                        // Show the login page
                        $('.login').show();

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
                },
                            error: function (response) {
                    location.href = '#login';
                }
                        });
                        break;

                    case '#products?id='+getUrlVars().id:
                        // Delete product
                        $.ajax('/products', {
                            dataType: 'json',
                            data: {'id': getUrlVars().id},
                            success: function (response) {
                    location.href = '#products';
                },
                            error: function (response) {
                    location.href = '#login';
                }
                        });
                        break;

                    case '#product':
                        // Show the product page
                        $('.product').show();

                        $.ajax('/product', {
                            success: function (response) {

                    $('.title').val('');
                    $('.description').val('');
                    $('.price').val('');
                    $('.image').val('');
                    $('.placeholder_image').html('')
                            },
                            error: function (response) {
                    location.href = '#login';
                }
                        });

                        //
                        break;

                    case '#product?id='+getUrlVars().id:
                        // Show the product page
                        $('.product').show();

                        // Load product details from the server and populate the form
                        $.ajax('/product', {
                            dataType: 'json',
                            data: {'id': getUrlVars().id},
                            success: function (response) {

                    $('.title').val(response.title);
                    $('.description').val(response.description);
                    $('.price').val(response.price);
                    $('.placeholder_image').html('<img class="img-thumbnail"  width="300rem" src="{{\Illuminate\Support\Facades\Storage::url('images/')}}'+ response.image+'">');

                            },
                            error: function (response) {
                    location.href = '#login';
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
                    $('.orders .list').html(renderOrders(response));
                },
                            error: function (response) {
                    location.href = '#login';
                }
                        });
                        break;

                    case '#order?id='+getUrlVars().id:
                        // Show the order page
                        $('.order').show();
                        // Load the order products from the server
                        $.ajax('/order', {
                            dataType: 'json',
                            data: {'id': getUrlVars().id},
                            success: function (response) {
                    // Render the products in the order list
                    $('.order .list').html(renderList(response, 'order'));
                },
                            error: function (response) {
                    location.href = '#login';
                }
                        });
                        break;

                    case '#logout':
                        //logout
                        $.ajax('/logout' ,  {
                            dataType: 'json',
                            success: function (response) {
                    location.href = '#';

                    $('.auth').hide();
                    $('.guest').show();
                },
                            error: function (response) {
                    location.href = '#login';
                }
                        });
                        break;

                    default:
                        // If all else fails, always default to index
                        // Show the index page
                        $('.index').show();
                        var id = getUrlVars().id;

                        if (id) {
                            $.ajax('/index' ,{
                                data: {'id': id},
                                dataType: 'json',
                                success: function (response) {
                                location.href = '#';
                            }
                            });

                        } else {
                            // Load the index products from the servers
                            $.ajax('/index', {
                                dataType: 'json',
                                success: function (response) {
                                // Render the products in the index list
                                $('.index .list').html(renderList(response, ''));
                            }
                            });
                        }
                        break;
                }
            };

            window.onhashchange();
        });
    </script>
