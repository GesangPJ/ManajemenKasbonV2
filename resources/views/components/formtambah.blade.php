<div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
    <form method="POST" action="/tambah-kasbon">
        @csrf
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
