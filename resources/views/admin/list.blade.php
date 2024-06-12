 <!--
   Halaman view daftar pengguna
-->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Pengguna') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6 text-gray-900">
                    {{ __(" ") }}
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
                </div>
            </div><br>
            <!--
            Jika admin maka tampilkan tabel dibawah ini
            -->
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

                <table id="tablekasbon" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    @csrf
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-left">ID</th>
                            <th data-priority="2" class="text-left">Nama</th>
                            <th data-priority="3" class="text-left">Email</th>
                            <th data-priority="4">Status Pengguna</th>
                            <th data-priority="5" class="text-right" style="width: 8%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--
                        Menampilkan data dari view kasbonview
                        -->
                        @foreach ($daftaruser as $user )
                    <tr>
                        <td style="width: 1%">{{$user['id']}}</td>
                        <td style="width: 15%">{{$user['name']}}</td>
                        <td style="width: 15%">{{$user['email']}}</td>
                        <td style="width: 5%">
                            <div class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full

                                @if ($user['is_admin'] == true)
                                    text-green-700 bg-green-100 border border-green-300
                                @else
                                    text-gray-700 bg-gray-100 border border-gray-300
                                @endif
                            ">
                            <div class="text-s font-normal leading-none max-w-full flex-initial">
                                @if ($user['is_admin']==true)
                                Admin
                                @elseif ($user['is_admin']==false)
                                Karyawan
                                @endif
                            </div>
                            </div>
                        </td>
                        <td class="text-right" style="width: 8%">

                        </td>

                    </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
                </tbody>
        </div>
        </div>
    </div>
</x-app-layout>


<!-- jQuery untuk tabel-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- non jquery styling-->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

<!-- datatables option and addons-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></scrip>
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
            { orderable: false, targets: [0,8] }
        ],
        order: [],
        info:true,
    });

    table.columns.adjust().responsive.recalc();
});
</script>
