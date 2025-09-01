<div class="bg-white md:w-4/5 lg:w-3/5 md:mx-auto rounded-2xl p-5 md:px-10 my-5 mx-2">
    <div class="flex flex-wrap gap-3 items-center justify-between">
         <h1 class="font-semibold mb-4 text-xl">
            Expériences professionnelles
        </h1>
        <div x-data="{showDropdown: false}" class="relative" @click.outside="showDropdown = false">
            <button @click="showDropdown = !showDropdown" type="button" class="text-sm focus:ring-2 focus:ring-white focus:ring-offset-1 focus:ring-offset-gray-600 focus:outline-hidden">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                </svg>

            </button>
            <div x-cloak x-show="showDropdown" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden">
                <a href="{{ route('showCompanies') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Entreprises</a>
                <a href="{{ route('showPositions') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Postes</a>
            </div>
        </div>
    </div>
 
    <form wire:submit="submit">
        {{ $this->form }}
        <div class="mt-5">
            <x-button type="submit" class="w-full md:w-1/2 mx-auto block">Enregistrer</x-button>
        </div>
    </form>
</div>