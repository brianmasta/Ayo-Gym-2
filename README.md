# Aplikasi Manajemen Gym

Aplikasi manajemen gym berbasis web yang dibuat dengan Laravel Livewire, memungkinkan gym untuk mengelola member, pembayaran, dan rencana keanggotaan (membership). Aplikasi ini menyediakan berbagai fitur seperti pendaftaran member, pembayaran dengan Midtrans, dan manajemen data member yang mudah.

## Fitur

- **Pendaftaran Member**: Proses pendaftaran member gym baru, baik yang sudah menjadi member atau non-member.
- **Pembayaran**: Mendukung pembayaran via tunai (cash) maupun Midtrans (virtual payment gateway).
- **Manajemen Keanggotaan**: Pengelolaan rencana keanggotaan dengan berbagai pilihan paket harga dan durasi.
- **QR Code untuk Validasi Member**: Penggunaan QR code untuk memvalidasi status keanggotaan member saat mereka masuk gym.
- **Dashboard Kasir**: Kasir dapat memproses pembayaran, melihat daftar member dan transaksi mereka.
- **Cetak Bukti Pembayaran**: Fitur untuk mencetak bukti pembayaran member dan non-member.

## Teknologi yang Digunakan

- **Laravel**: Framework PHP untuk membangun aplikasi web.
- **Livewire**: Framework full-stack untuk Laravel yang memungkinkan interaksi dinamis tanpa menulis banyak JavaScript.
- **Midtrans**: Payment gateway untuk transaksi online yang terintegrasi.
- **Bootstrap**: Framework CSS untuk membuat UI responsif dan modern.
- **QR Code**: Digunakan untuk validasi member di gym. [html5-qrcode](https://github.com/mebjas/html5-qrcode)

## Teknologi yang Digunakan

Jika kamu ingin berkontribusi pada project ini, silakan fork repository ini dan buat pull request dengan penjelasan fitur atau perbaikan yang kamu buat.

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi ini secara lokal:

1. **Clone repository ini**:
   ```bash
   git clone https://github.com/username/repository.git](https://github.com/brianmasta/Ayo-Gym.git
   ```
2. **Masuk ke Direktori Project**:

   Setelah repository berhasil diclone, masuk ke dalam direktori project:
      ```bash
      cd nama-folder
      ```
4. **Instal Dependensi dengan Composer**:

    Pastikan kamu sudah menginstal Composer pada sistem kamu. Kemudian, jalankan perintah berikut untuk menginstal semua dependensi project:
      ```bash
      composer install
      ```
5. **Generate Kunci Aplikasi**:

    Laravel memerlukan kunci aplikasi untuk mengenkripsi data. Jalankan perintah berikut untuk menghasilkan kunci aplikasi:
      ```bash
      php artisan key:generate
      ```
6. **Konfigurasi Database**:

    Buka file .env dan sesuaikan pengaturan database kamu dengan informasi database yang kamu gunakan (MySQL, SQLite, dll.). Contoh pengaturan untuk MySQL:
      ```
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=nama_database
      DB_USERNAME=nama_pengguna
      DB_PASSWORD=password
      ```
7. **Konfigurasi Database**:

    Aplikasi ini menggunakan migrasi untuk membuat struktur tabel di database. Jalankan perintah berikut untuk menjalankan migrasi:
      ```bash
      php artisan migrate
      ```
8. **Mengatur Akun Midtrans (Opsional)**:

    Jika aplikasi menggunakan pembayaran melalui Midtrans, kamu perlu mengonfigurasi API Midtrans. Ikuti langkah-langkah berikut:

    - Daftar dan buat akun di [Midtrans](https://www.midtrans.com/).

    - Dapatkan ***Client Key dan Server Key*** dari Midtrans.

    - Buka file **.env** dan tambahkan konfigurasi berikut:
      ```bash
      MIDTRANS_CLIENT_KEY=your_client_key
      MIDTRANS_SERVER_KEY=your_server_key
      ```
9. **Jalankan Aplikasi**:

    Setelah semua langkah di atas selesai, jalankan aplikasi Laravel menggunakan perintah:
      ```bash
      php artisan serve
      ```
    Aplikasi sekarang dapat diakses di http://127.0.0.1:8000.

10. **Jalankan Aplikasi**:

     Jika kamu ingin mengisi database dengan data dummy untuk testing atau pengembangan, jalankan seeder menggunakan perintah berikut:
      ```bash
      php artisan db:seed
      ```
