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
<body class="vh-100" style="background: linear-gradient(to bottom, #e60120, #f16676); background-size: cover; background-attachment: fixed; margin-bottom: 30px;">
    
    <div class="todo" style="align-items: center; display: flex; justify-content: center; background: white; padding: 20px; margin: 30px auto; width: 90%; border-radius: 15px;">
        <div class="container">
            <div class="text-start mt-3" style="padding-bottom: 0px; padding-left: 10px; padding-top: 20px; position: relative; display: flex; flex-direction: column; align-items: center; margin-bottom: 30px;">
                <a href="{{ route('menu') }}" class="btn btn-primary" style="background:#fab110; border: 0.5px solid #fab110; align-self: flex-start; padding: 10px 20px; font-size: 1rem;">
                    Atrás
                </a>
                <h3 class="mt-3" style="font-size: 2rem; color: #333; font-weight: bold;">Punto de Venta</h3>
                <img src="{{ asset('img/OKSO.png') }}" style="width: 150px; height: 75px; margin-bottom: 1em; margin-right: 10px; position: absolute; top: 0; right: 0;">
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3" style="font-size: 1rem; color: #333;">
                <div>Empleado: <span id="employee-name" style="font-weight: bold;">pilin</span></div>
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
                            <!-- Aquí se añadirán las filas de productos -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-muted mb-3">Artículos: 0</div>
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div class="text-end">
                    <div style="font-size: 1.4rem; font-weight: bold;">Subtotal: $0.00</div>
                    <div style="font-size: 1.2rem; font-weight: bold;">Iva: 16%</div>
                    <div style="font-size: 1.5rem; font-weight: bold;">Total: $0.00</div>
                </div>
                <div>
                    <button class="btn btn-success" style="font-size: 1.2rem; padding: 10px 20px; border-radius: 10px; background-color: #28a745; border: none;">
                        Realizar Venta
                    </button>
                </div>
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
            const row = document.createElement('tr');

            const descriptionCell = document.createElement('td');
            descriptionCell.textContent = product.name;
            row.appendChild(descriptionCell);

            const imageCell = document.createElement('td');
            const img = document.createElement('img');
            img.src = product.image ? `${window.location.origin}/storage/${product.image}` : 'default-image-url';
            img.alt = 'Imagen del Producto';
            img.style.width = '50px';
            img.style.height = '50px';
            imageCell.appendChild(img);
            row.appendChild(imageCell);

            const quantityCell = document.createElement('td');
            quantityCell.innerHTML = `<input type="number" class="form-control" value="1" min="0" onchange="updateTotal()" data-price="${price}" data-product-id="${product.id}" style="width: 80px;" />`;
            row.appendChild(quantityCell);

            const priceCell = document.createElement('td');
            priceCell.textContent = `$${price.toFixed(2)}`;
            row.appendChild(priceCell);

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
    </script>
</body>
</html>
