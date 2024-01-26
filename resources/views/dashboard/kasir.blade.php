@extends('layout')
@section('content')
    <div class="container">
        <div class="wrapper">
            <div class="kotak m-3 p-3">
                <div class="title m-3">
                    <h3>Masukkan barangya</h3>
                </div>
                <div class="table">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>id barang</th>
                                <th>nama barang</th>
                                <th>harga</th>
                                <th>stok</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->nama_barang}}</td>
                                    <td>{{$item->harga}}</td>
                                    <td>{{$item->stok}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="javascript:void(0);" onclick="addToCart({{$item->id}}, '{{$item->nama_barang}}', {{$item->harga}})">+</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>id barang</th>
                                <th>nama barang</th>
                                <th>stok</th>
                                <th>harga</th>
                                <th>action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="kotak m-3 p-3">
                <h3>Shopping Cart</h3>
                <ul id="cartItems"></ul>
                <div>
                    <label for="moneyGiven">Money Given:</label>
                    <input type="text" id="moneyGiven" onchange="calculateChange()" />
                </div>
                <div>
                    <label for="total">Total:</label>
                    <span id="total">0</span>
                </div>
                <div>
                    <label for="discount">Discount:</label>
                    <span id="discount">0</span>
                </div>
                <div>
                    <label for="change">Change:</label>
                    <span id="change">0</span>
                </div>
                <button onclick="submitTransaction()">Submit Transaction</button>
                <button onclick="generatePDF()">Generate PDF Report</button>
            </div>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // JavaScript array for the shopping cart
        var cart = [];

        // Function to add item to the cart
        function addToCart(id, nama_barang, harga) {
            // Check if item with the same ID already exists in the cart
            var existingItem = cart.find(item => item.id === id);

            if (existingItem) {
                // If exists, update the quantity
                existingItem.qty += 1;
            } else {
                // If not exists, add a new item
                var newItem = {
                    id: id,
                    nama_barang: nama_barang,
                    harga: harga,
                    qty: 1  // Initial quantity
                };
                cart.push(newItem);
            }

            // Update the displayed cart
            updateCartDisplay();
            // Calculate total, discount, and change when adding an item
            calculateTotal();
            calculateChange();
        }

        // Function to update the displayed cart
        function updateCartDisplay() {
            var cartItemsElement = document.getElementById('cartItems');
            cartItemsElement.innerHTML = '';

            // Display each item in the cart
            cart.forEach(function(item) {
                var listItem = document.createElement('li');
                listItem.innerHTML =
                    item.qty + ' x ' + item.nama_barang + ' - $' + item.harga * item.qty +
                    '<button onclick="increaseQty(' + item.id + ')">+</button>' +
                    '<button onclick="decreaseQty(' + item.id + ')">-</button>';
                cartItemsElement.appendChild(listItem);
            });
        }

        // Function to increase quantity
        function increaseQty(id) {
            var item = cart.find(item => item.id === id);
            if (item) {
                item.qty += 1;
            }
            updateCartDisplay();
            // Calculate total, discount, and change when increasing quantity
            calculateTotal();
            calculateChange();
        }

        // Function to decrease quantity
        function decreaseQty(id) {
            var item = cart.find(item => item.id === id);
            if (item) {
                item.qty -= 1;
                // Remove item if quantity is zero
                if (item.qty === 0) {
                    cart = cart.filter(item => item.id !== id);
                }
            }
            updateCartDisplay();
            // Calculate total, discount, and change when decreasing quantity
            calculateTotal();
            calculateChange();
        }

        // Function to calculate total
        function calculateTotal() {
            var totalSpan = document.getElementById('total');
            var discountSpan = document.getElementById('discount');
            var total = cart.reduce((total, item) => total + item.harga * item.qty, 0);

            // Apply discount if total is above 500000
            var discount = total > 500000 ? 10000 : 0;

            totalSpan.textContent = (total - discount).toFixed(2);
            discountSpan.textContent = discount.toFixed(2);
        }

        // Function to calculate change
        function calculateChange() {
            var moneyGivenInput = document.getElementById('moneyGiven');
            var changeSpan = document.getElementById('change');

            var moneyGiven = parseFloat(moneyGivenInput.value) || 0;
            var totalAmount = parseFloat(document.getElementById('total').textContent) || 0;
            var change = moneyGiven - totalAmount;

            changeSpan.textContent = change.toFixed(2);
        }
        function submitTransaction() {
    var url = '{{ route('transaksi.store') }}';
    var data = {
        cart: cart,
        total: parseFloat(document.getElementById('total').textContent) || 0,
        discount: parseFloat(document.getElementById('discount').textContent) || 0,
        moneyGiven: parseFloat(document.getElementById('moneyGiven').value) || 0,
        change: parseFloat(document.getElementById('change').textContent) || 0,
    };

    axios.post(url, data)
        .then(response => {
            // On success, clear the cart array
            cart = [];
            updateCartDisplay();
            // Reset other form fields as needed
            document.getElementById('moneyGiven').value = '';
            document.getElementById('total').textContent = '0';
            document.getElementById('discount').textContent = '0';
            document.getElementById('change').textContent = '0';
        })
        .catch(error => {
            console.error('Error submitting transaction:', error);

            // Log the error details to the console
            console.error('Error details:', error.response.data);
        });
}
function generatePDF() {
    var url = '{{ route('transaksi.generatePDF') }}';

    axios.get(url)
        .then(response => {
            // On success, you can handle the response
            console.log('PDF generated successfully:', response.data);

            // You may also redirect or perform other actions as needed
        })
        .catch(error => {
            console.error('Error generating PDF:', error);

            // Log the error details to the console
            console.error('Error details:', error.response.data);
        });
}



    </script>
@endsection
