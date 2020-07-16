# Aplikasi Absen Online (SIALAN)

Aplikasi yang dibutuhkan:
1. [Composer](https://getcomposer.org/download/)
2. [nodejs](https://nodejs.org/en/download/) [optional]
3. [XAMPP/PHP&MYSQL](https://www.apachefriends.org/download.html)

Cara :
1. Install aplikasi yang dibutuhkan
2. Buka terminal / cmd masuk ke directory project
3. Run ```composer install```
4. Run MYSQL server dan buat database dengan nama sialan (boleh yang lain -> ganti configurasinya di file .env)
5. Run migrasi DB ```php artisan migrate```
6. Run server ```php artisan serve```
