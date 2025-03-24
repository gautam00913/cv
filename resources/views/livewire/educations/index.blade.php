<div class="lg:space-x-4 flex flex-col lg:flex-row items-start">
    <div class="bg-white lg:w-3/5 rounded-2xl p-5 md:px-10 my-5 mx-2 md:mx-0">
        <h1 class="font-semibold mb-4 text-xl">Educations</h1>
        <div class="space-y-4">
            @foreach ($this->educations as $education)
                <x-card>
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold mb-3">{{ $education->grade }}</h2>
                            <div class="mb-3">
                                <?= nl2br($education->description) ?>
                            </div>
                            <p><b>Année :</b> {{ $education->year }}</p>
                        </div>
                        <div class="flex">
                            <span wire:click="edit({{ $education->id }})" class="bg-white shadow px-2 py-1 rounded-full hover:bg-primaryDark hover:text-white text-sm cursor-pointer ml-4 text-gray-500"><i class="fa-solid fa-pen"></i></span>
                            <span x-data @click="$dispatch('confirm-delete', {action: 'delete-education', data: {id: {{ $education->id }}}})" class="bg-white shadow px-2 py-1 rounded-full hover:bg-primaryDark hover:text-white text-sm cursor-pointer ml-2 text-gray-500">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>

        <div class="mt-5">
            {{ $this->educations->links() }}
        </div>
    </div>
    <div class="bg-white lg:w-2/5 rounded-2xl p-5 md:px-10 my-5 mx-2 md:mx-0">
        <h2 class="font-semibold mb-4 text-xl">Formulaire</h2>
        <form wire:submit="submit">
            {{ $this->form }}
            <div class="mt-5">
                <x-button type="submit" class="w-full md:w-1/2 mx-auto block">Enregistrer</x-button>
            </div>
        </form>
    </div>
</div>