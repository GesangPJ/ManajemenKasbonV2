<!--
    Halaman dashboard untuk admin dan karyawan
    konten yang ditampilkan berdasarkan tipe akun
-->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Kasbon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <label for="month">Month:</label>
                    <select id="month" name="month" class="mr-4">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                        @endfor
                    </select>
                    <label for="year">Year:</label>
                    <select id="year" name="year" class="mr-4">
                        @for ($i = 2020; $i <= date('Y'); $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <button id="filter" class="bg-blue-500 text-white px-4 py-2 rounded">Tampilkan</button>
                </div>

                <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                    <table id="tablekasbon" class="stripe hover" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th style="width: 10%">Tanggal Jam</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Metode</th>
                                <th>S.Request</th>
                                <th>S.Bayar</th>
                                <th>Keterangan</th>
                                <th>Admin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated by DataTable -->
                        </tbody>
                    </table>
                </div><br>
            </div><br>
        </div>
    </div>

    <!-- jQuery for DataTable -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTable and add-ons -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#tablekasbon').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });

            // Filter button click event
            $('#filter').click(function() {
                var month = $('#month').val();
                var year = $('#year').val();

                console.log('Selected month:', month);
                console.log('Selected year:', year);

                $.ajax({
                    url: '{{ route("laporan-kasbon.data") }}',
                    method: 'GET',
                    data: {
                        month: month,
                        year: year
                    },
                    success: function(response) {
                        console.log('Data received:', response); // Log the response
                        if (Array.isArray(response)) {
                            table.clear().draw();
                            response.forEach(function(row) {
                                var formattedDate = moment(row.updated_at).format('YYYY-MM-DD');
                                table.row.add([
                                    formattedDate,
                                    row.user_name,
                                    row.jumlah,
                                    row.metode === 'TF' ? 'Transfer' : 'Cash',
                                    row.status_r,
                                    row.status_b,
                                    row.keterangan,
                                    row.admin_name,
                                    '<a href="/detail/' + row.id + '" class="font-medium text-blue-500 hover:underline">Detail &raquo;</a>'
                                ]).draw(false);
                            });
                        } else {
                            console.error('Unexpected data format:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', status, error);
                    }
                });
            });
        });
    </script>
</x-app-layout>
