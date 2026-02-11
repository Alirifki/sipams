<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Sistem Air Desa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 16px;
        }
    </style>
</head>
<body>
<body class="bg-light">

<div class="d-flex">

    @include('layouts.sidebar')

    <div class="flex-grow-1">

        @include('layouts.topbar')

        <main class="p-4">
            <x-breadcrumb />
            @yield('content')
        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@yield('script')

</body>
</html>
