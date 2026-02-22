CARA INSTALASI :

1. Siapkan MySQL running. Database default : webcsirt. User Pass sesuaikan dengan masing2x. Apache./ Ngix tidak perlu, kita akan test pake spark saja.
2. Siapkan dimana akan mulai bekerja. Bebas bisa di Document atau dimana saja.
3. Mulai clone : #git clone https://github.com/sund0c/webcsirt-ci4.git
4. Setelah selesai, masuk ke folder webcsirt-ci4.
5. #composer install
6. #copy env .env
7. Isikan .env dengan konfigurasi database dan set sebagai development
8. Cek dulu, kalau tidak ada Buat folder di writable/uploads/ yaitu folder advisories,articles,guides,landing,pages,settings
9. Cek dulu, kalau tidak ada kopi 1 folder tinymce, letakkan di app/public/assets/vendor. bisa donlod di https://download.tiny.cloud/tinymce/community/tinymce_8.3.2.zip. (setelah extract, masuk ke folder js.ambil folder tinymce.
10. #npm run build
11. #php spark serve
12. #php spark migrate
13. #php spark db:seed AdminSeeder
14. #php spark db:seed DatabaseSeeder
15. untuk memulai bisa pake broweser ke http://localhost:8080/portal-internal-x83fj9/login

Note: kelengkapan bisa diunduh di https://drive.google.com/drive/folders/1U8s_3ELNKhCNwoC8E5e0UYZ9P3xyyOen?usp=sharing

\***\* PLATFORM \*\***
Ini menggunakan Codeigniter 4 agar bisa lebih cepat. Untuk keamanan sudah menggunakan kaidah secure programing OWASP. Tapi sangat2x perlu untuk ditriple check. Padukan kekuatannya dengan kekuatan server.

(C) 2026 - Sundika + Ai
