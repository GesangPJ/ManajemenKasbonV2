<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Request Kasbon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
                <form method="POST" action="/tambah-kasbon">
                    @csrf
                    <p>User ID : {{ Auth::user()->id }}
                    <div class="mb-4">
                        <label for="jumlah" class="block text-gray-700 font-medium mb-2">Jumlah Kasbon (Rp) </label>
                        <input type="number" id="jumlah" name="jumlah"
                            class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                    </div>
                    <div class="mb-4">
                        <label for="metode" class="block text-gray-700 font-medium mb-2">Metode Pembayaran</label>
                        <select id="metode" name="metode"
                            class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-500" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="TF">Transfer</option>
                            <option value="CA">Cash</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="block text-gray-700 font-medium mb-2">Keterangan</label>
                        <textarea id="keterangan" name="keterangan"
                            class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" rows="5"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Kirim Permintaan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
