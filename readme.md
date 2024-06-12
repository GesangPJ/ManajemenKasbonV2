# MANAJEMEN KASBON v2

<img src="https://github.com/GesangPJ/ManajemenKasbonV2/blob/main/public/image/login-page.png" width="600" height="330">

Aplikasi Manajemen Kasbon v2.0 adalah penerus versi pertama menggunakan NextJS, versi 2.0 ini menggunakan Laravel 11 yang lebih mudah di deploy di hostingan
indonesia. 

## FITUR

### A.ADMIN PAGES



**1.Admin Dashboard :** Halaman dashboard untuk admin yang berisi kumpulan data kasbon karyawan, baik yang request setuju, belum atau tolak, dan juga status bayar
bayar belum lunas atau sudah lunas, berikut adalah field yang ada di tabel dashboard admin :

<img src="https://github.com/GesangPJ/ManajemenKasbonV2/blob/main/public/image/admin-dashboard.png" width="600" height="330">

- `tanggal jam` : adalah tanggal dan jam dalam format UTC+7, nilai ini berdasarkan waktu data diubah terakhir kali.
- `nama` : adalah nama karyawan.
- `jumlah` : Jumlah kasbon yang diminta.
- `metode` : Metode pembayaran kasbon yang dipilih oleh karyawan.
- `S.Request` : Status permintaan kasbon `[belum, setuju, tolak]`
- `S.Bayar` : Status pembayaran kasbon `[belum, lunas]`.
- `Keterangan` : Keterangan yang diberikan oleh peminta kasbon.
- `Admin` : Admin terakhir yang mengubah data kasbon, data yang diubah admin adalah **status request** dan **status bayar**.

Fitur lain pada halaman Dashboard ini adalah :

1. Print Tabel.
2. Export Tabel ke PDF.
3. Export Tabel ke Excel dengan filter on.

**2. Status Request :** Adalah halaman khusus admin yang menampilkan tabel berisi permintaan kasbon yang telah disubmit oleh karyawan, tabel ini berisi field sebagai berikut :

<img src="https://github.com/GesangPJ/ManajemenKasbonV2/blob/main/public/image/admin-status-request.png" width="600" height="330">

- `tanggal jam` : adalah tanggal dan jam dalam format UTC+7, nilai ini berdasarkan waktu data diubah terakhir kali.
- `nama` : adalah nama karyawan.
- `jumlah` : Jumlah kasbon yang diminta.
- `metode` : Metode pembayaran kasbon yang dipilih oleh karyawan.
- `S.Request` : Status permintaan kasbon `[belum, setuju, tolak]`
- `Keterangan` : Keterangan yang diberikan oleh peminta kasbon.
- `Persetujuan` : Berisi dua tombol, yaitu **Setuju** dan **Tolak**.

**3. Status Bayar :** Adalah halaman khusus admin yang menampilkan tabel berisi kasbon yang telah disetujui untuk kemudian ditentukan apakah kasbon tersebut sudah lunas atau belum, tabel ini berisi field sebagai berikut :

<img src="https://github.com/GesangPJ/ManajemenKasbonV2/blob/main/public/image/admin-status-bayar.png" width="600" height="330">

- `tanggal jam` : adalah tanggal dan jam dalam format UTC+7, nilai ini berdasarkan waktu data diubah terakhir kali.
- `nama` : adalah nama karyawan.
- `jumlah` : Jumlah kasbon yang diminta.
- `metode` : Metode pembayaran kasbon yang dipilih oleh karyawan.
- `S.Request` : Status permintaan kasbon `[belum, setuju, tolak]`
- `Keterangan` : Keterangan yang diberikan oleh peminta kasbon.
- `Status Lunas` : Berisi dua tombol, yaitu **Lunas** dan **Belum**.

**4. Laporan Kasbon :** Adalah halaman yang berisi tabel seperti di dashboard, namun halaman ini hanya menampilkan data sesuai dengan bulan dan tahun yang dipilih

<img src="https://github.com/GesangPJ/ManajemenKasbonV2/blob/main/public/image/admin-laporan-kasbon.png" width="600" height="330">




<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License</a>.
