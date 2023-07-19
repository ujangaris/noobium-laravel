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

## Update Fillable dan Buat Endpoint untuk Sign Up

    Todo:
    1.  app/Models/User.php
        - tambahkan fillable picture
    2.  route/api.php
        - buat route sign-up

## TestAPI Endpoint sign-up dengan Postman

    Todo:
    1. buka postman
        POST http://localhost:8000/api/sign-up
        body -> raw -> json:
        {
            "name": "Test",
            "email": "test@gmail.com",
            "password": "admin0k8"
        }

        kemudian send

        hasil akan menampilkan response berhasil seperti yang kita buat pada AuthController
