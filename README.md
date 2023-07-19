# Pembuatan Modul Authentikasi

## Membuat Controller Auth dan Function untuk Sign Up

    Todo:
    1.  membuat controller auth
        - php artisan make:controller AuthController
    2.  .env
        - pasang ui-generator:
            AVATAR_GENERATOR_URL="https://ui-avatars.com/api/?name="
        - docs: https://ui-avatars.com/api/?name=
    3.  controller/AuthController.php
        - buat function signup
        - create user baru
        - autentikasi user dengan token
        - jika tokennya tidak ada(response gagal)
        - jika tokennya ada(response berhasil)
