<!-- resources/views/transactions/pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transactions Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .receipt {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            width: 200px; /* Adjust the width as needed */
        }
        .receipt-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Transactions Report</h2>

    @if (!empty($pdfData))
        @foreach($pdfData as $data)
            <div class="receipt">
                <div class="receipt-item"><strong>ID:</strong> {{ $data['ID'] }}</div>
                <div class="receipt-item"><strong>Nama Barang:</strong> {{ $data['Nama Barang'] }}</div>
                <div class="receipt-item"><strong>Harga:</strong> {{ $data['Harga'] }}</div>
                <!-- Add more items as needed -->
            </div>
        @endforeach
    @else
        <p>No transactions found.</p>
    @endif
</body>
</html>
