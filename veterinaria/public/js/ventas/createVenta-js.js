// Cargar los productos en el select
const openDialogButton = document.getElementById('openDialogButton');
const deleteDialog = document.getElementById('deleteDialog');
const cancelButton = document.getElementById('cancelButton');
openDialogButton.addEventListener('click', async () => {
    await deleteDialog.show();
});

cancelButton.addEventListener('click', async () => {
    await deleteDialog.close();
});

let productosSeleccionados = [];
let productoCounter = 0;

// funcion que se ejecuta al hacer click en el botón de agregar producto
document.getElementById('agregarProducto').addEventListener('click', () => {
    let productoSelect = document.getElementById('productos');
    let tipoVentaSelect = document.getElementById('tipo_venta');
    let presentacion = productoSelect.options[productoSelect.selectedIndex].getAttribute(
        'data-presentacion');
    let productoId = productoSelect.value;
    let productoNombre = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-nombre');

    //editar para que tome el precio unitario por ml/comrpimido o el precio del producto completo
    let productoPrecio = 0;
    let cantidad = 0;

    if (tipoVentaSelect.value === 'completo') {
        cantidad = parseInt(document.getElementById('cantidad').value);
        productoPrecio = productoPrecio = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precio');
    } else if (tipoVentaSelect.value === 'fraccionado') {
        if (presentacion == '1') {
            cantidad = parseInt(document.getElementById('cantidad_comprimidos').value);
            productoPrecio = productoPrecio = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precioFraccionado');
        } else if (presentacion == '2') {
            cantidad = parseInt(document.getElementById('cantidad_ml').value);
            productoPrecio = productoPrecio = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precioFraccionado');
        } else if (presentacion == '3') {
            cantidad = parseInt(document.getElementById('cantidad_unidades').value);
            productoPrecio = productoPrecio = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precioFraccionado');
        }
    }
    // Validar que la cantidad sea un número positivo
    if (productoId && cantidad > 0) {
        // Verificar si el producto ya existe en el carrito con el mismo tipo de venta
        let productoExistente = productosSeleccionados.find(producto => producto.id === productoId && producto.tipoVenta === tipoVentaSelect.value);

        if (productoExistente) {
            // Aumentar la cantidad si ya existe con el mismo tipo de venta
            productoExistente.cantidad += cantidad;
        } else {
            // Si no existe, agregar nuevo producto
            productosSeleccionados.push({
                id: productoId,
                nombre: productoNombre,
                precio: productoPrecio,
                cantidad: cantidad,
                tipoVenta: tipoVentaSelect.value, // Agregar el tipo de venta al objeto producto
                tipoPresentacion: presentacion
            });
        }

        // Actualizar la vista
        actualizarCarrito();

        // Actualizar el DOM con los productos
        renderizarProductos();
    }
});

// Función para renderizar los productos en el carrito
function renderizarProductos() {
    // Limpiar la lista actual
    document.getElementById('listaProductos').innerHTML = '';

    // Agregar todos los productos en el carrito al DOM
    productosSeleccionados.forEach((producto, index) => {
        labelCantidad = '';
        if (producto.tipoVenta === 'fraccionado') {
            if (producto.tipoPresentacion == '1') {
                labelCantidad = 'Cantidad (Comprimidos)';
            } else if (producto.tipoPresentacion == '2') {
                labelCantidad = 'Cantidad (ml)';
            } else if (producto.tipoPresentacion == '3') {
                labelCantidad = 'Cantidad (Unidades)';
            } else {
                labelCantidad = 'peo';
            }
        } else {
            labelCantidad = 'Cantidad';
            }

        let newProductHtml = `
                <div class="producto_carrito" id="producto-${producto.id}">
                    <md-filled-text-field type="text" label="Nombre del Producto" class="input-uniforme" 
                        value="${producto.nombre}" disabled></md-filled-text-field>
                    <md-filled-text-field type="text" label="${labelCantidad}" class="input-uniforme" 
                        value="${producto.cantidad}" disabled></md-filled-text-field>
                    <md-filled-text-field type="text" label="Precio" class="input-uniforme" 
                        value="${producto.precio}" disabled></md-filled-text-field>
                    <md-icon-button onclick="eliminarProducto(event, String(${producto.id}))" style=" --md-icon-button-icon-color: #dc362e;">
                        <md-icon>delete</md-icon>
                    </md-icon-button>
                    <input type="hidden" name="productos[${index}][id_producto]" value="${producto.id}">
                    <input type="hidden" name="productos[${index}][cantidad]" value="${producto.cantidad}">
                    <input type="hidden" name="productos[${index}][precio_unitario]" value="${producto.precio}">
                    <input type="hidden" name="productos[${index}][tipo_venta]" value="${producto.tipoVenta}">
                    <input type="hidden" name="productos[${index}][id_presentacion]" value="${producto.tipoPresentacion}">
                </div>`;
        document.getElementById('listaProductos').insertAdjacentHTML('beforeend', newProductHtml);
    });
}


// Función para eliminar productos
function eliminarProducto(event, productoId) {
    event.preventDefault(); // Evita que se envíe el formulario
    console.log("Productos después de la eliminación:", productosSeleccionados);
    // Eliminar el producto del array utilizando el ID
    productosSeleccionados = productosSeleccionados.filter(producto => producto.id !== productoId);

    // Comprobar si la eliminación fue exitosa
    console.log("Productos después de la eliminación:", productosSeleccionados);

    // Remover el producto del DOM
    const productoDiv = document.getElementById(`producto-${productoId}`);
    if (productoDiv) {
        productoDiv.remove();
    }

    // Recalcular y actualizar el carrito
    actualizarCarrito();
}


// Función para actualizar el subtotal
function actualizarCarrito() {
    let subtotal = 0;

    productosSeleccionados.forEach((producto) => {
        // Eliminar puntos del precio antes de multiplicar
        let precioSinPuntos = producto.precio.toString().replace(/\./g, '');


        let precioDecimal = parseFloat(precioSinPuntos); // Cambiar a parseFloat para conservar decimales
        subtotal += precioDecimal * producto.cantidad; // Mantener el subtotal como decimal
    });

    // Formatear el subtotal con separadores de miles y mantener los ceros finales
    document.getElementById('subtotal').value = new Intl.NumberFormat('es-CL', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(subtotal);
    actualizarTotal();


    console.log("Productos en el carrito:", productosSeleccionados);
}

// Actualizar el total al cambiar el descuento
document.getElementById('descuento').addEventListener('input', actualizarTotal);

// Función para actualizar el total
function actualizarTotal() {
    // Eliminar puntos del subtotal antes de calcular
    let subtotalSinPuntos = document.getElementById('subtotal').value.replace(/\./g, '');
    let subtotal = parseFloat(subtotalSinPuntos) || 0; // Cambiar a parseFloat para conservar decimales

    let descuento = parseFloat(document.getElementById('descuento').value) || 0;

    // Asegurarse de que el descuento esté en el rango válido
    if (descuento < 0 || descuento > 100) {
        alert('El descuento debe estar entre 0 y 100');
        return;
    }

    // Calcular el total aplicando el descuento
    let total = subtotal - (subtotal * (descuento / 100));

    // Formatear el total con separadores de miles y mantener los ceros finales
    document.getElementById('total').value = new Intl.NumberFormat('es-CL', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(total);
}


// Función para validar el RUT
var Fn = {
    validaRut: function (rutCompleto) {
        rutCompleto = rutCompleto.replace("‐", "-");
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
            return false;
        var tmp = rutCompleto.split('-');
        var digv = tmp[1];
        var rut = tmp[0];
        if (digv == 'K') digv = 'k';
        return (Fn.dv(rut) == digv);
    },
    dv: function (T) {
        var M = 0,
            S = 1;
        for (; T; T = Math.floor(T / 10))
            S = (S + T % 10 * (9 - M++ % 6)) % 11;
        return S ? S - 1 : 'k';
    }
}
// uso de validacion de rut
document.addEventListener('DOMContentLoaded', function () {
    var rutInput = document.getElementById('rut_cliente');
    var msgError = document.getElementById('msgerror');

    rutInput.addEventListener('input', function () {
        if (Fn.validaRut(rutInput.value)) {
            msgError.innerHTML = "El Rut ingresado es válido";
            msgError.classList.remove('text-danger');
            msgError.classList.add('text-success');
        } else {
            msgError.innerHTML = "El Rut no es válido";
            msgError.classList.remove('text-success');
            msgError.classList.add('text-danger');
        }
    });
});







function toggleMontoPagado() {
    const permitirModificar = document.getElementById('permitir_modificar').checked;
    const montoPagadoInput = document.getElementById('monto_pagado');

    if (permitirModificar) {
        montoPagadoInput.removeAttribute('readonly'); // Permite la edición
    } else {
        montoPagadoInput.setAttribute('readonly', true); // Bloquea la edición
        // Opcional: reinicia el valor al total si se bloquea
        montoPagadoInput.value = document.getElementById('total').value;
    }
}

function updateMontoPagado() {
    const total = parseFloat(document.getElementById('total').value) || 0;
    const montoPagado = parseFloat(document.getElementById('monto_pagado').value) || 0;

    // Asegurarse de que el monto pagado no exceda el total
    if (montoPagado > total) {
        alert('El monto pagado no puede ser mayor que el total.');
        document.getElementById('monto_pagado').value = total; // Reinicia al total
    }
}
