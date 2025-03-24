<div>
    <div class="relative rounded-b-2xl h-[300px] shadow-xl" style="background-repeat: no-repeat; background-position: center; background-size: cover; background-image: url('{{ Storage::url($profile->cover_picture) }}');">
        <div class="hidden md:block absolute bottom-0 p-5 left-0 right-0 bg-primary/60 rounded-b-2xl">
            <div class="text-end space-x-3 mr-5">
                <x-button type="link" href="{{ route('cover_picture') }}" wire:navigate class="text-secondaryLight border-secondaryLight hover:border-none"><i class="fa-solid fa-camera"></i> Changer</x-button>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row justify-center items-center md:justify-normal space-x-8 md:ml-20 my-5">
        <div class="-mt-20 z-20">
            @if ($profile->picture)
                <img src="{{ Storage::url($profile->picture) }}" class="rounded-full w-40 h-40 shadow-lg md:shadow-sm" />
            @else
                <p class="rounded-full w-40 h-40 shadow-lg md:shadow-sm flex items-center justify-center bg-secondaryLight">
                    <i class="fa-solid fa-user text-6xl"></i>
                </p>
            @endif
        </div>
        <div class="text-center md:text-start">
            <h1 class="md:text-2xl font-bold mb-2 relative">Hello, moi c'est {{ $user->name }} <a class="ms-2 text-sm absolute -top-2" href="{{ route('profile') }}" wire:navigate><i class="fa-solid fa-pen"></i></a></h1>
            <p class="italic font-semibold text-sm text-secondaryLight"><?= $profile->biography ?></p>
        </div>
    </div>

    <div class="bg-white relative rounded-2xl p-5 md:px-10 mb-5 mx-2 md:mx-0">
       <div class="grid md:grid-cols-2 gap-4 md:gap-8">
            <x-card class="text-center border border-primary">
                <div class="flex items-center justify-center mx-auto h-12 w-12 rounded-full bg-secondaryLight">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <p class="my-4 font-semibold italic">Compétence ({{ $profile->competences_count }})</p>
                <x-button type="link" href="{{ route('competences') }}" wire:navigate>Gérer</x-button>
            </x-card>
            <x-card class="text-center border border-primary">
                <div class="flex items-center justify-center mx-auto h-12 w-12 rounded-full bg-secondaryLight">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <p class="my-4 font-semibold italic">Education ({{ $profile->educations_count }})</p>
                <x-button type="link" href="{{ route('educations') }}" wire:navigate>Gérer</x-button>
            </x-card>
            <x-card class="text-center border border-primary">
                <div class="flex items-center justify-center mx-auto h-12 w-12 rounded-full bg-secondaryLight">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <p class="my-4 font-semibold italic">Experience ({{ $profile->experiences_count }})</p>
                <x-button type="link" href="{{ route('experiences') }}" wire:navigate>Gérer</x-button>
            </x-card>
            <x-card class="text-center border border-primary">
                <div class="flex items-center justify-center mx-auto h-12 w-12 rounded-full bg-secondaryLight">
                    <i class="fa-solid fa-cubes-stacked"></i>
                </div>
                <p class="my-4 font-semibold italic">Portfolio ({{ $profile->portfolios_count }})</p>
                <x-button type="link" href="{{ route('portfolios') }}" wire:navigate>Gérer</x-button>
            </x-card>
       </div>
    </div>
</div>
