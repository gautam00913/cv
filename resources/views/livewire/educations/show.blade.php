<div>
    <div class="space-y-8">
        @foreach ($showList->educations as $education)
            <x-card class="hover:bg-primary hover:text-white">
                <h2 class="text-lg font-semibold mb-3 underline">{{ $education->grade }}</h2>
                <div class="mb-3">
                    <?= nl2br($education->description) ?>
                </div>
                <p><b>Année :</b> {{ $education->year }}</p>
            </x-card>
        @endforeach
    </div>
</div>