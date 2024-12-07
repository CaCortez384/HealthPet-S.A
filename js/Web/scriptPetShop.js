$(document).ready(function () {
    // AGREGANDO CLASE ACTIVE AL PRIMER ENLACE ====================
    $('.category_list .category_item[category="all"]').addClass('ct_item-active');

    // Función para obtener y mostrar productos filtrados
    function obtenerProductosFiltrados(categoria, precioMaximo) {
        console.log('Categoría:', categoria);   // Imprime la categoría seleccionada
        console.log('Precio máximo:', precioMaximo);  // Imprime el precio máximo


        $.ajax({
            url: '/filtrar-productos',
            method: 'GET',
            data: {
                categoria: categoria,
                precio: precioMaximo,
            },
            success: function (response) {
                $('.products-list').empty();

                if (!response.success) {
                    // Si no hay productos, mostrar el mensaje
                    $('.products-list').html(`
                        <div class="no-products">
                            <p>${response.message}</p>
                            <img src="/path-to-your-sad-face-image.png" alt="Sad Face" />
                        </div>
                    `);
                    return;
                }

                // Mostrar los productos si hay resultados
                response.productos.forEach(function (producto) {
                    const productHTML = `
                        <div class="product-item" category="${producto.id_categoria}" onclick="goToDetail(${producto.id})">
                            <img src="/storage/${producto.imagen}" alt="${producto.nombre}">
                            <div class="product-details">
                                <h4>${producto.nombre}</h4>
                                <p>Precio: $${producto.precio_de_venta}</p>
                                <p>Stock: ${producto.stock_unidades}</p>
                                ${producto.stock_unidades === 0
                            ? `
                                            <button class="add-to-cart add-to-cart-button" data-product-id="${producto.id}" data-product-name="${producto.nombre}" 
                                                onclick="event.stopPropagation();">Realizar pedido</button>
                                                    `
                            : `
                                            <button class="add-to-cart add-to-cart-button" data-product-id="${producto.id}" data-product-name="${producto.nombre}" 
                                                onclick="event.stopPropagation();">Agregar al carrito</button>
                                                    `
                        }
                            </div>
                        </div>
                    `;

                    $('.products-list').append(productHTML);
                });

                $(document).ready(function() {
                    function updateCartContent() {
                        $.ajax({
                            type: 'GET',
                            url: '/get-cart-content',
                            success: function(cartData) {
                                $('.carrito-slide .lista-productos').html(cartData.html);
                                $('.subtotal span:last-child').text('$' + number_format(cartData.subtotal, 0, ',', '.'));
                                $('.total span:last-child').text('$' + number_format(cartData.total, 0, ',', '.'));
                                $('.descuento span:last-child').text('$' + number_format(cartData.descuento, 0, ',', '.'));
                                bindCartButtons();
                                $('.carrito-slide').addClass('visible');
                            },
                            error: function(error) {
                                console.error('Error updating cart content:', error);
                            }
                        });
                    }
        
                    function number_format(number, decimals, dec_point, thousands_sep) {
                        number = (number + '').replace(',', '').replace(' ', '');
                        var n = !isFinite(+number) ? 0 : +number,
                            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                            sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
                            dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
                            s = '',
                            toFixedFix = function(n, prec) {
                                var k = Math.pow(10, prec);
                                return '' + Math.round(n * k) / k;
                            };
                        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                        if (s[0].length > 3) {
                            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                        }
                        if ((s[1] || '').length < prec) {
                            s[1] = s[1] || '';
                            s[1] += new Array(prec - s[1].length + 1).join('0');
                        }
                        return s.join(dec);
                    }
        
                    function bindCartButtons() {
                        // Función para incrementar la cantidad
                        $('.sumar').off('click').on('click', function() {
                            var productId = $(this).data('id');
                            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtener el token CSRF desde una meta tag

                            $.ajax({
                                type: 'POST',
                                url: '/update-cart',
                                data: {
                                    _token: csrfToken,
                                    id: productId,
                                    action: 'increase'
                                },
                                success: function(data) {
                                    updateCartContent();
                                },
                                error: function(error) {
                                    console.error('Error updating cart:', error);
                                }
                            });
                        });
        
                        // Función para decrementar la cantidad
                        $('.restar').off('click').on('click', function() {
                            var productId = $(this).data('id');
                            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtener el token CSRF desde una meta tag

                            $.ajax({
                                type: 'POST',
                                url: '/update-cart',
                                data: {
                                    _token: csrfToken,
                                    id: productId,
                                    action: 'decrease'
                                },
                                success: function(data) {
                                    updateCartContent();
                                },
                                error: function(error) {
                                    console.error('Error updating cart:', error);
                                }
                            });
                        });
        
                        // Función para eliminar el producto
                        $('.eliminar').on('click', function() {
                            var productId = $(this).data('id');
                            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtener el token CSRF desde una meta tag

                            $.ajax({
                                type: 'POST',
                                url: '/update-cart',
                                data: {
                                    _token: csrfToken,
                                    id: productId,
                                    action: 'remove'
                                },
                                success: function(data) {
                                    updateCartContent();
                                },
                                error: function(error) {
                                    console.error('Error removing product from cart:', error);
                                }
                            });
                        });
                    }
                // Añadir al carrito
                $('.add-to-cart-button').off('click').on('click', function () {
                    var productId = $(this).data('product-id');
                    $.ajax({
                        type: 'GET',
                        url: '/add-to-cart/' + productId,
                        success: function () {
                            $("#adding-cart-" + productId).show();
                            $("#add-cart-btn-" + productId).hide();
                            updateCartContent();
                        },
                        error: function (error) {
                            console.error('Error adding to cart:', error);
                        }
                    });
                });

                // Inicializar los botones del carrito
                bindCartButtons();
                });
            },
            error: function (xhr, status, error) {
                console.error('Error al filtrar productos:', error);
            },
        });
    }
    // FILTRANDO PRODUCTOS POR CATEGORÍA ==========================
    $('.category_item').click(function () {
        var catProduct = $(this).attr('category'); // Coger la categoría seleccionada
        var maxPrice = $('#price-range').val();  // Obtener el precio máximo de la gama de precios



        // AGREGANDO CLASE ACTIVE AL ENLACE SELECCIONADO
        $('.category_item').removeClass('ct_item-active');
        $(this).addClass('ct_item-active');

        // Dependiendo de la categoría, establecer los filtros adicionales (especie, presentación)
        switch (catProduct) {
            case 'perro':
                obtenerProductosFiltrados('perro', maxPrice);
                break;
            case 'gato':
                obtenerProductosFiltrados('gato', maxPrice);
                break;
            case 'snack-perro':
                obtenerProductosFiltrados('snack-perro', maxPrice);
                break;
            case 'snack-gato':
                obtenerProductosFiltrados('snack-gato', maxPrice);
                break;
            case 'humeda-gato':
                obtenerProductosFiltrados('humeda-gato', maxPrice);
                break;
            case 'humeda-perro':
                obtenerProductosFiltrados('humeda-gato', maxPrice);
                break;
            default:
                obtenerProductosFiltrados('all', maxPrice);
                break;
        }
    });

    // Actualizar el display del precio sin realizar la consulta
    $('#price-range').on('input', function () {
        var maxPrice = $(this).val();
        $('#price-display').text(maxPrice); // Actualiza solo el valor mostrado
    });

    // Al hacer clic en el botón de aplicar filtro, realiza la consulta
    $('#apply-price-filter').click(function () {
        var maxPrice = $('#price-range').val();  // Obtener el precio máximo de la gama de precios
        var activeCategory = $('.category_item.ct_item-active').attr('category') || 'all'; // Obtener la categoría activa o 'all' si no hay ninguna seleccionada

        // Llamar a la función para obtener productos filtrados
        obtenerProductosFiltrados(activeCategory, maxPrice);
    });
});
