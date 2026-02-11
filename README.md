<h1 align="center">Selamat datang di Sistem Pamsimas Desa 👋</h1>

## Apa itu Sistem Pamsimas Desa?

Web Sistem Pamsimas Desa yang dibuat oleh <a href="https://github.com/Alirifky">Mohammad Ali Rifki </a>. **Sistem Pamsimas Desa adalah Website untuk melakuka pengelolaan pamsimas melalui website.**

## Fitur apa saja yang tersedia di Sistem Pamsimas Desa?

- Autentikasi Admin
- Manajemen Pelanggan
- Input Meter Air
- Generate Tagihan Otomatis
- dan lain-lain



## Release Date

**Release date : 11 feb 2026**

> Sistem pamsimas desa merupakan project open source yang dibuat oleh Mohammad Ali Rifki. Kalian dapat download/fork/clone. Cukup beri stars di project ini agar memberiku semangat. Terima kasih!

---

## Default Account for testing

**Admin Default Account**

- email: admin@gmail.com
- Password: 12345678

---

## Install

1. **Clone Repository**

```bash
git clone https://github.com/Alirifki/sipams.git
cd sipams
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate --seed
```

4. **Jalankan website**

```bash
php artisan serve
```

## Author


- LinkedIn : <a href="https://www.linkedin.com/in/adhiariyadi/"> Mohammad Ali Rifki</a>

## Contributing

Contributions, issues and feature requests di persilahkan.
Jangan ragu untuk memeriksa halaman masalah jika Anda ingin berkontribusi. **Berhubung Project ini saya sudah selesaikan sendiri, namun banyak fitur yang kalian dapat tambahkan silahkan berkontribusi yaa!**

## License

- Copyright © 2026 Mohammad Ali Rifki.
- **Sistem pamsimas desa is open-sourced software licensed under the MIT license.**
