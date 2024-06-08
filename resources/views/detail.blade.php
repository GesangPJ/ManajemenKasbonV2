<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!--
            Menentukan header yang ditampilkan untuk admin atau karyawan
            -->

                {{ __('Detail Kasbon ')}} {{$kasbon['id']}} | {{$kasbon['user_name']}}

        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-1 text-xl font-bold text-grey-800">
                        Nama : {{$kasbon['user_name']}}
                    </h3><br>
                    <h3 class="mb-1 text-xl font-bold text-grey-800">
                        Jumlah Kasbon : Rp{{ number_format($kasbon['jumlah'], 0, ',', '.') }}
                    </h3><br>
                    <h3 class="mb-1 text-xl font-bold text-grey-800">
                        Metode Pembayaran : @if($kasbon['metode']=='TF')
                        Transfer
                        @elseif($kasbon['metode']=='CA')
                        Cash
                        @endif
                    </h3><br>
                    <h3 class="mb-1 text-xl font-bold text-grey-800">
                        Status Request : {{$kasbon['status_r']}}
                    </h3><br>
                    <h3 class="mb-1 text-xl font-bold text-grey-800">
                        Status Bayar : {{$kasbon['status_b']}}
                    </h3><br>
                    <h3 class="mb-1 text-xl font-bold text-grey-800">
                        Tanggal Permintaan : {{$kasbon['created_at']}}
                    </h3><br>
                    <h3 class="mb-1 text-xl font-bold text-grey-800">
                        Tanggal Perubahan : {{$kasbon['updated_at']}}
                    </h3><br>

                    <a href="/dashboard" class="font-medium text-blue-500 hover:underline">&laquo; Kembali</a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
