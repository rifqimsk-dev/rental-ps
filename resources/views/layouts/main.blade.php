<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"/>
  </head>

  <body class="bg-slate-100 text-slate-700">
    
    @yield('content')

    <!-- BACKDROP -->
    <div id="modalBackdrop" class="fixed inset-0 bg-slate-900 bg-opacity-40 opacity-0 pointer-events-none transition-opacity duration-300" onclick="closeModal()"></div>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/edit-order-modal.js') }}"></script>
    <script src="{{ asset('assets/js/tab.js') }}"></script>
    <script src="{{ asset('assets/js/timer.js') }}"></script>
  </body>
</html>
