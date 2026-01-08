@extends('layouts.main')

@section('content')

<!-- HEADER -->
<header class="bg-gradient-to-r from-white to-white p-4 flex justify-between items-center shadow-md">
    <span class="font-semibold text-xl">Orderan</span>

    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/250px-User_icon_2.svg.png" class="h-10" alt="" />
</header>

<main class="space-y-4 pt-3">
  @if (session('alert'))
    <div class="m-3 flex items-center gap-3 bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-3">
      <i class="fas fa-circle-check"></i>
      <span class="text-sm font-medium">{{ session('alert') }}</span>
    </div>
  @endif
  @if (session('failed'))
    <div class="m-3 flex items-center gap-3 bg-amber-100 border border-amber-200 text-amber-700 px-4 py-3 rounded-xl mb-3">
      <i class="fas fa-info-circle"></i>
      <span class="text-sm font-medium">{{ session('failed') }}</span>
    </div>
  @endif
  <!-- TAB HEADER -->
    <div class="border-b border-slate-200">
      <nav class="flex bg-white">
        <button
          class="tab-btn2 flex-1 py-4 text-sm font-medium transition-all border-b-2 text-white border-transparent bg-blue-500"
        >
          <i class="fas fa-gamepad"></i> PS
        </button>

        <button
          class="tab-btn2 flex-1 py-4 text-sm font-medium transition-all border-b-2 border-transparent text-slate-400"
        >
          <i class="fas fa-utensils"></i> Makanan
        </button>
      </nav>
    </div>
    
    <!-- TAB CONTENT -->
    <div class="p-4">
      <!-- ORDER PS -->
      <div class="tab-content2">
        @if ($transaction->isEmpty())
          <div class="bg-white border border-slate-200 rounded-xl p-8 text-center shadow-sm m-4">
            <div class="flex justify-center mb-4">
              <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center">
                <i class="fas fa-inbox text-blue-500 text-2xl"></i>
              </div>
            </div>
            <h3 class="text-base font-semibold text-slate-700">Belum ada data</h3>
            <p class="text-sm text-slate-500 mt-1">
              Data belum tersedia atau belum ada yang tercatat saat ini.
            </p>
          </div>
        @endif
        <div class="overflow-x-auto bg-white border border-slate-200 rounded-xl shadow-sm">
            <table class="min-w-full text-xs text-slate-600 whitespace-nowrap">
                <!-- TABLE HEAD -->
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-3 py-2 text-left font-medium text-slate-500 uppercase tracking-wider">Customer</th>
                        <th class="px-3 py-2 text-center font-medium text-slate-500 uppercase tracking-wider">Order</th>
                        <th class="px-3 py-2 text-center font-medium text-slate-500 uppercase tracking-wider">Price</th>
                        <th class="px-3 py-2 text-right font-medium text-slate-500 uppercase tracking-wider">Total</th>
                        <th class="px-3 py-2 text-right font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
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
                        <td class="px-3 py-2 text-slate-700">
                          <span class="me-1 inline-flex items-center text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700 rounded-full">
                            <span class="w-2 h-2 bg-{{ $color }}-500 rounded-full"></span>
                          </span>
                          {{ $row->customer_name }}
                        </td>
                        <td class="px-3 py-2 text-center">{{ $row->playstation->type }} x{{ (int)$row->total_hours }} jam</td>
                        <td class="px-3 py-2 text-center">{{ number_format($row->hourly_rate,0,",",".") }}</td>
                        <td class="px-3 py-2 text-right font-medium text-slate-700">{{ number_format($row->total_price,0,",",".") }}</td>
                        <td class="px-3 py-1 text-center">{{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

      </div>

      <!-- ORDER MAKANAN -->
      <div class="tab-content2 hidden">
        @if ($food_transaction->isEmpty())
          <div class="bg-white border border-slate-200 rounded-xl p-8 text-center shadow-sm m-4">
            <div class="flex justify-center mb-4">
              <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center">
                <i class="fas fa-inbox text-blue-500 text-2xl"></i>
              </div>
            </div>
            <h3 class="text-base font-semibold text-slate-700">Belum ada data</h3>
            <p class="text-sm text-slate-500 mt-1">
              Data belum tersedia atau belum ada yang tercatat saat ini.
            </p>
          </div>
        @endif
        <div class="space-y-3">
          @foreach ($food_transaction as $row)
          <div class="p-4 border border-slate-200 rounded-lg bg-white">
            <span class="text-xs text-slate-400"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('d M Y') }}</span>
            <div class="flex justify-between mt-1">
              <span class="text-sm text-slate-600">
                @foreach ($row->details as $detail)
                  {{ $detail->food_name }}@if (!$loop->last), @endif
                @endforeach
              </span>
              <span class="text-sm font-medium text-slate-700">Rp{{ number_format($row->total_price,0,",",".") }}</span>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
</main>

@include('home.create')
@include('layouts.navbar')

@endsection