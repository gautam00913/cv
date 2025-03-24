<div class="mb-10 mt-5 flex flex-col md:flex-row md:space-x-8">
    <div class="mb-4 md:mb-0 md:w-1/2 lg:w-8/12">
        <p>
            @if ($profile->cover_picture)
                <img src="{{ Storage::url($profile->cover_picture) }}" alt="Photo de couverture" class="w-full h-20 md:h-[600px] object-center">
            @endif
        </p>
    </div>
    <div class="md:w-1/2 lg:w-4/12 rounded-md bg-white px-3 py-10">
        <h2 class="font-semibold mb-4 text-xl">Changez votre photo de couverture</h2>
        <form wire:submit="update">
            {{ $this->form }}
            <div class="mt-5">
                <x-button type="submit" class="w-full md:w-1/2 mx-auto block">Enregistrer</x-button>
            </div>
        </form>
    </div>
</div>
