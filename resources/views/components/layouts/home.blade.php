<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="application-name" content="{{ config('app.name') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"
        content="Gautier, gautier seth DJOSSOU, IFRI, Génie Logiciel, dévéloppeur web, dévéloppeur PHP, Laravel, Livewire, Tailwind CSS, Alpine.js, portfolio, projets, compétences, contact" />
    <meta name="author" content="Gautier Seth DJOSSOU">
    <meta name="description"
        content="Gautier DJOSSOU est un dévéloppeur web qui à suivi sa formation à l'IFRI de l'Université d'Abomey-Calavi, Bénin">
    <meta name="image" property="og:image" content="{{ asset('images/image_gautier.jpg') }}">
    <link rel="icon" type="images/png" href="{{ asset('images/image_gautier.jpg') }}" />
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <title>{{ $title ?? 'Gautier DJOSSOU' }} | Mon portfolio</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-primary/70">
    <div
        class="text-xs absolute top-2 right-2 z-50 flex items-center gap-2 bg-white/90 backdrop-blur-sm rounded-full px-3 py-2 shadow-lg">
        <span class="text-gray-500">{{ __('messages.language') }}:</span>
        <a href="{{ route('locale', 'fr') }}"
            class="@if(app()->getLocale() == 'fr') font-bold text-primary @else text-gray-500 hover:text-primary @endif transition-colors">FR</a>
        <span class="text-gray-300">|</span>
        <a href="{{ route('locale', 'en') }}"
            class="@if(app()->getLocale() == 'en') font-bold text-primary @else text-gray-500 hover:text-primary @endif transition-colors">EN</a>
    </div>

    <div class="container mx-auto min-h-full">
        {{ $slot }}
    </div>

    <footer x-data class="mt-auto bg-black text-white border-black relative">
        <p class="text-center py-3">{{ __('messages.copyright') }}</p>
        <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="absolute -top-6 right-2 bg-primary hover:bg-primary/90 text-white rounded-full p-3 shadow-lg transition-all duration-300 hover:scale-110"
            title="{{ __('messages.scroll_to_top') }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
            </svg>
        </button>
    </footer>
    @vite('resources/js/app.js')
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
                AOS.init({ duration: 800 });
            });

            document.addEventListener('livewire:navigated', () => {
                AOS.refreshHard();
            });

            window.Livewire?.hook('commit', ({ component }) => {
                if (component.el.querySelector('[data-aos]')) {
                    // On attend un tout petit peu que le DOM soit prêt
                    setTimeout(() => AOS.refreshHard(), 100);
                }
            });
    </script>
</body>

</html>