<div class="lg:space-x-4 flex flex-col lg:flex-row items-start">
    <div class="bg-white lg:w-3/5 rounded-2xl p-5 md:px-10 my-5 mx-2 md:mx-0">
        <h1 class="font-semibold mb-4 text-xl">Vos compétences</h1>
        <div>
            <fieldset class="border border-gray-200 rounded-lg w-full p-4 bg-white shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <legend class="bg-secondaryLight px-3 py-1 shadow-md md:text-lg">{{ $group->competenceTitle->name }}</legend>
                <div x-data="{isOpen: false}" class="relative float-right -mt-4 md:-mt-7" @click.outside="isOpen = false">
                    <div>
                    <button @click="isOpen = !isOpen" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                        <span class="sr-only">Open dropdown</span>
                        <svg class="w-5 h-5" x-bind:aria-hidden="isOpen" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                        </svg>
                    </button>
                    </div>
                    <div x-cloak x-show="isOpen" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <ul class="text-left" aria-labelledby="dropdownButton">
                            <li>
                                <a href="{{ route('competences.title', $group->competenceTitle->id) }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"><i class="fa-solid fa-pen me-1"></i>Modifier</a>
                            </li>
                            <li>
                                <a x-data @click="$dispatch('confirm-delete', {action: 'delete-competence', data: {what: 'title', id: {{ $group->competenceTitle->id }}}})" class="cursor-pointer block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"><i class="fa-solid fa-trash me-1"></i>Supprimer</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul style="list-style-type: disc;" class="ml-3 space-y-4">
                    @foreach ($group_competences->groupBy('competence_sub_title_id') as $competences)
                        @php
                            $sub_group = $competences->first();
                        @endphp
                        <li @if(!$sub_group->competenceSubTitle)style="list-style-type: none;"@endif>
                            @if ($sub_group->competenceSubTitle)
                                <h2 class="font-semibold mb-3 flex items-center">
                                    {{ $sub_group->competenceSubTitle->name }} 
                                    <a href="{{ route('competences.subtitle', $sub_group->competence_sub_title_id) }}" wire:navigate class="text-xs cursor-pointer ml-4 text-primary"><i class="fa-solid fa-pen"></i></a>
                                    <span x-data @click="$dispatch('confirm-delete', {action: 'delete-competence', data: {what: 'subtitle', id: {{ $sub_group->competence_sub_title_id }}}})" class="text-xs cursor-pointer ml-1 text-red-600"><i class="fa-solid fa-trash"></i></span>
                                </h2>
                            @endif
                            <div class="space-y-4">
                                @foreach ($competences as $competence)
                                    <x-card>
                                        <div class="flex justify-between items-center">
                                            <div>
                                                {{ $competence->tag }}
                                            </div>
                                            <div class="flex">
                                                <span wire:click="editCompetence({{ $competence->id }})" class="bg-white shadow px-2 py-1 rounded-full hover:bg-primaryDark hover:text-white text-sm cursor-pointer ml-4 text-gray-500"><i class="fa-solid fa-pen"></i></span>
                                                <span x-data @click="$dispatch('confirm-delete', {action: 'delete-competence', data: {what: 'competence', id: {{ $competence->id }}}})" class="bg-white shadow px-2 py-1 rounded-full hover:bg-primaryDark hover:text-white text-sm cursor-pointer ml-2 text-gray-500">
                                                    <i class="fa-solid fa-trash"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </x-card>
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
            </fieldset>
        </div>

        <div class="mt-5">
            <nav aria-label="Page navigation example">
                <ul class="flex items-center -space-x-px h-8 text-sm">
                    @foreach ($this->competences->keys() as $i => $cat)
                        <li>
                            @if ($cat == $index || ($index == 0 && $i == 0))
                                <a wire:click="showCategory({{ $cat }})" aria-current="page" class="cursor-pointer z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $i + 1 }}</a>
                            @else
                                <a wire:click="showCategory({{ $cat }})" class="cursor-pointer flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $i + 1 }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
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
