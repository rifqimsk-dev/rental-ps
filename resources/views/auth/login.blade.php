<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"/>
</head>
<body class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-2xl p-6 sm:p-8">
        
        <!-- Logo / Title -->
        <div class="text-center mb-8">
            <img src="{{ asset('assets/img/logo.png') }}" width="55" class="mx-auto" alt="logo">
            <h1 class="mt-4 text-2xl font-semibold text-slate-800">
                Selamat Datang
            </h1>
            <p class="text-slate-500 text-sm">
                Silakan login untuk melanjutkan
            </p>
        </div>

        <!-- Form -->
        <form class="space-y-5" method="post" action="{{ route('login') }}">
            {{-- ALERT --}}
            @if (session('alert'))
            {{-- Akses ditolak --}}
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700 shadow-sm">
                <!-- Icon -->
                <i class="fas fa-ban mt-0.5 text-red-600"></i>
                
                <!-- Content -->
                <div>
                    <h4 class="font-semibold leading-none">Akses Ditolak</h4>
                    <p class="mt-1 text-sm">Hak akses tidak ditemukan. Silakan hubungi administrator.</p>
                </div>
            </div>
            @endif

            @error('failed')
            {{-- Login Gagal --}}
            <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700 shadow-sm">
                <!-- Icon -->
                <i class="fas fa-exclamation-triangle mt-0.5 text-red-600"></i>
                
                <!-- Content -->
                <div>
                    <h4 class="font-semibold leading-none">Login Gagal</h4>
                    <p class="mt-1 text-sm">Email atau Password yg anda masukkan salah</p>
                </div>
            </div>
            @enderror

            @csrf
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">Email</label>
                <input type="email" name="email" placeholder="Masukkan Email" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1">Password</label>
                <input type="password" name="password" placeholder="••••••••" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-slate-600">
                    <input type="checkbox" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Ingat saya
                </label>
                <a href="#" class="text-blue-600 hover:underline">Lupa password?</a>
            </div>

            <!-- Button -->
            <button type="submit" id="btn-login" class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-xl py-3 font-medium transition duration-200 shadow-md">
                Login
            </button>

        </form>

    </div>

    <script>
        document.getElementById('btn-login').addEventListener('click', function() {
            this.disabled = true;
            this.innerHTML = '<span class="fas fa-spinner fa-spin me-2"></span> Sedang verifikasi...'; // opsional
            this.closest('form').submit();
        });
    </script>

</body>
</html>
