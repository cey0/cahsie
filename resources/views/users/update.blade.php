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
                            <form class="form-valide" action="{{ route('user.update',['user' => $akun->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="{{$akun->username}}" id="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" name="password" class="form-control" value="{{$akun->password}}" id="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role" >
                                        <option value="admin" {{ $akun->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="kasir" {{ $akun->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="{{$akun->nama}}" required>
                                </div>
                                <input type="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>