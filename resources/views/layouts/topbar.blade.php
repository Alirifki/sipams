<nav class="navbar navbar-light bg-white shadow-sm px-4">
    <span class="fw-bold">Sistem Air Bersih Desa</span>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-danger btn-sm">Logout</button>
    </form>
</nav>
