<!--
    Halaman dashboard untuk admin dan karyawan
    konten yang ditampilkan berdasarkan tipe akun
-->
<style>
    /* Your custom styles here */

    /* Override default DataTables styles for entries per page dropdown */
    .dataTables_length {
        display: flex;
        width: 20%;
        align-items: center;
    }

    .dataTables_length label {
        display: flex;
        align-items: center;
        gap: 1.5rem; /* Adjust spacing as needed */
    }

    .dataTables_length select {
        display: inline-block;
        width: auto; /* Ensure the width is appropriate */
        margin: 0;
        padding: 1.25rem 1.5rem; /* Adjust padding to fit with the design */
        line-height: 1.25;
        border-width: 2px;
        border-radius: 0.25rem;
        border-color: #edf2f7; /* Tailwind border-gray-200 */
        background-color: #edf2f7; /* Tailwind bg-gray-200 */
        color: #4a5568; /* Tailwind text-gray-700 */
        -webkit-appearance: none; /* Remove default styling */
        -moz-appearance: none;
        appearance: none;
    }

    /* Add custom arrow
    .dataTables_length select::-ms-expand {
        display: none;
    }*/

    .dataTables_length select::after {
        content: '▼'; /* Custom arrow */
        font-size: 0.75rem;
        color: #4a5568; /* Tailwind text-gray-700 */
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }
</style>
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!--
            Menentukan header yang ditampilkan untuk admin atau karyawan
            -->
            @if(Auth::user()->is_admin)
                {{ __('Dashboard Admin') }}
            @else
                {{ __('Dashboard Karyawan') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <!--
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Log Akun :") }}

                    <p>User ID : {{ Auth::user()->id }}
                    </p>
                    <p>Email : {{ Auth::user()->email }} </p>
                    <p>Tipe  : {{ Auth::user()->is_admin }}</p>
                </div>
            </div><br>-->

            @if(Auth::user()->is_admin)
            <!--
            Jika admin maka tampilkan tabel dibawah ini
            -->

            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

                <table id="tablekasbon" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th data-priority="1" class="text-left">Tanggal Jam</th>
                            <th data-priority="2" class="text-left">Nama</th>
                            <th data-priority="3">Jumlah</th>
                            <th data-priority="4">Metode</th>
                            <th data-priority="5" style="width: 5%">S.Request</th>
                            <th data-priority="6" style="width: 5%">S.Bayar</th>
                            <th data-priority="7" class="text-left" style="width: 10%">Keterangan</th>
                            <th data-priority="8" class="text-left">Admin</th>
                            <th data-priority="9" class="text-left" style="width: 8%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--
                        Menampilkan data dari view kasbonview
                        -->
                        @foreach ($viewkasbon as $kasbon )
                    <tr>
                        <td style="width: 2%"></td>
                        <td style="width: 12%" class="text-left">{{$kasbon['updated_at']}}</td>
                        <td style="width: 20%" class="text-left">{{$kasbon['user_name']}}</td>
                        <td style="width: 5%" class="text-left" data-sort="{{ $kasbon['jumlah'] }}">
                            <!--
                            Format angka menjadi format uang
                            -->
                            {{ number_format($kasbon['jumlah'], 0, ',', '.') }}
                        </td>
                        <td style="width: 5%">
                            <!--
                            Menentukan data yang ditampilkan, jika TF maka Transfer, Jika CA maka Cash
                            -->
                            @if($kasbon['metode']=='TF')
                            Transfer
                            @elseif($kasbon['metode']=='CA')
                            Cash
                            @endif
                        </td>
                        <td style="width: 5%">
                            <!--
                            Menentukan nilai dan style chips, jika tolak maka merah, jika setuju maka hijau, jika belum maka abu-abu
                            -->
                            <div class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full

                                @if ($kasbon['status_r'] == 'tolak')
                                    text-red-700 bg-red-100 border border-red-300
                                @elseif ($kasbon['status_r'] == 'setuju')
                                    text-green-700 bg-green-100 border border-green-300
                                @else
                                    text-gray-700 bg-gray-100 border border-gray-300
                                @endif
                            ">
                                <div class="text-s font-normal leading-none max-w-full flex-initial">{{ $kasbon['status_r'] }}</div>
                            </div>
                        </td>
                        <td style="width: 5%">
                            <!--
                            Menentukan nilai dan format chips, jika belum maka merah, jika lunas maka hijau
                            -->
                            <div class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full
                                @if ($kasbon['status_b'] == 'belum')
                                    text-red-700 bg-red-100 border border-red-300
                                @elseif ($kasbon['status_b'] == 'lunas')
                                    text-green-700 bg-green-100 border border-green-300
                                @endif
                            ">
                                <div class="text-s font-normal leading-none max-w-full flex-initial">{{ $kasbon['status_b'] }}</div>
                            </div>

                        </td>
                        <td style="width: 10%"><!--
                            Membatasi hanya 20 karakter yang ditampilkan
                            -->
                            {{Str::limit($kasbon['keterangan'],20)}}</td>
                        <td>{{$kasbon['admin_name']}}</td>
                        <td>
                            <a href="/detail/{{$kasbon['id']}}" class="font-medium text-blue-500 hover:underline">Detail &raquo;</a>
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mt-1 mb-1 font-bold">Jumlah Total Kasbon : Rp{{ number_format($kasbonSums['jumlahTotal'], 0, ',', '.') }}
                    </p>
                    <p class="mt-1 mb-1">Kasbon Sudah Lunas : Rp{{ number_format($kasbonSums['jumlahLunas'], 0, ',', '.') }}</p>
                    <p class="mt-1 mb-1">Kasbon Belum Lunas : Rp{{ number_format($kasbonSums['jumlahBelum'], 0, ',', '.') }}</p>
                </div>
            </div><br>
        </div>
        @else
        <!--
        Jika karyawan, maka tampilkan tabel yang ada dibawah ini
         -->
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

            <table id="tablekasbon" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th data-priority="1" class="text-left">Tanggal Jam</th>
                        <th data-priority="2" class="text-left">Nama</th>
                        <th data-priority="3">Jumlah</th>
                        <th data-priority="4">Metode</th>
                        <th data-priority="5" class="text-left" style="width: 5%">S.Request</th>
                        <th data-priority="6" class="text-left" style="width: 5%">S.Bayar</th>
                        <th data-priority="7" class="text-left" style="width: 20%">Keterangan</th>
                        <th data-priority="8" class="text-left" style="width: 8%"></th>
                    </tr>
                </thead>
                <tbody>
                    <!--
                            Tampilkan data sesuai dengan id karyawan : lokasi di Kasbonview Modal class viewKaryawan
                            -->
                    @foreach ($kasbonkaryawan as $kasbon )
                    <tr>
                        <td></td>
                        <td style="width: 12%">{{$kasbon['updated_at']}}</td>
                        <td style="width: 20%">{{$kasbon['user_name']}}</td>
                        <td style="width: 5%" class="text-left" data-sort="{{ $kasbon['jumlah'] }}">
                            {{ number_format($kasbon['jumlah'], 0, ',', '.') }}
                        </td>
                        <td style="width: 5%">
                            @if($kasbon['metode']=='TF')
                            Transfer
                            @elseif($kasbon['metode']=='CA')
                            Cash
                            @endif
                        </td>
                        <td style="width: 5%">
                            <div class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full
                                @if ($kasbon['status_r'] == 'tolak')
                                    text-red-700 bg-red-100 border border-red-300
                                @elseif ($kasbon['status_r'] == 'setuju')
                                    text-green-700 bg-green-100 border border-green-300
                                @else
                                    text-gray-700 bg-gray-100 border border-gray-300
                                @endif
                            ">
                                <div class="text-s font-normal leading-none max-w-full flex-initial">{{ $kasbon['status_r'] }}</div>
                            </div>
                        </td>
                        <td style="width: 5%">
                            <div class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full
                                @if ($kasbon['status_b'] == 'belum')
                                    text-red-700 bg-red-100 border border-red-300
                                @elseif ($kasbon['status_r'] == 'lunas')
                                    text-green-700 bg-green-100 border border-green-300
                                @endif
                            ">
                                <div class="text-s font-normal leading-none max-w-full flex-initial">{{ $kasbon['status_b'] }}</div>
                            </div>
                        </td>
                        <td>{{Str::limit($kasbon['keterangan'],20)}}</td>
                        <td>
                            <a href="/detail/{{$kasbon['id']}}" class="font-medium text-blue-500 hover:underline">Detail &raquo;</a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            </table>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <p class="mt-1 mb-1 font-bold">Jumlah Total Kasbon : Rp{{ number_format($totalKaryawan['totalKasbonKaryawan'], 0, ',', '.') }}
                </p>
                <p class="mt-1 mb-1">Kasbon Sudah Lunas : Rp{{ number_format($totalKaryawan['totalLunasKaryawan'], 0, ',', '.') }}</p>
                <p class="mt-1 mb-1">Kasbon Belum Lunas : Rp{{ number_format($totalKaryawan['totalBelumKaryawan'], 0, ',', '.') }}</p>
            </div>
        </div><br>

        @endif
        </div>
    </div>
</x-app-layout>
<x-datatablescript>
</x-datatablescript>


