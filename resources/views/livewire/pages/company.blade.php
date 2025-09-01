<div class="lg:space-x-4 flex flex-col lg:flex-row lg:items-start">
    <div class="bg-white lg:w-3/5 rounded-2xl p-5 md:px-10 my-5 mx-2 md:mx-0">
         <h1 class="font-semibold mb-4 text-xl flex justify-between items-center">
            <span>Vos Entreprises</span>
            <a href="#formulaire" class="lg:hidden">+</a>
        </h1>
        <div class="space-y-4">
            @foreach ($companies as $key => $company)
                <x-card :key="$company->id">
                    <div class="flex justify-between items-center border-b pb-2 mb-3">
                        <div>
                            #{{ $key + 1 }}
                        </div>
                        <div class="flex">
                            <span wire:click="editCompany({{ $company->id }})" class="bg-white shadow px-2 py-1 rounded-full hover:bg-primaryDark hover:text-white text-sm cursor-pointer ml-4 text-gray-500"><i class="fa-solid fa-pen"></i></span>
                            <span x-data @click="$dispatch('confirm-delete', {action: 'delete-company', data: {what: 'company', id: {{ $company->id }}}})" class="bg-white shadow px-2 py-1 rounded-full hover:bg-primaryDark hover:text-white text-sm cursor-pointer ml-2 text-gray-500">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-1">
                                <?= $company->name ?>
                        </h2>
                        @if($company->website)
                            <a href="<?= $company->website ?>" class="text-gray-500 italic text-sm" target="_blank">
                                <?= $company->website ?>
                            </a>
                        @endif 
                    </div>
                </x-card>
            @endforeach
        </div>
        <div class="border-t mt-5 pt-5">
            {{ $companies->links() }}
        </div>
    </div>
    <div class="bg-white lg:w-2/5 rounded-2xl p-5 md:px-10 my-5 mx-2 md:mx-0">
        <h2 class="font-semibold mb-4 text-xl">Formulaire</h2>
        <form wire:submit="submit" id="formulaire">
            {{ $this->form }}
            <div class="mt-5">
                <x-button type="submit" class="w-full md:w-1/2 mx-auto block">Enregistrer</x-button>
            </div>
        </form>
    </div>
</div>