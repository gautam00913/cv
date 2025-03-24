<div class="bg-white md:w-4/5 md:mx-auto rounded-2xl p-5 md:px-10 my-5 mx-2">
    <form wire:submit="submit">
        {{ $this->form }}
        <div class="mt-5">
            <x-button type="submit" class="w-full md:w-1/2 mx-auto block">Enregistrer</x-button>
        </div>
    </form>
</div>
