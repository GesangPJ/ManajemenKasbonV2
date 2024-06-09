<!--
    Halaman View Request untuk admin
    Jika ada request kasbon baru, masuk disini,
    admin menentukan apakah kasbon disetujui atau tidak
-->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!--
            Menentukan header yang ditampilkan untuk admin atau karyawan
            -->
                {{ __('Persetujuan Request') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                            <th data-priority="1" class="text-left">Tanggal Jam</th>
                            <th data-priority="2" class="text-left">Nama</th>
                            <th data-priority="3">Jumlah</th>
                            <th data-priority="4">Metode</th>
                            <th data-priority="5" style="width: 5%">S.Request</th>
                            <th data-priority="6" class="text-left" style="width: 10%">Keterangan</th>
                            <th data-priority="7" class="text-left" style="width: 10%">Persetujuan</th>
                            <th data-priority="8" class="text-right" style="width: 8%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--
                        Menampilkan data dari view kasbonview
                        -->
                        @foreach ($requestkasbon as $kasbon )
                    <tr>

                        <td style="width: 10%">{{$kasbon['updated_at']}}</td>
                        <td style="width: 15%">{{$kasbon['user_name']}}</td>
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
                        <td style="width: 10%"><!--
                            Membatasi hanya 20 karakter yang ditampilkan
                            -->
                            {{Str::limit($kasbon['keterangan'],20)}}</td>
                            <td>
                                <form action="{{ route('edit-request', ['kasbonId' => $kasbon['id']]) }}" method="POST" id="form-{{ $kasbon['id'] }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" id="status-{{ $kasbon['id'] }}">
                                    <button type="button" data-id="{{ $kasbon['id'] }}" data-status="setuju"
                                        class="status-button inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-green-500 border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700"
                                        onclick="updateStatus('{{ $kasbon['id'] }}', 'setuju')">
                                        Setuju
                                    </button>
                                    <button type="button" data-id="{{ $kasbon['id'] }}" data-status="tolak"
                                        class="status-button inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-red-500 border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700"
                                        onclick="updateStatus('{{ $kasbon['id'] }}', 'tolak')">
                                        Tolak
                                    </button>
                                </form>
                            </td>
                        <td class="text-right" style="width: 8%">
                            <a href="/detail/{{$kasbon['id']}}" class="font-medium text-blue-500 hover:underline">Detail &raquo;</a>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#tablekasbon').DataTable({
                responsive: true
            })
            .columns.adjust()
            .responsive.recalc();
    });

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

    function updateStatus(kasbonId, status) {
        document.getElementById('status-' + kasbonId).value = status;
        document.getElementById('form-' + kasbonId).submit();
    }


</script>
