<!-- MODAL -->
<div id="addModal" class="fixed inset-x-0 bottom-0 top-16 z-50 bg-white rounded-t-2xl shadow-xl transform translate-y-full transition-transform duration-300 ease-out">
    <div class="flex justify-between items-center p-4 mb-4">
        <h3 class="font-semibold text-slate-700">Order Baru</h3>
        <button onclick="closeModal()" class="text-slate-400 text-xl">
            &times;
        </button>
    </div>

    <div class="mx-auto bg-white shadow-sm border-t border-slate-200">
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
                <h2 class="text-base text-slate-700 mb-4">
                    Pilih Makanan
                </h2>

                <div class="space-y-3" id="foodList">
                    @foreach ($food as $row)
                    <div class="flex items-center justify-between p-4 border border-slate-200 rounded-xl bg-white" data-id="{{ $row->id }}" data-name="{{ $row->name }}" data-price="{{ $row->price }}">
                        <!-- INFO -->
                        <div>
                            <p class="text-sm font-medium text-slate-700">{{ $row->name }}</p>
                            <p class="text-xs text-slate-500">Rp {{ number_format($row->price,0,",",".") }}</p>
                        </div>
                        <!-- QTY CONTROL -->
                        <div class="flex items-center gap-3">
                            <button class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-600 active:scale-95" onclick="changeQty(this, -1)">−</button>
                            <span class="w-6 text-center text-sm font-semibold qty">0</span>
                            <button class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-600 text-white active:scale-95" onclick="changeQty(this, 1)">+</button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- FOOTER ORDER -->
                <form action="{{ route('transaction.food') }}" method="post" id="orderForm" class="fixed bottom-20 left-0 right-0 bg-white p-4">
                     @csrf
                     <input type="hidden" name="items" id="orderItems">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-slate-500">Total</span>
                        <span id="grandTotal" class="font-semibold text-slate-800">Rp 0</span>
                    </div>

                    <button onclick="submitOrder()" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">🧾 Order</button>
                </form>

            </div>
        </div>
    </div>

</div>

<script>
function changeQty(btn, delta) {
  const card = btn.closest('[data-id]');
  if (!card) return;

  const qtyEl = card.querySelector('.qty');
  if (!qtyEl) return;

  let qty = parseInt(qtyEl.textContent) || 0;
  qty = Math.max(0, qty + delta);
  qtyEl.textContent = qty;

  // 🔥 TOGGLE BORDER KETIKA QTY >= 1
  if (qty >= 1) {
    card.classList.add(
      'border-blue-500',
      'ring-2',
      'ring-blue-200'
    );
    card.classList.remove('border-slate-200');
  } else {
    card.classList.remove(
      'border-blue-500',
      'ring-2',
      'ring-blue-200'
    );
    card.classList.add('border-slate-200');
  }

  updateTotal();
}


function updateTotal() {
  let total = 0;

  document.querySelectorAll('[data-id]').forEach(item => {
    const qtyEl = item.querySelector('.qty');
    if (!qtyEl) return; // ⛔ skip jika tidak ada qty

    const price = parseInt(item.dataset.price);
    const qty = parseInt(qtyEl.textContent) || 0;

    total += price * qty;
  });

  document.getElementById('grandTotal').textContent =
    'Rp ' + total.toLocaleString('id-ID');
}

function submitOrder() {
  let items = [];

  document.querySelectorAll('#foodList [data-id]').forEach(item => {
    const qtyEl = item.querySelector('.qty');
    if (!qtyEl) return;

    const qty = parseInt(qtyEl.textContent) || 0;
    if (qty > 0) {
      items.push({
        id: item.dataset.id,
        name: item.dataset.name,
        price: parseInt(item.dataset.price),
        qty: qty
      });
    }
  });

  if (!items.length) {
    alert('Pilih minimal 1 item');
    return;
  }

  document.getElementById('orderItems').value = JSON.stringify(items);
  document.getElementById('orderForm').submit();
}

</script>
