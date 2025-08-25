<div>
    <!-- pour desktop -->
    <div class="hidden md:block" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
        <table>
            <tbody>
                @foreach ($experiences as $key => $experience)
                    @if ($key %2 == 0)
                        <tr>
                            <td class="p-0 w-1/2">
                                <div class="flex items-center p-0 m-0">
                                    <x-card class="w-10/12 h-full text-center border border-primary">
                                        <h2 class="text-lg uppercase mb-1 font-semibold">
                                            @if($experience->company->website)
                                                <a href="<?= $experience->company->website ?>" target="_blank">
                                                    <?= $experience->company->name ?>
                                                </a>
                                            @else
                                                <?= $experience->company->name ?>
                                            @endif 
                                        </h2>
                                        <p class="text-primaryDark italic"><?= $experience->jobTitle->name ?></p>
                                        <p class="flex items-center justify-center  text-secondary">
                                            <i class="fa-solid fa-calendar-days mr-2"></i>
                                            <span><?= $experience->started_at->translatedFormat('F Y') ?> @if($experience->finished_at)- <?= $experience->finished_at->translatedFormat('F Y') ?>@elseif($experience->current)- à aujourdh'ui @endif</span>
                                        </p>
                                        <p>
                                            <hr class="border-2 w-1/4 mx-auto my-3">
                                        </p>
                                        <div class="text-justify text-sm"><?= $experience->description ?></div>
                                    </x-card>
                                    
                                    <div class="border border-primary w-2/12"></div>
                                </div>
                                
                            </td>
                            <td class="border-l-2 border-primary">
                                <div></div>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>
                                <div></div>
                            </td>
                            <td class="p-0 border-l-2 border-primary">
                                <div class="flex items-center p-0 m-0">
                                    <div class="border border-primary w-2/12"></div>
        
                                    <x-card class="w-10/12 h-full text-center border border-primary">
                                        <h2 class="text-lg uppercase mb-1 font-semibold">
                                            @if($experience->company->website)
                                                <a href="<?= $experience->company->website ?>" target="_blank">
                                                    <?= $experience->company->name ?>
                                                </a>
                                            @else
                                                <?= $experience->company->name ?>
                                            @endif 
                                        </h2>
                                        <p class="text-primaryDark italic"><?= $experience->jobTitle->name ?></p>
                                        <p class="flex items-center justify-center  text-secondary">
                                            <i class="fa-solid fa-calendar-days mr-2"></i>
                                            <span><?= $experience->started_at->translatedFormat('F Y') ?> @if($experience->finished_at)- <?= $experience->finished_at->translatedFormat('F Y') ?>@elseif($experience->current)- à aujourdh'ui @endif</span>
                                        </p>
                                        <p>
                                            <hr class="border-2 w-1/4 mx-auto my-3">
                                        </p>
                                        <div class="text-justify text-sm"><?= $experience->description ?></div>
                                    </x-card>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- pour mobile -->
    <div class="space-y-8 md:hidden">
        @foreach($experiences as $key => $experience)
            <x-card class="w-11/12 h-full text-center border border-primary mx-auto" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                <h2 class="text-md uppercase mb-1 font-semibold">
                    @if($experience->company->website)
                        <a href="<?= $experience->company->website ?>" target="_blank">
                            <?= $experience->company->name ?>
                        </a>
                    @else
                        <?= $experience->company->name ?>
                    @endif 
                </h2>
                <p class="text-primaryDark italic"><?= $experience->jobTitle->name ?></p>
                <p class="flex items-center justify-center text-xs text-secondary">
                    <i class="fa-solid fa-calendar-days mr-2"></i>
                    <span><?= $experience->started_at->translatedFormat('F Y') ?> @if($experience->finished_at)- <?= $experience->finished_at->translatedFormat('F Y') ?>@elseif($experience->current)- à aujourdh'ui @endif</span>
                </p>
                <p>
                    <hr class="border-2 w-1/4 mx-auto my-3">
                </p>
                <div class="text-justify text-xs"><?= $experience->description ?></div>
            </x-card>
        @endforeach
    </div>
</div>
