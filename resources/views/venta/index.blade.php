<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Punto de Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="vh-100" style="background: linear-gradient(to bottom, #e60120, #f16676); background-size: cover; background-attachment: fixed; margin-bottom: 30px;">
    
    <div class="todo" style="padding-bottom:50px;padding-top:20px;align-items: center; display: flex; justify-content: center; background: white;margin: 30px auto; width: 90%; border-radius: 15px;">
        <div class="container">
            <div class="text-start mt-3" style="padding-bottom: 0px; padding-left: 10px; padding-top: 20px; position: relative; display: flex; flex-direction: column; align-items: center; margin-bottom: 30px;">
                <a href="{{ route('menu') }}" class="btn btn-primary" style="background:#fab110; border: 0.5px solid #fab110; align-self: flex-start; padding: 10px 20px; font-size: 0.8rem;">
                    Atrás
                </a>
                <h3 class="mt-3" style="font-size: 2rem; color: #333; font-weight: bold;">Punto de Venta</h3>
                <img src="{{ asset('img/OKSO.png') }}" style="width: 150px; height: 75px; margin-bottom: 1em; margin-right: 10px; position: absolute; top: 0; right: 0;">
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3" style="font-size: 1rem; color: #333;">
                <div>Empleado: <span id="employee-name" style="font-weight: bold;">{{ $employeeName }}</span></div>
                <div style="display: flex; align-items: center;">
                    <span style="font-weight: bold;">{{ date('d-m-Y') }}</span>
                    <span id="current-time" style="margin-left: 10px;"></span>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div class="mb-3" style="width: 48%;">
                    <label for="product-code" class="form-label">Código del Producto</label>
                    <input style="width: 100%;" type="text" class="form-control" id="product-code" placeholder="Ingresa el código del producto" onkeydown="if(event.key === 'Enter') searchProduct()"/>
                </div>
                <div class="mb-3" style="width: 48%;">
                    <label for="product-name" class="form-label">Nombre del Producto</label>
                    <input style="width: 100%;" type="text" class="form-control" id="product-name" placeholder="Ingresa el nombre del producto" onkeydown="if(event.key === 'Enter') searchProductName()"/>
                </div>
            </div>

            <div class="d-flex flex-column mb-4">
                <div style="width: 100%;">
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #fab110; color: white;">
                            <tr>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th>Cant.</th>
                                <th>Precio</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody id="product-table-body">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-muted">Artículos: 0</div>
            <div class="text-end">
                    <div style="font-size: 1.4rem; font-weight: bold;">
                        Subtotal: $0.00
                    </div>
                    <div style="font-size: 1.2rem; font-weight: bold;">
                        Iva: 16%
                    </div>
                    <div style="font-size: 1.5rem; font-weight: bold;">
                        Total: $0.00
                    </div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-danger" onclick="cancelOrder()">Cancelar</button>
                <button class="btn btn-success" onclick="payOrder()">Pagar</button>
            </div>

        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            document.getElementById('current-time').textContent = timeString;
        }
        setInterval(updateClock, 1000);

        function searchProduct() {
            const productCode = document.getElementById('product-code').value;
            if (productCode.trim() === '') {
                alert('Por favor ingrese un código de producto.');
                return;
            }

            fetch(`/buscar-producto/${productCode}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addProductToTable(data.product);
                        updateTotal();
                    } else {
                        alert('Producto no encontrado.');
                    }
                })
                .catch(error => {
                    console.error('Error al buscar el producto:', error);
                });

            document.getElementById('product-code').value = '';
            document.getElementById('product-code').focus();
        }

        function searchProductName() {
            const productName = document.getElementById('product-name').value;
            if (productName.trim() === '') {
                alert('Por favor ingrese un nombre de producto.');
                return;
            }

            fetch(`/buscar-producto-nombre/${encodeURIComponent(productName)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addProductToTable(data.product);
                        updateTotal();
                    } else {
                        alert('Producto no encontrado.');
                    }
                })
                .catch(error => {
                    console.error('Error al buscar el producto:', error);
                });

            document.getElementById('product-name').value = '';
            document.getElementById('product-name').focus();
        }

        function addProductToTable(product) {
        const price = Number(product.unitprice);
        if (isNaN(price)) {
            alert('El precio del producto no es válido.');
            return;
        }

        const tbody = document.querySelector('table tbody');
        let productExists = false;

        // Revisamos si el producto ya está en la tabla
        const rows = tbody.querySelectorAll('tr');
        rows.forEach(row => {
            const existingProductId = row.querySelector('input').getAttribute('data-product-id');
            if (existingProductId === product.id.toString()) {
                // Si el producto ya existe, actualizamos la cantidad
                const quantityInput = row.querySelector('input');
                const newQuantity = parseInt(quantityInput.value) + 1; // Aumentamos la cantidad
                quantityInput.value = newQuantity;
                updateTotal(); // Actualizamos el total
                productExists = true;
            }
        });

        if (productExists) {
            return; // Si el producto ya existe, no lo agregamos
        }

        // Si no existe, agregamos el producto a la tabla
        const row = document.createElement('tr');

        // Descripción del producto
        const descriptionCell = document.createElement('td');
        descriptionCell.textContent = product.name;
        row.appendChild(descriptionCell);

        // Imagen del producto
        const imageCell = document.createElement('td');
        const img = document.createElement('img');
        img.src = product.image ? `${window.location.origin}/storage/${product.image}` : 'default-image-url';
        img.alt = 'Imagen del Producto';
        img.style.width = '50px';
        img.style.height = '50px';
        imageCell.appendChild(img);
        row.appendChild(imageCell);

        // Cantidad del producto
        const quantityCell = document.createElement('td');
        quantityCell.innerHTML = `<input type="number" class="form-control" value="1" min="0" onchange="updateTotal()" data-price="${price}" data-product-id="${product.id}" style="width: 80px;" />`;
        row.appendChild(quantityCell);

        // Precio del producto
        const priceCell = document.createElement('td');
        priceCell.textContent = `$${price.toFixed(2)}`;
        row.appendChild(priceCell);

        // Importe del producto
        const amountCell = document.createElement('td');
        amountCell.textContent = `$${price.toFixed(2)}`;
        row.appendChild(amountCell);

        tbody.appendChild(row);

        updateTotal(); // Actualizamos el total
    }


        function updateTotal() {
            const rows = document.querySelectorAll('table tbody tr');
            let total = 0;
            let totalItems = 0;

            rows.forEach(row => {
                const quantityInput = row.querySelector('input');
                const quantity = parseInt(quantityInput.value);
                const price = parseFloat(quantityInput.getAttribute('data-price'));
                const amount = quantity * price;
                total += amount;
                totalItems += quantity;

                if (quantity === 0) {
                    row.remove();
                }

                const amountCell = row.querySelector('td:last-child');
                amountCell.textContent = `$${amount.toFixed(2)}`;
            });

            const subtotalElement = document.querySelector('.text-end div:first-child');
            subtotalElement.textContent = `Subtotal: $${total.toFixed(2)}`;

            const ivaElement = document.querySelector('.text-end div:nth-child(2)');
            ivaElement.textContent = `Iva: $${(total * 0.16).toFixed(2)}`;

            const totalElement = document.querySelector('.text-end div:last-child');
            totalElement.textContent = `Total: $${(total + (total * 0.16)).toFixed(2)}`;

            const itemsElement = document.querySelector('.text-muted');
            itemsElement.textContent = `Artículos: ${totalItems}`;
        }
        function cancelOrder() {
            const tbody = document.querySelector('table tbody');
            tbody.innerHTML = '';
            updateTotal();
            alert('El pedido ha sido cancelado.');
        }

        function payOrder() {
    const rows = document.querySelectorAll('table tbody tr');
    let products = [];

    // Recolectamos los productos
    rows.forEach(row => {
        const productId = row.querySelector('input').getAttribute('data-product-id');
        const quantity = parseInt(row.querySelector('input').value);
        const unitPrice = parseFloat(row.querySelector('input').getAttribute('data-price'));

        // Solo agregamos el producto si la cantidad es mayor que 0
        if (quantity > 0) {
            products.push({
                productId: productId,
                quantity: quantity,
                unitPrice: unitPrice
            });
        }
    });

    // Depurar los productos recolectados
    console.log('Productos recolectados:', products);

    // Recolectamos la información del pedido (subtotal, iva, total)
    const subtotal = parseFloat(document.querySelector('.text-end div:first-child').textContent.replace('Subtotal: $', ''));
    const iva = parseFloat(document.querySelector('.text-end div:nth-child(2)').textContent.replace('Iva: $', ''));
    const total = parseFloat(document.querySelector('.text-end div:last-child').textContent.replace('Total: $', ''));

    // Depurar los valores de subtotal, iva y total
    console.log('Subtotal:', subtotal);
    console.log('IVA:', iva);
    console.log('Total:', total);

    // Asegurarnos de que los productos no estén vacíos
    if (products.length === 0) {
        alert('No hay productos en el pedido.');
        return;
    }

    // Preparar los datos del pedido
    const orderData = {
        employeeId: '{{ session('employee_id') }}', // Asegúrate de que esto esté disponible en la sesión
        subtotal: subtotal,
        iva: iva,
        total: total,
        products: products
    };

    // Depurar el objeto de datos del pedido antes de enviarlo
    console.log('Datos del pedido:', orderData);

    // Hacer el request POST al backend
    fetch('/pagar', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(orderData)
})
.then(response => {
    if (!response.ok) {
        // Si el servidor responde con un código de error (ej. 500 o 404), muestra el error
        return response.text().then(text => { throw new Error(text) });
    }
    return response.json(); // Responde en formato JSON si todo está bien
})
.then(data => {
    console.log('Respuesta del servidor:', data); // Ver la respuesta completa
    if (data.success) {
        alert('El pago se ha realizado correctamente.');
        cancelOrder(); // Cancelar el pedido después de pagar
    } else {
        alert('Hubo un error al realizar el pago: ' + data.message);
    }
})
.catch(error => {
    console.error('Error al procesar el pago:', error);
    alert('Error al procesar el pago. Por favor, intente nuevamente.');
});

}



    </script>
</body>
</html>
