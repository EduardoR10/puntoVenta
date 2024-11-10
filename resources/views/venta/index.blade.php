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
</head>
<body class="vh-100" style="background-color: #f8f9fa;">
    
    <div class="todo" style="align-items:center; display:flex; justify-content:center; background:white; padding:20px; margin:20px auto; width:80%; border-radius:20px;">
        <div class="container">
 
            <div class="text-center mb-4" style="font-size: 1.5rem; font-weight: bold; color: #007BFF;">
                OKSO Punto de Venta
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3" style="font-size: 1rem; color: #333;">
                <div>Empleado: <span id="employee-name">{{ $employeeName }}</span></div>
                <div><span id="current-time"></span></div>
            </div>

            <div class="d-flex">
                <!-- Tabla de productos -->
                <div style="width: 100%;">
                    <table class="table table-bordered">
                        <thead style="background-color: #007BFF; color: white;">
                            <tr>
                                <th>Descripción</th>
                                <th>Imagen</th> <!-- Nueva columna de imagen -->
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

            <div class="mb-3">
                <label for="product-code" class="form-label">Código del Producto</label>
                <input style="width: 250px" type="text" class="form-control" id="product-code" placeholder="Ingresa el código del producto" onkeydown="if(event.key === 'Enter') searchProduct()"/>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">Artículos: 0</div>
                <div class="text-end" style="font-size: 1.5rem; font-weight: bold;">
                    Total: $0.00
                </div>
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

            // Limpiar el campo de código y poner el cursor en él
            document.getElementById('product-code').value = '';
            document.getElementById('product-code').focus();
        }

        function addProductToTable(product) {
            const price = Number(product.unitprice);

            if (isNaN(price)) {
                alert('El precio del producto no es válido.');
                return;
            }

            const tbody = document.querySelector('table tbody');
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
            img.style.width = '50px'; // Tamaño de la imagen
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

            updateTotal();
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

                // Si la cantidad es 0, eliminamos la fila
                if (quantity === 0) {
                    row.remove();
                }

                const amountCell = row.querySelector('td:last-child');
                amountCell.textContent = `$${amount.toFixed(2)}`;
            });

            const totalElement = document.querySelector('.text-end');
            totalElement.textContent = `Total: $${total.toFixed(2)}`;

            const itemsElement = document.querySelector('.text-muted');
            itemsElement.textContent = `Artículos: ${totalItems}`;
        }
    </script>
</body>
</html>
