<!-- BOTTOM NAV -->
<nav class="fixed bottom-0 left-0 right-0 z-50 bg-white/90 backdrop-blur rounded-t-2xl shadow-lg border border-gray-200">
    <ul class="flex justify-around items-center py-2">
        <!-- HOME -->
        <li>
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 hover:text-blue-500 transition {{ request()->is('/') ? 'text-blue-600' : 'text-gray-500' }}">
                <i class="fas fa-house text-lg"></i>
                <span class="text-[11px] font-medium">Home</span>
            </a>
        </li>

        <!-- ORDER -->
        <li>
            <a href="{{ route('order') }}" class="flex flex-col items-center gap-1 hover:text-blue-500 transition {{ request()->is('order*') ? 'text-blue-600' : 'text-gray-500' }}">
                <i class="fas fa-file-text text-lg"></i>
                <span class="text-[11px]">Orderan</span>
            </a>
        </li>

        <!-- ADD (CENTER ACTION) -->
        <li class="-mt-8">
            <button onclick="openModal()" class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-xl active:scale-95 transition">
                <i class="fas fa-plus text-lg"></i>
            </button>
        </li>

        <!-- HISTORY -->
        <li>
            <a href="{{ route('riwayat') }}" class="flex flex-col items-center gap-1 hover:text-blue-500 transition {{ request()->is('riwayat*') ? 'text-blue-600' : 'text-gray-500' }}">
                <i class="fas fa-clock-rotate-left text-lg"></i>
                <span class="text-[11px]">Riwayat</span>
            </a>
        </li>

        <!-- PROFILE -->
        <li>
            <a href="{{ route('setting') }}" class="flex flex-col items-center gap-1 hover:text-blue-500 transition {{ request()->is('setting*') ? 'text-blue-600' : 'text-gray-500' }}">
                <i class="fas fa-cog text-lg"></i>
                <span class="text-[11px]">Setting</span>
            </a>
        </li>
    </ul>
</nav>