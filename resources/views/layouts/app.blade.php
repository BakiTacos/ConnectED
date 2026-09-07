<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ConnectED - Layanan Konseling Mahasiswa UMN')</title>
    
    <meta name="description" content="Layanan konseling kesehatan mental profesional untuk mahasiswa UMN.">
    <link rel="icon" href="https://github.com/BakiTacos/image-host/blob/main/ConnectED/logo.jpeg?raw=true" type="image/jpeg">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Global Styles --}}
    <style>
        body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #ffffff; color: #333; }
        main { min-height: 80vh; } /* Agar footer tidak naik ke tengah jika konten sedikit */
        
        /* CSS Footer Global */
        .site-footer { background-color: #537FA0; color: white; padding-top: 60px; margin-top: 100px; }
        .footer-container { max-width: 1100px; margin: 0 auto; padding: 0 20px 40px; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 40px; }
        .footer-col { flex: 1; min-width: 200px; }
        .footer-title { font-weight: 700; font-size: 1.1rem; margin-bottom: 20px; color: white; }
        .footer-text, .footer-links a { font-size: 0.9rem; line-height: 1.8; color: #e0f2fe; text-decoration: none; display: block; margin-bottom: 8px; }
        .footer-links a:hover { color: #fbbf24; text-decoration: underline; }
        .footer-icon-group { display: flex; flex-direction: column; gap: 10px; }
        .icon-row { display: flex; align-items: center; gap: 10px; font-size: 0.9rem; color: #e0f2fe; }
        .copyright-bar { border-top: 1px solid rgba(255,255,255,0.2); text-align: center; padding: 20px; font-size: 0.85rem; color: #cbd5e1; }
    </style>
    @stack('styles')
</head>

<body>

    {{-- Include Navbar --}}
    @include('partials.navbar')

    {{-- Konten Utama --}}
    <main>
        @yield('content')
    </main>

    {{-- Include Footer (Pastikan file partials/footer.blade.php ada) --}}
    @include('partials.footer')

    {{-- Scripts --}}
    <script src="{{ asset('assets/js/script.js') }}?v={{ time() }}"></script>
    @stack('scripts')
</body>
</html>