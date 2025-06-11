<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de Mot de passe | Curriculum vitea</title>
    <meta name="image" property="og:image" content="{{ asset('images/image_gautier.jpg') }}">
    <link rel="icon" type="images/jpg" href="{{ asset('images/image_gautier.jpg') }}" />
    @vite('resources/css/app.css')
</head>
<body class="bg-primary/70">
    <div class="flex items-center justify-center h-screen">

        <div class="bg-white relative rounded-2xl p-3 md:px-10 mb-5 md:pb-5 w-11/12 md:w-1/2 lg:w-2/5 py-10">
           <h1 class="font-bold uppercase text-center mb-3 text-2xl">Réinitialisation de Mot de passe </h1>
           <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                @if (Session::has('success'))
                    <div class="bg-primary/30 text-primaryBase italic text-sm px-4 py-2 mb-5">
                        {{ Session::get('success') }}
                    </div>
                @elseif (Session::has('fail'))
                    <div class="bg-red-300 text-red-600 italic text-sm px-4 py-2 mb-5">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                @error('email')
                    <p class="mb-5"><small class="text-red-500 italic">{{ $message }}</small></p>
                @enderror
               <div class="mb-5">
                    <label for="password" class="text-secondary mb-1 block">Mot de passe</label>
                    <input type="password" name="password" id="password" class="rounded-md focus:ring-2 focus:border-cyan-400 w-full px-3 py-2 border" required value="{{ old('password') }}">
                    @error('password')
                        <p><small class="text-red-500 italic">{{ $message }}</small></p>
                    @enderror
               </div>
               <div class="mb-5">
                    <label for="password_confirmation" class="text-secondary mb-1 block">Confirmez le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="rounded-md focus:ring-2 focus:border-cyan-400 w-full px-3 py-2 border" required>
               </div>
               <div class="mb-5">
                    <x-button type="submit" class="w-full md:w-1/2 mx-auto block">Réinitialiser</x-button>
               </div>
           </form>
        </div>
    </div>
</body>
</html>