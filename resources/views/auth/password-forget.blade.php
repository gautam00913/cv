<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié | Curriculum vitea</title>
    <meta name="image" property="og:image" content="{{ asset('images/image_gautier.jpg') }}">
    <link rel="icon" type="images/jpg" href="{{ asset('images/image_gautier.jpg') }}" />
    @vite('resources/css/app.css')
</head>
<body class="bg-primary/70">
    <div class="flex items-center justify-center h-screen">

        <div class="bg-white relative rounded-2xl p-3 md:px-10 mb-5 md:pb-5 w-11/12 md:w-1/2 lg:w-2/5 py-10">
           <h1 class="font-bold uppercase text-center mb-3 text-2xl">Mot de passe oublié ?</h1>
           <form action="{{ route('password.sendLink') }}" method="POST">
                @csrf
                @if (Session::has('success'))
                    <div class="bg-primary/30 text-primaryBase italic text-sm px-4 py-2 mb-5">
                        {{ Session::get('success') }}
                    </div>
                @elseif (Session::has('fail'))
                    <div class="bg-red-300 text-red-600 italic text-sm px-4 py-2 mb-5">
                        {{ Session::get('fail') }}
                    </div>
                @endif
               <div class="mb-5">
                    <label for="email" class="text-secondary mb-1 block">Votre adresse email</label>
                    <input type="email" name="email" id="email" class="rounded-md focus:ring-2 focus:border-cyan-400 w-full px-3 py-2 border" required value="{{ old('email') }}">
                    @error('email')
                        <p><small class="text-red-500 italic">{{ $message }}</small></p>
                    @enderror
               </div>
               <div class="mb-5">
                    <x-button type="submit" class="w-full md:w-1/2 mx-auto block">Réinitialiser</x-button>
               </div>
               <p>
                    <a href="{{ route('login') }}" class="text-primary flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                       Retour à la page de connexion
                    </a>
               </p>
           </form>
        </div>
    </div>
</body>
</html>