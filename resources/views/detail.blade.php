<style>
    /*Overrides for Tailwind CSS */

    /*Form fields*/
    .dataTables_wrapper select,
    .dataTables_wrapper .dataTables_filter input {
        color: #4a5568;
        /*text-gray-700*/
        padding-left: 1rem;
        /*pl-4*/
        padding-right: 1rem;
        /*pl-4*/
        padding-top: .5rem;
        /*pl-2*/
        padding-bottom: .5rem;
        /*pl-2*/
        line-height: 1.25;
        /*leading-tight*/
        border-width: 2px;
        /*border-2*/
        border-radius: .25rem;
        border-color: #edf2f7;
        /*border-gray-200*/
        background-color: #edf2f7;
        /*bg-gray-200*/
    }

    /*Row Hover*/
    table.dataTable.hover tbody tr:hover,
    table.dataTable.display tbody tr:hover {
        background-color: #3b9bf5c4;
        text-white;
        /*bg-indigo-100*/
    }

    /*Pagination Buttons*/
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        font-weight: 700;
        /*font-bold*/
        border-radius: .25rem;
        /*rounded*/
        border: 1px solid transparent;
        /*border border-transparent*/
    }

    /*Pagination Buttons - Current selected */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        color: #fff !important;
        /*text-white*/
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        /*shadow*/
        font-weight: 700;
        /*font-bold*/
        border-radius: .25rem;
        /*rounded*/
        background: #044cb8 !important;
        /*bg-indigo-500*/
        border: 1px solid transparent;
        /*border border-transparent*/
    }

    /*Pagination Buttons - Hover */
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        color: #fff !important;
        /*text-white*/
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        /*shadow*/
        font-weight: 700;
        /*font-bold*/
        border-radius: .25rem;
        /*rounded*/
        background: #099cc9 !important;
        /*bg-indigo-500*/
        border: 1px solid transparent;
        /*border border-transparent*/
    }

    /*Add padding to bottom border*/
    table.dataTable.no-footer {
        border-bottom: 1px solid #e2e8f0;
        border-b-1 border-gray-300
        margin-top: 0.75em;
        margin-bottom: 0.75em;
    }

    /*Change colour of responsive icon*/
    table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
    table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
        background-color: #099cc9 !important;
        /*bg-indigo-500*/
    }
</style>
<!--Regular Datatables CSS-->
<link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/scroller/2.4.3/css/scroller.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/searchpanes/2.3.1/css/searchPanes.dataTables.min.css" rel="stylesheet">

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
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <table id="tablekasbon" class="stripe hover" style="width:70%; padding-top: 1em;  padding-bottom: 1em;">
                    @csrf
                    <thead>
                        <tr>
                            <th data-priority="1" style="width:5%" class="text-left">DETAIL KASBON</th>
                            <th data-priority="2" style="width:5%" class="text-left">{{$kasbon['id']}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:5%" class="text-left">Nama</td>
                            <td style="width: 12%">{{$kasbon['user_name']}}</td>
                        </tr>
                        <tr>
                            <td style="width:5%" class="text-left">Jumlah Kasbon</td>
                            <td style="width: 12%">Rp{{ number_format($kasbon['jumlah'], 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td style="width:5%" class="text-left">Metode Pembayaran</td>
                            <td style="width: 12%">
                                @if($kasbon['metode']=='TF')
                        Transfer
                        @elseif($kasbon['metode']=='CA')
                        Cash
                        @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%" class="text-left">Status Request</td>
                            <td style="width: 12%" class="text-left">{{$kasbon['status_r']}}</td>
                        </tr>
                        <tr>
                            <td style="width:5%" class="text-left">Status Bayar</td>
                            <td style="width: 12%">{{$kasbon['status_b']}}</td>
                        </tr>
                        <tr>
                            <td style="width:5%" class="text-left">Admin</td>
                            <td style="width: 12%">{{$kasbon['admin_name']}}</td>
                        </tr>
                        <tr>
                            <td style="width:5%" class="text-left">Tanggal Permintaan</td>
                            <td style="width: 12%">{{$kasbon['created_at']}}</td>
                        </tr>
                        <tr>
                            <td style="width:5%" class="text-left">Tanggal Perubahan</td>
                            <td style="width: 12%">{{$kasbon['updated_at']}}</td>
                        </tr>
                        <tr>
                            <td style="width:5%" class="text-left">Keterangan</td>
                            <td style="width: 12%">{{$kasbon['keterangan']}}</td>
                        </tr>
                    </tbody>

                </table><br>
                <a href="/dashboard" class="font-medium text-blue-500 hover:underline">&laquo; Kembali</a>
                <br>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- jQuery untuk tabel-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.3.1/js/dataTables.searchPanes.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#tablekasbon').DataTable({
            layout: {
                    bottomStart: {
                        buttons: [
                            {
                                extend: 'pdf',
                                text: 'Simpan Ke PDF',
                            },
                            {
                                extend:'spacer',

                            },
                            {
                                extend: 'excelHtml5',
                                text: 'Simpan Ke Excel',
                                autoFilter: true,
                            },
                            {
                                extend:'spacer',
                            },
                            {
                                extend: 'print',
                                text: 'Print Tabel',
                                //autoPrint: false
                            },
                        ],

                    }
                },
                responsive: true,
                ordering: false,
                searching: false,
                paging: false,
            })
            .columns.adjust()
            .responsive.recalc();
    });
</script>

