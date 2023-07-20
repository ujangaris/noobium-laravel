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

## Perbaiki Struktur JSON Ketika Error Validasi Request

    Todo:
    1.  buat ErrorResponseJson
        - Traits/ErrorResponseJson.php
        - kemudian setup code ErrorResponseJson
    2.  Requests/Auth/SignUpRequest.php
        - pasang ErrorResponseJson
    3.  setup tambahan pada ppostman
        - pada bagian headers pasang Accept dengan nilai aplication/json
          ini dilakukan agar tidak redirect ke tampilan web
    4.  pengujian pada postman
        - POST http://localhost:8000/api/sign-up
            body -> raw -> json:
            {
                "name": "",
                "email": "",
                "password": "",
            }
        - kosongkan semua/name/email, kemudian coba send
        - response kan menampilkan pesan :
            {
                "meta": {
                    "code": 422,
                    "status": "error",
                    "message": {
                        "name": [
                            "The name field is required."
                        ],
                        "email": [
                            "The email field is required."
                        ],
                        "password": [
                            "The password field is required."
                        ]
                    }
                },
                "data": []
            }

## Buat function Sign In dan endpoint Sign In di routes

    Todo:
    1.  Controllers/AuthController.php
        - function signIn
        - otentikasi data pengguna dengan data yang diterima dari http,
          jika otentikasi berhasil akan menghasilkan token yang disimpan di variable token
        - buat kondisi jika otentikasi gagal(token tidak ada)
        - jika otentikasi berhasil(token ada) simpan data pengguna
        - kirim response success ke client
    2.  routes/api.php
        - endpoint sign-in

## Buat Form Request untuk Sign In & TestAPI Sign In

    Todo:
    1.  Buta form request
        - php artisan make:request Auth/SignInRequest
        - otentikasi data pengguna dengan data yang diterima dari http,
          jika otentikasi berhasil akan menghasilkan token yang disimpan di variable token
        - buat kondisi jika otentikasi gagal(token tidak ada)
        - jika otentikasi berhasil(token ada) simpan data pengguna
        - kirim response success ke client
    2.  Requests/Auth/SignInRequest.php
        - import dan pasang ErrorResponseJson
        - rubah public function authorize()
            {
                return true;//yang tdnya false jd true
            }
        - kemudian isi rulesnya :email & password
    3.  Controllers/AuthController.php
        - import dan pasang SignRequest
        - pada $token = auth()->attempt($request->all());
          all() rubah jd $token = auth()->attempt($request->validated());
    4.  Test API Sign In di Postman
        - POST http://localhost:8000/api/sign-in
            body -> raw -> json:
                {
                    "name": "test@gmail.com",
                    "email": "password yang terdaftar",// diisi dengan password yang terdaftar
                }
        - response kan menampilkan data pengguna :
        - coba juga kosongkan semua/name/email, kemudian coba send
          akan menampilkan error sesuai yang kita buat pada form request dan ErrorResponseJson

## Buat function Sign Out ,endpoint Sign Out di routes & testAPI Sign Out

    Todo:
    1.  Controllers/AuthController.php
        - function signIn
        - otentikasi data pengguna dengan data yang diterima dari http,
          jika otentikasi berhasil akan menghasilkan token yang disimpan di variable token
        - buat kondisi jika otentikasi gagal(token tidak ada)
        - jika otentikasi berhasil(token ada) simpan data pengguna
        - kirim response success ke client
    2.  routes/api.php
        - pasang dulu middleware auth:api
          bungkus endpoint sign-out didalamnya
    3.  Test API Sign Out di Postman
        - pertama login dulu POST http://localhost:8000/api/sign-in
        - POST http://localhost:8000/api/sign-out
            - seting Authorization:BearerToken
            - seting juga headers Accept: application/json
            - copy access token dari endpoint login kemudian pastekan pada Authorization:BearerToken
        - response kan menampilkan response success sign out
        - jika coba melakukan request sign-out lagi, response akan menampilkan "message": "Unauthenticated."

## Memperbaiki Response Unauthenticated

    Todo:
    1.  Exceptions/Handler.php
        - function unauthenticated
        - import dan pasang AuthenticationException
        - pasang condition dan tampilkan pada response jika request yang diminta tidak terotentikasi
    2.  Test API Sign Out di Postman
        - pertama login dulu POST http://localhost:8000/api/sign-in
        - POST http://localhost:8000/api/sign-out
            - seting Authorization:BearerToken
            - seting juga headers Accept: application/json
            - copy access token dari endpoint login kemudian pastekan pada Authorization:BearerToken
        - response kan menampilkan response success sign out
        - jika coba melakukan request sign-out lagi, response akan menampilkan :
            {
                "meta": {
                    "code": 401,
                    "status": "error",
                    "message": "Unauthenticated."
                },
                "data": []
            }
