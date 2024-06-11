# MANAJEMEN KASBON v2

Aplikasi Manajemen Kasbon v2.0 adalah penerus versi pertama menggunakan NextJS, versi 2.0 ini menggunakan Laravel 11 yang lebih mudah di deploy di hostingan
indonesia. 

## FITUR

### ADMIN PAGE

**1.Admin Dashboard :** Halaman dashboard untuk admin yang berisi kumpulan data kasbon karyawan, baik yang request setuju, belum atau tolak, dan juga status bayar
bayar belum lunas atau sudah lunas, berikut adalah field yang ada di tabel dashboard admin :
- `nama` : adalah nama karyawan.
-  `jumlah` : Jumlah kasbon yang diminta.
- `metode` : Metode pembayaran kasbon yang dipilih oleh karyawan.
- `S.Request` : Status permintaan kasbon `[belum, setuju, tolak]`
- `S.Bayar` : Status pembayaran kasbon `[belum, lunas]`.
- `Keterangan` : Keterangan yang diberikan oleh peminta kasbon.
- `Admin` : Admin terakhir yang mengubah data kasbon, data yang diubah admin adalah **status request** dan **status bayar**.

