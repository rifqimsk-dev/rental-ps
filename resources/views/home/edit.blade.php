<div id="editModal"
    onclick="closeEditModal()"
    class="fixed inset-0 z-50 flex items-center justify-center
        bg-black/50 opacity-0 pointer-events-none
        transition-opacity duration-300 ease-out">

    <div
    onclick="event.stopPropagation()"
    class="bg-white w-full max-w-md rounded-lg p-6
            transform scale-95 translate-y-4
            transition-all duration-300 ease-out
            modal-content">

    <h2 class="text-lg font-semibold mb-4">Tambah Jam Main</h2>

    <form method="POST" action="{{ route('transaction.update') }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="transaction_id" id="transaction_id">

        <div class="mb-4">
        <label class="block text-sm mb-1">Tambah Jam</label>
        <select name="additional_hours"
            class="w-full border border-slate-300 rounded-lg px-3 py-2">
            @for ($i=1; $i <= 12; $i++)
            <option value="{{ $i }}">{{ $i }} Jam</option>
            @endfor
        </select>
        </div>

        <div class="flex justify-end gap-2">
        <button type="button"
            onclick="closeEditModal()"
            class="px-4 py-2 bg-gray-300 rounded">
            Batal
        </button>
        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded">
            Simpan
        </button>
        </div>
    </form>
    </div>
</div>