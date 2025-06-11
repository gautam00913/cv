<div>
    <div x-data 
    x-init="$watch('$root', () => {
        AOS.refreshHard();
    })" class="space-y-8">
        @foreach ($showList->educations as $education)
            <x-card class="hover:bg-primary hover:text-white" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                <h2 class="text-lg font-semibold mb-3 underline">{{ $education->grade }}</h2>
                <div class="mb-3">
                    <?= nl2br($education->description) ?>
                </div>
                <p><b>Année :</b> {{ $education->year }}</p>
            </x-card>
        @endforeach
    </div>
</div>