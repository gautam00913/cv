<div>
    @foreach ($showList->competences->groupBy('competence_title_id') as $competence_title_id => $group_competences)
        <article  wire:key="{{ 'group-'. $competence_title_id }}" class="mb-5">
            <x-section-title :title="$group_competences->first()->competenceTitle->name"></x-section-title>
            @php
                $sub_groups = $group_competences->groupBy('competence_sub_title_id');
            @endphp
            <div @class(['mt-5', 'grid md:grid-cols-2 gap-8' => $sub_groups->count() > 1])>
                @foreach ($sub_groups as $competence_sub_title_id => $competences)
                    @php
                        $sub_group = $competences->first();
                    @endphp
                    @if ($sub_group->competenceSubTitle)
                        <x-card wire:key="{{ 'comp-'. $competence_sub_title_id }}" data-aos="{{ $loop->parent->first ? '' : ($loop->index %2 == 0 ? 'fade-right' : 'fade-left') }}" data-aos-offset="300" data-aos-easing="ease-in-sine">
                            <h3 class="text-lg font-bold underline mb-3">{{ $sub_group->competenceSubTitle->name }}</h3>
                            <div>
                                <ul class="space-y-3">
                                    @foreach ($competences as $key => $competence)
                                        <li>
                                            <x-tag wire:key="{{ 'tag-'. $key }}">{{ $competence->tag }}</x-tag>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </x-card>
                    @else
                        <x-card wire:key="{{ 'comp-'. $competence_sub_title_id }}" data-aos="zoom-in-down">
                            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-5 lg:gap-8">
                                @foreach ($competences as $key => $competence)
                                    <x-tag wire:key="{{ 'wtag-'. $key }}">{{ $competence->tag }}</x-tag>
                                @endforeach
                            </div>
                        </x-card>
                    @endif
                @endforeach
            </div>
        </article>
    @endforeach
</div>
