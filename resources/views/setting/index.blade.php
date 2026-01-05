@extends('layouts.main')

@section('content')

<!-- HEADER -->
<header class="bg-gradient-to-r from-white to-white p-4 flex justify-between items-center shadow-md">
    <span class="font-semibold text-xl">Setting</span>

    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/250px-User_icon_2.svg.png" class="h-10" alt="" />
</header>

<main class="p-4 space-y-4">
    <!-- LIST MENU -->
    <section class="bg-white mt-3 rounded-2xl shadow-sm divide-y">
    <!-- ITEM -->
    <a href="{{ route('playstation.index') }}" class="flex items-center justify-between px-4 py-4 hover:bg-slate-50 active:bg-slate-100 transition">
        <!-- LEFT -->
        <span class="flex items-center gap-3">
            <i class="fas fa-gamepad text-xs text-slate-600 relative top-[1px]"></i>
            <span class="text-slate-600 font-medium">Playstation</span>
        </span>

        <!-- RIGHT -->
        <i class="fas fa-chevron-right text-slate-300 text-sm"></i>
    </a>

    <a href="{{ route('zone.index') }}" class="flex items-center justify-between px-4 py-4 hover:bg-slate-50 active:bg-slate-100 transition">
        <!-- LEFT -->
        <span class="flex items-center gap-3">
            <i class="fas fa-tag text-slate-600 relative top-[1px]"></i>
            <span class="text-slate-600 font-medium">Zone</span>
        </span>

        <!-- RIGHT -->
        <i class="fas fa-chevron-right text-slate-300 text-sm"></i>
    </a>

    <a href="{{ route('food.index') }}" class="flex items-center justify-between px-4 py-4 hover:bg-slate-50 active:bg-slate-100 transition">
        <!-- LEFT -->
        <span class="flex items-center gap-3">
            <i class="fas fa-utensils text-slate-600 relative top-[1px]"></i>
            <span class="text-slate-600 font-medium">F&B</span>
        </span>

        <!-- RIGHT -->
        <i class="fas fa-chevron-right text-slate-300 text-sm"></i>
    </a>

    <a
        href="#"
        class="flex items-center justify-between px-4 py-4 hover:bg-slate-50 active:bg-slate-100 transition"
    >
        <!-- LEFT -->
        <span class="flex items-center gap-3">
        <i
            class="fas fa-users text-slate-600 text-xs relative top-[1px]"
        ></i>
        <span class="text-slate-600 font-medium">Customer</span>
        </span>

        <!-- RIGHT -->
        <i class="fas fa-chevron-right text-slate-300 text-sm"></i>
    </a>

    <a
        href="#"
        class="flex items-center justify-between px-4 py-4 hover:bg-slate-50 active:bg-slate-100 transition"
    >
        <!-- LEFT -->
        <span class="flex items-center gap-3">
        <i class="fas fa-user text-slate-600 relative top-[1px]"></i>
        <span class="text-slate-600 font-medium">User</span>
        </span>

        <!-- RIGHT -->
        <i class="fas fa-chevron-right text-slate-300 text-sm"></i>
    </a>
    </section>

    <!-- SPACER -->
    <div class="flex-1"></div>

    <!-- LOGOUT -->
    <div class="pb-6">
    <button
        class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-semibold shadow active:scale-95 transition"
    >
        <i class="fas fa-sign-out"></i> Logout
    </button>
    </div>
</main>

@include('home.create')
@include('layouts.navbar')

@endsection