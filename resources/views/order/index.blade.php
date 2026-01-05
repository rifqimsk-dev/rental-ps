@extends('layouts.main')

@section('content')

<!-- HEADER -->
<header class="bg-gradient-to-r from-white to-white p-4 flex justify-between items-center shadow-md">
    <span class="font-semibold text-xl">Orderan</span>

    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/250px-User_icon_2.svg.png" class="h-10" alt="" />
</header>

<main class="space-y-4 pt-3">
    <!-- TAB HEADER -->
      <div class="border-b border-slate-200">
        <nav class="flex">
          <button
            class="tab-btn flex-1 py-4 text-sm font-medium transition-all border-b-2 border-slate-500 text-slate-700 bg-white"
          >
            <i class="fas fa-gamepad"></i> PS
          </button>

          <button
            class="tab-btn flex-1 py-4 text-sm font-medium transition-all border-b-2 border-transparent text-slate-400 hover:text-slate-600"
          >
            <i class="fas fa-utensils"></i> Makanan
          </button>
        </nav>
      </div>

      <!-- TAB CONTENT -->
      <div class="p-4">
        <!-- ORDER PS -->
        <div class="tab-content">
            <div class="overflow-x-auto bg-white border border-slate-200 rounded-xl shadow-sm">
                <table class="min-w-full text-xs text-slate-600">
                    <!-- TABLE HEAD -->
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-3 py-2 text-left font-medium text-slate-500 uppercase tracking-wider">Customer</th>
                            <th class="px-3 py-2 text-center font-medium text-slate-500 uppercase tracking-wider">Order</th>
                            <th class="px-3 py-2 text-center font-medium text-slate-500 uppercase tracking-wider">Price</th>
                            <th class="px-3 py-2 text-right font-medium text-slate-500 uppercase tracking-wider">Total</th>
                            <th class="px-3 py-2 text-center font-medium text-slate-500 uppercase tracking-wider"></th>
                        </tr>
                    </thead>
                    
                    <!-- TABLE BODY -->
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($transaction as $row)
                        @php
                            $color = match($row->status) {
                                'running'   => 'emerald',
                                'finished'  => 'blue',
                                default     => 'slate'
                            };
                        @endphp
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-3 py-2 text-slate-700">{{ $row->customer_name }}</td>
                            <td class="px-3 py-2 text-center">{{ $row->playstation->type }} x{{ (int)$row->total_hours }} jam</td>
                            <td class="px-3 py-2 text-center">{{ number_format($row->hourly_rate,0,",",".") }}</td>
                            <td class="px-3 py-2 text-right font-medium text-slate-700">{{ number_format($row->total_price,0,",",".") }}</td>
                            <td class="px-3 py-1 text-center">
                                <span class="inline-flex items-center text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700 rounded-full">
                                    <span class="w-2 h-2 bg-{{ $color }}-500 rounded-full"></span>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

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
</main>

@include('home.create')
@include('layouts.navbar')

@endsection