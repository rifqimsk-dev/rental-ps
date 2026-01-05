<!-- MODAL -->
<div id="addModal" class="fixed inset-x-0 bottom-0 top-16 z-50 bg-white rounded-t-2xl shadow-xl transform translate-y-full transition-transform duration-300 ease-out">
    <div class="flex justify-between items-center p-4 mb-4">
        <h3 class="font-semibold text-slate-700">Order Baru</h3>
        <button onclick="closeModal()" class="text-slate-400 text-xl">
            &times;
        </button>
    </div>

    <div class="mx-auto bg-white shadow-sm border border-slate-200">
        <!-- TAB HEADER -->
        <div class="border-b border-slate-200">
            <nav class="flex">
                <button class="tab-btn flex-1 py-4 text-sm font-medium transition-all border-b-2 border-slate-500 text-slate-700 bg-slate-50">Order PS</button>

                <button class="tab-btn flex-1 py-4 text-sm font-medium transition-all border-b-2 border-transparent text-slate-400 hover:text-slate-600">Order Makanan</button>
            </nav>
        </div>

        <!-- TAB CONTENT -->
        <div class="p-6">
            <!-- ORDER PS -->
            <div class="tab-content">
                <form action="{{ route('transaction.store') }}" method="post">
                    @csrf
                    <input type="text" name="customer_name" placeholder="Nama Pelanggan" value="{{ old('customer_name') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400"/>
                    @error('customer_name')
                        <span class="text-xs text-rose-500">{{ $message }}</span>
                    @enderror

                    <select name="playstation_id" class="mt-4 w-full border border-slate-300 rounded-lg px-3 py-2">
                        <option value="" selected disabled>Pilih PS</option>
                        @foreach ($playstation as $row)
                            <option value="{{ $row->id }}">{{ $row->type }}</option>
                        @endforeach
                    </select>
                    @error('playstation_id')
                        <span class="text-xs text-rose-500">{{ $message }}</span>
                    @enderror

                    <select name="total_hours" class="mt-4 w-full border border-slate-300 rounded-lg px-3 py-2">
                        <option>Durasi</option>
                        @for ($i=1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }} Jam</option>
                        @endfor
                    </select>
                    @error('total_hours')
                        <span class="text-xs text-rose-500">{{ $message }}</span>
                    @enderror

                    <input type="time" name="start_time" placeholder="Start Time" value="{{ old('start_time') }}" class="mt-4 w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400"/>
                    @error('start_time')
                        <span class="text-xs text-rose-500">{{ $message }}</span>
                    @enderror

                    <select name="zone_id" class="mt-4 w-full border border-slate-300 rounded-lg px-3 py-2">
                        <option value="" selected disabled>Pilih Zona</option>
                        @foreach ($zone as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                    @error('zone_id')
                        <span class="text-xs text-rose-500">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">Mulai Main</button>
                </form>
            
            </div>

            <!-- ORDER MAKANAN -->
            <div class="tab-content hidden">
            <h2 class="text-base font-semibold text-slate-700 mb-4">
                Order Makanan
            </h2>

            <div class="space-y-3">
                <div
                class="flex justify-between items-center p-4 border border-slate-200 rounded-lg"
                >
                <span class="text-sm text-slate-600">🍕 Pizza</span>
                <span class="text-sm font-medium text-slate-700">
                    Rp 45.000
                </span>
                </div>

                <div
                class="flex justify-between items-center p-4 border border-slate-200 rounded-lg"
                >
                <span class="text-sm text-slate-600">🍟 Kentang Goreng</span>
                <span class="text-sm font-medium text-slate-700">
                    Rp 20.000
                </span>
                </div>

                <div
                class="flex justify-between items-center p-4 border border-slate-200 rounded-lg"
                >
                <span class="text-sm text-slate-600">🥤 Es Teh</span>
                <span class="text-sm font-medium text-slate-700"> Rp 8.000 </span>
                </div>
            </div>
            </div>
        </div>
    </div>

</div>