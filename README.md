<p align="center"><a href="https://github.com/yanuarcy/SolarisTech" target="_blank"><img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/mlogo/SOE-70068-a5a0480f-4817-4101-a049-8817dce33adc.jpg" width="400" alt="SolarisTech Logo"></a></p>


## About SolarisTech

SolarisTech adalah sebuah website dinamis yang diharapkan bisa membantu Pengembangan Bisnis pada Toko Solaris. SolarisTech ini di buat
menggunakan bahasa PHP dengan bantuan Framework Laravel. Tidak hanya itu, pada SolarisTech ini juga terdapat beberapa packages yang
bertujuan menyempurnakan website agar lebih fungsional. 

## Requirements

Packages yang diperlukan agar SolarisTech bekerja:
- `DataTables` (https://yajrabox.com/docs/laravel-datatables/10.0).
- `SweetAlert` (https://realrashid.github.io/sweet-alert/).
- `Apex Charts` (https://apexcharts.com/).
- `Laravel Liveware v3` (https://liveware.laravel.com/).
- `Laravel Excel` (https://docs.laravel-excel.com/3.1/getting-started/installation.html).
- `Laravel PDF` (https://github.com/barryvdh/laravel-dompdf).

## Setup Project

Step 1:
Untuk Vendor nya

```
composer install
```

Step 2:
Untuk Node Modules nya

```
npm install
```

Step 3:
Untuk Database nya

```
cp .env.example .env
```

Step 4:
Untuk `APP_KEY` pada .env nya

```
php artisan key:generate
```

Step 5:
Setup Database anda, seperti di bawah ini

```
DB_DATABASE=laravel
DB_USERNAME=
DB_PASSWORD=
```

Step 6:
Jalankan `Migration` dan `Seeder` nya via Artisan

>Note: Tolong pastikan Konfigurasi database anda benar sebelum menjalankan perintah di bawah, seperti Nama,Username, dan Password.

```
php artisan migrate --seed
```

Final Step:
Run project anda via Artisan dan Npm:
>Note: Sebelum menjalankan project anda pada server, harap perhatikan Requirement Installation ! 

>Artisan
```
php artisan serve
```

>Npm
```
npm run dev
```

>Note: Tolong install ini pada terminal VS Code anda agar tidak terjadi error.

## Installation DataTables

Install via composer:

```
composer require yajra/laravel-datatables-oracle
```

Selanjutnya, anda install via NPM:

```
npm install datatables.net-bs5 datatables.net-buttons-bs5
```

Selanjutnya Registrasikan aset-aset `DataTables` pada file `/resources/js/app.js` seperti yang terlihat di bawah ini.
```javascript
import './bootstrap';
import 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
```

Selanjutnya Registrasikan aset-aset `DataTables` pada file `/resources/sass/app.scss` seperti yang terlihat di bawah ini.
```sass
// DataTables
@import "datatables.net-bs5/css/dataTables.bootstrap5.css";
@import "datatables.net-buttons-bs5/css/buttons.bootstrap5.css";
```

Selanjutnya Import `jQuery` pada file `/resources/js/bootstrap.js` seperti yang terlihat di bawah ini.
```javascript
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import $ from 'jquery';
window.$ = $;
```

>Note: Tolong install ini pada terminal VS Code anda agar tidak terjadi error.

## Installation SweetAlert

Install via composer:

```
composer require realrashid/sweet-alert
```

Publish aset dari SweetAlert via Artisan:

```
php artisan sweetalert:publish
```

>Note: Tolong install ini pada terminal VS Code anda agar tidak terjadi error.

## Installation Laravel Excel

Install via composer:

```
composer require maatwebsite/excel
```

Publish file konfigurasi dengan menjalankan command script seperti di bawah ini:

```
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
```

>Note: Tolong install ini pada terminal VS Code anda agar tidak terjadi error.

## Installation Laravel PDF

Install via composer:

```
composer require barryvdh/laravel-dompdf
```

Publish file konfigurasi dengan menjalankan command script seperti di bawah ini:

```
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```


