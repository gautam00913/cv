<div>
    @foreach ($showList->competences->groupBy('competence_title_id') as $group_competences)
        <article class="mb-5">
            <x-section-title :title="$group_competences->first()->competenceTitle->name"></x-section-title>
            @php
                $sub_groups = $group_competences->groupBy('competence_sub_title_id');
            @endphp
            <div @class(['mt-5', 'grid md:grid-cols-2 gap-8' => $sub_groups->count() > 1])>
                @foreach ($sub_groups as $competences)
                    @php
                        $sub_group = $competences->first();
                    @endphp
                    @if ($sub_group->competenceSubTitle)
                        <x-card data-aos="{{ $loop->index %2 == 0 ? 'fade-right' : 'fade-left' }}" data-aos-offset="300" data-aos-easing="ease-in-sine">
                            <h3 class="text-lg font-bold underline mb-3">{{ $sub_group->competenceSubTitle->name }}</h3>
                            <div>
                                <ul class="space-y-3">
                                    @foreach ($competences as $competence)
                                        <li>
                                            <x-tag>{{ $competence->tag }}</x-tag>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </x-card>
                    @else
                        <x-card data-aos="zoom-in-down">
                            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-5 lg:gap-8">
                                @foreach ($competences as $competence)
                                    <x-tag>{{ $competence->tag }}</x-tag>
                                @endforeach
                            </div>
                        </x-card>
                    @endif
                @endforeach
            </div>
        </article>
    @endforeach
</div>
