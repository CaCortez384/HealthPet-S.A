$(document).ready(function() {
    // AGREGANDO CLASE ACTIVE AL PRIMER ENLACE ====================
    $('.category_list .category_item[category="all"]').addClass('ct_item-active');

    // FILTRANDO PRODUCTOS POR CATEGORÍA ==========================
    $('.category_item').click(function() {
        var catProduct = $(this).attr('category');

        // AGREGANDO CLASE ACTIVE AL ENLACE SELECCIONADO
        $('.category_item').removeClass('ct_item-active');
        $(this).addClass('ct_item-active');

        // OCULTANDO PRODUCTOS
        $('.product-item').css('transform', 'scale(0)');
        function hideProduct() {
            $('.product-item').hide();
        } 
        setTimeout(hideProduct, 400);

        // MOSTRANDO PRODUCTOS FILTRADOS POR CATEGORÍA Y PRECIO
        function showProduct() {
            $('.product-item').each(function() {
                var productCategory = $(this).attr('category');
                var productPrice = parseInt($(this).find('.price').text().replace('$', '').replace('.', ''));
                var maxPrice = parseInt($('#price-range').val());

                if ((catProduct === 'all' || productCategory === catProduct) && productPrice <= maxPrice) {
                    $(this).show();
                    $(this).css('transform', 'scale(1)');
                }
            });
        }
        setTimeout(showProduct, 400);
    });

    // MOSTRANDO TODOS LOS PRODUCTOS =======================
    $('.category_item[category="all"]').click(function() {
        function showAll() {
            var maxPrice = parseInt($('#price-range').val());
            $('.product-item').each(function() {
                var productPrice = parseInt($(this).find('.price').text().replace('$', '').replace('.', ''));
                if (productPrice <= maxPrice) {
                    $(this).show();
                    $(this).css('transform', 'scale(1)');
                }
            });
        }
        setTimeout(showAll, 400);
    });

    // FILTRADO POR PRECIO ================================
    $('#price-range').on('input', function() {
        var maxPrice = parseInt($(this).val());
        $('#price-display').text(maxPrice);

        // Aplicar el filtro de precio con la categoría seleccionada
        var activeCategory = $('.category_item.ct_item-active').attr('category');
        $('.product-item').each(function() {
            var productCategory = $(this).attr('category');
            var productPrice = parseInt($(this).find('.price').text().replace('$', '').replace('.', ''));
            
            if ((activeCategory === 'all' || productCategory === activeCategory) && productPrice <= maxPrice) {
                $(this).show();
                $(this).css('transform', 'scale(1)');
            } else {
                $(this).hide();
            }
        });
    });
});
