<div>
    <section data-aos="flip-left" data-aos-duration="3000" data-aos-easing="ease-out-cubic" data-aos-once="true">
        <div class="relative rounded-b-2xl h-[300px] shadow-xl" style="background-repeat: no-repeat; background-position: center; background-size: cover; background-image: url({{ Storage::url($user->profile->cover_picture) }});">
            <div class="hidden md:block absolute bottom-0 p-5 left-0 right-0 bg-primary/60 rounded-b-2xl">
                <div class="text-end space-x-3 mr-5">
                    <x-button cat="link" href="tel:{{ $user->phone }}" class="text-secondaryLight border-secondaryLight hover:border-none"><i class="fa-solid fa-phone"></i> Appeler</x-button>
                    <x-button class="text-secondaryLight border-secondaryLight hover:border-none"><i class="fa-solid fa-envelope"></i> Message</x-button>
                    <x-button class="text-secondaryLight border-secondaryLight hover:border-none"><i class="fa-solid fa-download"></i> CV</x-button>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-center items-center md:justify-normal space-x-8 md:ml-20 my-5">
            <div class="-mt-20 z-20">
                @if ($user->profile->picture)
                    <a href="{{ Storage::url($user->profile->picture) }}" data-lightbox="image-avatar" data-title="Photo de {{ $user->name }}">
                        <img src="{{ Storage::url($user->profile->picture) }}" class="rounded-full object-fill object-center w-40 h-40 shadow-lg md:shadow-sm" alt="Photo de {{ $user->name }}" />
                    </a>
                @else
                    <p class="rounded-full w-40 h-40 shadow-lg md:shadow-sm flex items-center justify-center bg-secondaryLight">
                        <i class="fa-solid fa-user text-6xl"></i>
                    </p>
                @endif
            </div>
            <div class="text-center md:text-start">
                <h1 class="text-lg md:text-2xl font-bold mb-2">Hello, moi c'est {{ $user->name }}</h1>
                <p class="italic font-semibold text-sm text-secondaryLight"><?= $user->profile->biography ?></p>
            </div>
        </div>
    </section>

    <div class="bg-white relative rounded-2xl p-3 md:px-10 mb-5 md:pb-5 mx-2 md:mx-0">
        <div>
            <div class="flex items-center space-x-5 lg:space-x-10 border-b-2 pb-3 mb-4 overflow-x-scroll" style="scrollbar-width: none;">
                <x-button @class(["uppercase hover:translate-y-1", 'bg-primary text-white' => $active == 'competence']) wire:click="showComponent('competence')">Compétences</x-button>
                <x-button @class(["uppercase hover:translate-y-1", 'bg-primary text-white' => $active == 'experience']) wire:click="showComponent('experience')">Expérience</x-button>
                <x-button @class(["uppercase hover:translate-y-1", 'bg-primary text-white' => $active == 'education']) wire:click="showComponent('education')">éducation</x-button>
                <x-button @class(["uppercase hover:translate-y-1", 'bg-primary text-white' => $active == 'portfolio']) wire:click="showComponent('portfolio')">Portfolio</x-button>
            </div>
            <div class="border-2 rounded-md p-3 md:p-5 border-secondaryLight">
                <div wire:loading.delay class="w-full">
                    <p class="flex justify-center">
                        <svg class="animate-spin h-40 w-40 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </p>
                </div>
                <div wire:loading.remove>
                    @switch($active)
                        @case('experience')
                            <livewire:experiences.show :profile="$user->profile" />
                            @break
                        @case('education')
                            <livewire:educations.show :profile="$user->profile" />
                            @break
                        @case('portfolio')
                            <livewire:portfolios.show :profile="$user->profile" />
                            @break
                        @default
                            <livewire:competences.show :profile="$user->profile" />
                    @endswitch
                </div>
            </div>
        </div>
    </div>
</div>