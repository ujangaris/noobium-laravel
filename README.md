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
            "password": "password",
        }

        kemudian send

        hasil akan menampilkan response berhasil seperti yang kita buat pada AuthController

## Buat Form Request Sign Up

    Todo:
    1.  buat form Request SignUp
        - php artisan make:request Auth/SignUpRequest
        - docs : https://laravel.com/docs/9.x/validation#form-request-validation
    2.  Requests/Auth/SignUpRequest.php
        - rubah public function authorize()
            {
                return true;//yang tdnya false jd true
            }
        - kemudian isi rulesnya
    3.  Controllers/AuthController.php
        - import dan pasang SignUpRequest
        - pasang validation
        - terapkan validation pada setiap field
    4.  setup tambahan pada ppostman
        - pada bagian headers pasang Accept dengan nilai aplication/json
          ini dilakukan agar tidak redirect ke tampilan web
    5.  pengujian pada postman
        - POST http://localhost:8000/api/sign-up
            body -> raw -> json:
            {
                "name": "",
                "email": "test2@gmail.com",
                "password": "password",
            }
        - kosongkan name, kemudian coba send
        - response kan menampilkan pesan :
            {
                "message": "The name field is required.",
                "errors": {
                    "name": [
                        "The name field is required."
                    ]
                }
            }
