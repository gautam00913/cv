<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="Gautier, gautier seth DJOSSOU, IFRI, Génie Logiciel, dévéloppeur web, dévéloppeur PHP">
        <meta name="author" content="Gautier Seth DJOSSOU">
        <meta name="description" content="Gautier DJOSSOU est un dévéloppeur web qui à suivi sa formation à l'IFRI de l'Université d'Abomey-Calavi">
        <meta name="image" property="og:image" content="{{ asset('images/image_gautier.jpg') }}">
        <link rel="icon" type="images/png" href="{{ asset('images/image_gautier.jpg') }}" />
        <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
        <title>{{ $title ?? 'Gautier DJOSSOU' }} | Curriculum vitea</title>
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        @vite('resources/css/app.css')
    </head>

    <body class="antialiased bg-primary/70">
        <div class="container mx-auto min-h-full">
            {{ $slot }}
        </div>

        <footer class="mt-auto bg-black text-white border-black">
            <div class="row">
                <div class="col s12 m6">
                    <ul>
                        <li> <a href=""></a></li>
                    </ul>
                </div>
            </div>
                <p class="text-center py-3">&copy; 2022 &middot; gautier seth djossou, swoftware engineer - <em>All right reserved</em></p>
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
