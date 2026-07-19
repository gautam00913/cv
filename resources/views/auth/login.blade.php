<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login_title') }}</title>
    <meta name="image" property="og:image" content="{{ asset('images/image_gautier.jpg') }}">
    <link rel="icon" type="images/jpg" href="{{ asset('images/image_gautier.jpg') }}" />
    @vite('resources/css/app.css')
</head>
<body class="bg-primary/70">
    <div class="flex items-center justify-center h-screen">

        <div class="bg-white relative rounded-2xl p-3 md:px-10 mb-5 md:pb-5 w-11/12 md:w-1/2 lg:w-2/5 py-10">
           <h1 class="font-bold uppercase text-center mb-3 text-2xl">{{ __('messages.login') }}</h1>
           <form action="{{ route('authenticate') }}" method="POST">
                @csrf
               <div class="mb-5">
                    <label for="email" class="text-secondary mb-1 block">{{ __('messages.email') }}</label>
                    <input type="email" name="email" id="email" class="rounded-md focus:ring-2 focus:border-cyan-400 w-full px-3 py-2 border" required value="{{ old('email') }}">
                    @error('email')
                        <p><small class="text-red-500 italic">{{ $message }}</small></p>
                    @enderror
               </div>
               <div class="mb-6">
                    <label for="password" class="text-secondary mb-1 block">{{ __('messages.password') }}</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" class="rounded-md focus:ring-2 focus:border-cyan-400 w-full px-3 py-2 border pr-10" required value="{{ old('password') }}">
                        <button type="button" id="togglePassword" aria-label="{{ __('messages.toggle_password') }}" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.428M6.18 6.18A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.99 9.99 0 01-4.167 5.236M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p><small class="text-red-500 italic">{{ $message }}</small></p>
                    @enderror
               </div>
               <div class="mb-5">
                    <x-button type="submit" class="w-full md:w-1/2 mx-auto block">{{ __('messages.sign_in') }}</x-button>
               </div>
               <p class="flex items-center justify-between">
                    <a href="/" class="text-primary flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                       {{ __('messages.back_to_home') }}
                    </a>
                    <a href="{{ route('password.forget') }}" class="text-primary flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>

                       {{ __('messages.forgot_password') }}
                    </a>
               </p>
           </form>
        </div>
    </div>
</body>
</html>

<script>
    (function(){
        const toggle = document.getElementById('togglePassword');
        if (!toggle) return;
        const password = document.getElementById('password');
        const eye = document.getElementById('eyeIcon');
        const eyeOff = document.getElementById('eyeOffIcon');

        toggle.addEventListener('click', function(){
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eye.classList.toggle('hidden');
            eyeOff.classList.toggle('hidden');
        });
    })();
</script>