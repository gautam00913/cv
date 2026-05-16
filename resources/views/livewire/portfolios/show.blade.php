<div>
    @if ($showList && $showList->portfolios->count() > 0)
        <div class="relative w-full" x-data="{
            index: @entangle('index'),
            get count() { return {{ $showList->portfolios->count() }}; },
            interval: null,
            start(){
                this.stop();
                this.interval = setInterval(() => {
                    this.index = (this.index + 1) % this.count;
                }, 5000);
            },
            stop(){
                if (this.interval) {
                    clearInterval(this.interval);
                    this.interval = null;
                }
            },
            reset(){
                this.start();
            }
        }" x-init="start()" x-on:mouseenter.stop="stop()" x-on:mouseleave="start()" x-on:slide-changed.window="reset()">
            <!-- Carousel wrapper -->
            <div class="relative h-[400px] md:h-[500px] overflow-hidden rounded-lg">
                <div class="absolute inset-0 flex transition-transform duration-500 ease-in-out"
                     :style="'transform: translateX(-' + (index * 100) + '%)'">
                    @foreach ($showList->portfolios as $key => $portfolio)
                        <div class="w-full flex-shrink-0 h-full" wire:key="portfolio-{{ $portfolio->id }}">
                            <a href="{{ $portfolio->link ?? '#' }}" class="h-full flex flex-col md:flex-row items-center bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="w-full md:w-1/2 lg:w-1/3 h-56 md:h-full">
                                    <img class="w-full h-full object-cover rounded-t-lg md:rounded-none md:rounded-s-lg" src="{{ $portfolio->picture ? Storage::url($portfolio->picture) : asset('images/portfolio.jpg') }}" alt="{{ $portfolio->title }}">
                                </div>
                                <div class="w-full md:w-1/2 lg:w-2/3 md:h-full flex flex-col justify-center">
                                    <div class="p-4 md:p-6 leading-normal">
                                        <h5 class="mb-2 text-xl md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $portfolio->title }}</h5>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $portfolio->description }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Slider controls -->
            <button type="button" @click="$wire.previousElement(); $dispatch('slide-changed')" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/30 dark:bg-gray-800/30 group-hover:bg-primary/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" @click="$wire.nextElement(); $dispatch('slide-changed')" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/30 dark:bg-gray-800/30 group-hover:bg-primary/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>

            <!-- Indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-4 left-1/2 space-x-2">
                @foreach ($showList->portfolios as $key => $portfolio)
                    <button type="button"
                            class="w-3 h-3 rounded-full transition-colors duration-200"
                            :class="index === {{ $key }} ? 'bg-primary' : 'bg-secondary'"
                            @click="$wire.goToElement({{ $key }}); $dispatch('slide-changed')"
                            aria-current="false"
                            aria-label="Slide {{ $key + 1 }}">
                    </button>
                @endforeach
            </div>
        </div>
    @endif
</div>