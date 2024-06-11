<!--
    Halaman custom registrasi pengguna
-->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrasi Akun Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
                <form method="POST" action="/tambah-akun">
                    @csrf
                    <!-- Alert Messages -->
                        @if (session('success'))
                        <div id="success-alert" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 " role="alert">
                            <span class="font-medium"></span> {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div id="error-alert" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                            <span class="font-medium"></span> {{ session('error') }}
                        </div>
                    @endif
                    <br>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nama Pengguna</label>
                        <input type="text" id="name" name="name" placeholder="Masukkan nama pengguna"
                            class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Alamat E-mail</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan Alamat E-Mail"
                            class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan Password Akun Pengguna"
                            class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                    </div>
                    <div class="mb-4">
                        <label for="is_admin" class="block text-gray-700 font-medium mb-2">Tipe Akun</label>
                        <select id="is_admin" name="is_admin"
                            class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-500" required>
                            <option value="">Pilih Tipe Akun</option>
                            <option value=0>Karyawan</option>
                            <option value=1>Admin</option>
                        </select>
                    </div>
                    <div><br>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Daftar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to hide the alert after 3 seconds -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the alert elements
            var successAlert = document.getElementById('success-alert');
            var errorAlert = document.getElementById('error-alert');

            // Set timeout to hide the alerts after 3 seconds
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 3000);
            }

            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</x-app-layout>



