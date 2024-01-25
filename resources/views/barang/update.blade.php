<!-- resources/views/barang/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <div class="container-fluid barang">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card mantap">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{route('barang.update', ['barang' => $barang->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="namaB">nama barang</label>
                                    <input type="text" name="namaBarang" class="form-control" id="namaBarang" value="{{$barang->nama_barang }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga">harga</label>
                                    <input type="text" name="harga" class="form-control" id="harga" value="{{$barang->harga}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="namaB">stok</label>
                                    <input type="text" name="stok" class="form-control" id="stok" value="{{$barang->stok}}" required>
                                </div>
                                <input type="submit" value="submit">
                             
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>