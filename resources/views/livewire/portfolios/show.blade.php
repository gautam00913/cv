<div>
    @if ($portfolio)
        <div class="relative w-full" x-data="{
            interval: null,
            start(){
                this.stop();
                this.interval = setInterval(() => {
                    $wire.caroussel();
                    }, 8000)
            },
            stop(){
                if(this.interval){
                    clearInterval(this.interval)
                }
            },
            reset(){
                this.start()
            }
        }"
        x-init="start()"
        x-on:slide-changed.window="reset()"
        >
            <!-- Carousel wrapper -->
            <div class="relative h-[500px] overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <a href="{{ $portfolio->link ?? '#' }}" class="h-full duration-700 ease-in-out flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <p class="w-full md:w-1/2 lg:w-1/3 h-56 md:h-full">
                        <img class="w-full h-full object-fill rounded-t-lg  md:rounded-none md:rounded-s-lg" src="{{ $portfolio->picture ? Storage::url($portfolio->picture) : asset('images/portfolio.jpg') }}" alt="">
                    </p>
                    <div class="md:w-1/2 lg:w-2/3 md:h-full flex flex-col justify-between md:justify-center">
                        <div class="p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $portfolio->title }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $portfolio->description }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Slider controls -->
            <button type="button" @click="$wire.previousElement(); $dispatch('slide-changed')" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/30 dark:bg-gray-800/30 group-hover:bg-primary/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button @click="$wire.nextElement(); $dispatch('slide-changed')" type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/30 dark:bg-gray-800/30 group-hover:bg-primary/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    @endif
</div>
