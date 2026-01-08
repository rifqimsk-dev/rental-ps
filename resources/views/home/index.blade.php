@extends('layouts.main')

@section('content')
    <!-- HEADER -->
    <header class="bg-gradient-to-r from-white to-white text-white p-4 flex justify-between items-center shadow-md">
        <div>
            <img src="{{ asset('assets/img/logo.png') }}" class="h-8" alt="logo" />
        </div>

        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/250px-User_icon_2.svg.png" class="h-10" alt="" />
    </header>

    <main class="p-4 space-y-4 mb-20 pb-10">
      <!-- LIST ORDER -->
      <section>
        @if (session('alert'))
          <div class="flex items-center gap-3 bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-3">
            <i class="fas fa-circle-check"></i>
            <span class="text-sm font-medium">{{ session('alert') }}</span>
          </div>
        @endif
        @if (session('failed'))
          <div class="flex items-center gap-3 bg-amber-100 border border-amber-200 text-amber-700 px-4 py-3 rounded-xl mb-3">
            <i class="fas fa-info-circle"></i>
            <span class="text-sm font-medium">{{ session('failed') }}</span>
          </div>
        @endif
        <h2 class="font-semibold text-slate-600 mb-3">Order Aktif</h2>
        
        @if ($transactions->isEmpty())
        <div class="bg-white border border-slate-200 rounded-xl p-8 text-center shadow-sm">
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

        <div class="space-y-4">
          @foreach ($transactions as $transaction)
          <!-- RUNNING -->
          <div class="bg-white rounded-xl shadow-md p-4">
            <div class="flex justify-between items-center mb-2">
              <h3 class="font-semibold text-slate-800">{{ $transaction->customer_name }}</h3>
              <span
                class="inline-flex items-center gap-1.5 text-xs font-medium bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-full"
              >
                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                {{ $transaction->status }}
              </span>
            </div>

            <div class="text-sm text-slate-600 space-y-1">
              <p>🎮 {{ $transaction->playstation->type }} - {{ $transaction->zone->name }}</p>
              <p>
                ⏱ {{ (int)$transaction->total_hours }} jam ~ 
                {{ \Carbon\Carbon::parse($transaction->start_time)->format('H:i') }}  
                - 
                {{ \Carbon\Carbon::parse($transaction->end_time_estimated)->format('H:i') }}
              </p>
              <p class="font-medium text-slate-800">💰 Rp {{ number_format($transaction->total_price,0,",",".") }}</p>
            </div>

            <div class="mt-3 flex gap-2">
              <button onclick="openEditModal(this)" data-id="{{ $transaction->id }}" class="flex items-center justify-center gap-2 flex-1 bg-blue-500 hover:bg-blue-400 text-white py-2 rounded-lg text-sm transition">
                <i class="fas fa-plus"></i> Tambah
              </button>
              <form action="{{ route('transaction.finished', encrypt($transaction->id)) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menyelesaikan permainan ini ?')" class="flex flex-1">
                @csrf
                @method('PUT')
                <button class="flex items-center justify-center gap-2 flex-1 border border-emerald-500 hover:bg-emerald-400 text-emerald-500 hover:text-white py-2 rounded-lg text-sm transition">
                  {{-- <i class="fas fa-check-circle"></i> Selesai --}}
                  <span class="timer" data-endtime="{{ $transaction->end_time }}">
                    <i class="text-emerald-500"></i> <!-- ikon default -->
                    <span class="timer-text"></span>
                  </span>
                </button>
              </form>
              <form action="{{ route('transaction.cancelled', encrypt($transaction->id)) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin membatalkan permainan ini ?')" class="flex flex-1">
                @csrf
                @method('DELETE')
                <button class="flex items-center justify-center gap-2 flex-1 border border-rose-500 hover:bg-rose-400 text-rose-500 hover:text-white py-2 rounded-lg text-sm transition">
                  <i class="fas fa-times"></i> Batal
                </button>
              </form>
            </div>
          </div>
          @endforeach

        </div>
      </section>
    </main>

    @include('home.create')
    @include('home.edit')

    @include('layouts.navbar')

@endsection