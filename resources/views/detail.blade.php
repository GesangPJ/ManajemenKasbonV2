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

            </div><br>
                <button type="button" class="text-white ml-20 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-8 h-6 me-2" aria-hidden="true" version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .linesandangles_een{fill:#ffffff;} </style> <path class="linesandangles_een" d="M25,9V3H7v6H4v12h3v9h18v-9h3V9H25z M9,5h14v4H9V5z M23,28H9v-9h14V28z M26,19h-1v-2H7v2H6v-8 h20V19z M8,12h2v2H8V12z M11,12h2v2h-2V12z M21,23H11v-2h10V23z M21,26H11v-2h10V26z"></path> </g></svg>
                    Print
                    </button>


        </div>
    </div>
</x-app-layout>
