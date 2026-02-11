<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Sistem Air Desa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg,#0d6efd,#0dcaf0);
            min-height: 100vh;
        }
        .card {
            border-radius: 16px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-4 col-sm-10">

        <div class="card shadow">
            <div class="card-body p-4">

                <h4 class="text-center mb-3">🔐 Login Sistem Air Desa</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- USERNAME -->
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               placeholder="Masukkan username"
                               required
                               autofocus>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Masukkan password"
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>
                </form>

                <div class="text-center mt-3 text-muted small">
                    © {{ date('Y') }} Pemerintah Desa
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>
