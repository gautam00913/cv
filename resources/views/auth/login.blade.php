<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Curriculum vitea</title>
    <meta name="image" property="og:image" content="{{ asset('images/image_gautier.jpg') }}">
    <link rel="icon" type="images/jpg" href="{{ asset('images/image_gautier.jpg') }}" />
    @vite('resources/css/app.css')
</head>
<body class="bg-primary/70">
    <div class="flex items-center justify-center h-screen">

        <div class="bg-white relative rounded-2xl p-3 md:px-10 mb-5 md:pb-5 w-11/12 md:w-1/2 lg:w-2/5 py-10">
           <h1 class="font-bold uppercase text-center mb-3 text-2xl">Connexion</h1>
           <form action="{{ route('authenticate') }}" method="POST">
                @csrf
               <div class="mb-5">
                    <label for="email" class="text-secondary mb-1 block">Identifiant</label>
                    <input type="email" name="email" id="email" class="rounded-md focus:ring-2 focus:border-cyan-400 w-full px-3 py-2 border" required value="{{ old('email') }}">
                    @error('email')
                        <p><small class="text-red-500 italic">{{ $message }}</small></p>
                    @enderror
               </div>
               <div class="mb-6">
                    <label for="password" class="text-secondary mb-1 block">Mot de passe</label>
                    <input type="password" name="password" id="password" class="rounded-md focus:ring-2 focus:border-cyan-400 w-full px-3 py-2 border" required value="{{ old('password') }}">
                    @error('password')
                        <p><small class="text-red-500 italic">{{ $message }}</small></p>
                    @enderror
               </div>
               <div class="mb-5">
                    <x-button type="submit" class="w-full md:w-1/2 mx-auto block">Se connecter</x-button>
               </div>
               <p>
                    <a href="/" class="text-primary flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                       Retour à l'acceuil
                    </a>
               </p>
           </form>
        </div>
    </div>
</body>
</html>