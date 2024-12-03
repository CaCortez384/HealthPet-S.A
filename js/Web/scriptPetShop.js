$(document).ready(function() {
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
            success: function(response) {
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
                response.productos.forEach(function(producto) {
                    const productHTML = `
                        <div class="product-item" category="${producto.id_categoria}" onclick="goToDetail(${producto.id})">
                            <img src="/storage/${producto.imagen}" alt="${producto.nombre}">
                            <div class="product-details">
                                <h4>${producto.nombre}</h4>
                                <p>Precio: $${producto.precio_de_venta}</p>
                                <p>Stock: ${producto.stock_unidades}</p>
                                ${
                                    producto.stock_unidades === 0
                                        ? `
                                            <button class="add-to-cart add-to-cart-button"
                                                data-product-id="${producto.id}" 
                                                onclick="event.stopPropagation();">Realizar pedido</button>
                                            <span id="adding-cart-${producto.id}" 
                                                class="btn btn-warning btn-block text-center added-msg"
                                                style="display:none;">Añadido!</span>
                                        `
                                        : `
                                            <button class="add-to-cart add-to-cart-button"
                                                data-product-id="${producto.id}" 
                                                onclick="event.stopPropagation(); agregarAlCarrito(${producto.id});">Agregar al carrito</button>
                                            <span id="adding-cart-${producto.id}" 
                                                class="btn btn-warning btn-block text-center added-msg"
                                                style="display:none;">Añadido!</span>
                                        `
                                }
                            </div>
                        </div>
                    `;
        
                    $('.products-list').append(productHTML);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al filtrar productos:', error);
            },
        });
    }
    // FILTRANDO PRODUCTOS POR CATEGORÍA ==========================
    $('.category_item').click(function() {
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
    $('#price-range').on('input', function() {
        var maxPrice = $(this).val();
        $('#price-display').text(maxPrice); // Actualiza solo el valor mostrado
    });

    // Al hacer clic en el botón de aplicar filtro, realiza la consulta
    $('#apply-price-filter').click(function() {
        var maxPrice = $('#price-range').val();  // Obtener el precio máximo de la gama de precios
        var activeCategory = $('.category_item.ct_item-active').attr('category') || 'all'; // Obtener la categoría activa o 'all' si no hay ninguna seleccionada

        // Llamar a la función para obtener productos filtrados
        obtenerProductosFiltrados(activeCategory, maxPrice);
    });
});
