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
                        <td style="width: 18%"><!--
                            Membatasi hanya 20 karakter yang ditampilkan
                            -->
                            {{Str::limit($kasbon['keterangan'],40)}}</td>
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

            <table id="tablekaryawan" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th style="width: 2%">#</th>
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
                        <td style="width: 2%"></td>
                        <td style="width: 12%" class="text-left">{{$kasbon['updated_at']}}</td>
                        <td style="width: 20%" class="text-left">{{$kasbon['user_name']}}</td>
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
                        <td>{{Str::limit($kasbon['keterangan'],50)}}</td>
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
    <!-- jQuery untuk tabel-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- non jquery styling-->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

<!-- datatables option and addons-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.3.1/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json"></script>


<script>
    $(document).ready(function() {
    var table = $('#tablekasbon').DataTable({
        language: {
            url: '/datatables/id.json',
    },
        responsive: true,
        paging: true,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        layout:{
            top3Start:{
                buttons: [
                    {
                        extend: 'pdf',
                        text: 'Simpan Ke PDF',
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Simpan Ke Excel',
                        autoFilter: true,
                    },
                    {
                        extend: 'print',
                        text: 'Print Tabel',
                        //autoPrint: false
                    }
                ],
            },
            bottomEnd:'paging'
        },
        columnDefs: [
            { orderable: false, targets: [0,9] }
        ],
        order: [],
        info:true,
        rowCallback: function(row, data, index) {
            $('td:eq(0)', row).html(index + 1);
        }
    });

    table.columns.adjust().responsive.recalc();
});
</script>
<script>
    $(document).ready(function() {
    var table = $('#tablekaryawan').DataTable({
        language: {
            url: '/datatables/id.json',
    },
        responsive: true,
        paging: true,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        layout:{
            top3Start:{
                buttons: [
                    {
                        extend: 'pdf',
                        text: 'Simpan Ke PDF',
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Simpan Ke Excel',
                        autoFilter: true,
                    },
                    {
                        extend: 'print',
                        text: 'Print Tabel',
                        //autoPrint: false
                    }
                ],
            },
            bottomEnd:'paging'
        },
        columnDefs: [
            { orderable: false, targets: [0,7] }
        ],
        order: [],
        info:true,
        rowCallback: function(row, data, index) {
            $('td:eq(0)', row).html(index + 1);
        }
    });

    table.columns.adjust().responsive.recalc();
});
</script>

</x-app-layout>

