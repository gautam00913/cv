<div>
    <div class="relative rounded-b-2xl h-[300px] shadow-xl" style="background-repeat: no-repeat; background-position: center; background-size: cover; background-image: url({{ asset('images/dev.jpg') }});">
        <div class="hidden md:block absolute bottom-0 p-5 left-0 right-0 bg-primary/60 rounded-b-2xl">
            <div class="text-end space-x-3 mr-5">
                <x-button cat="link" href="tel:+22994175300" class="text-secondaryLight border-secondaryLight hover:border-none"><i class="fa-solid fa-phone"></i> Appeler</x-button>
                <x-button class="text-secondaryLight border-secondaryLight hover:border-none"><i class="fa-solid fa-envelope"></i> Message</x-button>
                <x-button class="text-secondaryLight border-secondaryLight hover:border-none"><i class="fa-solid fa-download"></i> CV</x-button>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row justify-center items-center md:justify-normal space-x-8 md:ml-20 my-5">
        <div class="-mt-20 z-20">
            <img src="{{ asset('images/image_gautier.jpg') }}" class="rounded-full w-40 h-40 shadow-lg md:shadow-sm" />
        </div>
        <div class="text-center md:text-start">
            <h1 class="text-lg md:text-2xl font-bold mb-2">Hello, moi c'est Gautier Seth DJOSSOU</h1>
            <p class="italic font-semibold text-sm text-secondaryLight">Je suis Développeur web</p>
        </div>
    </div>

    <div class="bg-white relative rounded-2xl p-3 md:px-10 mb-5 md:pb-5 mx-2 md:mx-0">
        <div x-data="{active: 'competence'}">
            <div class="flex items-center space-x-5 lg:space-x-10 border-b-2 pb-3 mb-4 overflow-x-scroll" style="scrollbar-width: none;">
                <x-button class="uppercase hover:translate-y-1" ::class="{'bg-primary text-white' : active == 'competence'}" @click="active = 'competence'">Compétences</x-button>
                <x-button class="uppercase hover:translate-y-1" ::class="{'bg-primary text-white' : active == 'experience'}" @click="active = 'experience'">Expérience</x-button>
                <x-button class="uppercase hover:translate-y-1" ::class="{'bg-primary text-white' : active == 'education'}" @click="active = 'education'">éducation</x-button>
                <x-button class="uppercase hover:translate-y-1" ::class="{'bg-primary text-white' : active == 'portfolio'}" @click="active = 'portfolio'">Portfolio</x-button>
            </div>
            <div x-show="active == 'competence'" class="border-2 rounded-md p-3 md:p-5 border-secondaryLight">
                <article>
                    <x-section-title title="En programmation web"></x-section-title>
                     <div class="grid md:grid-cols-2 gap-8 mt-4">
                         <x-card>
                             <h3 class="text-lg font-bold underline mb-3">Languages</h3>
                             <p>
                                 <ul class="space-y-3">
                                     <li><x-tag>HTML 5</x-tag></li>
                                     <li><x-tag>CSS 3</x-tag></li>
                                     <li><x-tag>Javascript</x-tag></li>
                                     <li><x-tag>PHP</x-tag></li>
                                     <li><x-tag>AJAX</x-tag></li>
                                 </ul>
                             </p>
                         </x-card>
                         <x-card>
                             <h3 class="text-lg font-bold underline mb-3">Frameworks & Librairies & CMS</h3>
                             <p>
                                 <ul class="space-y-3">
                                     <li><x-tag>Bootstrap</x-tag> </li>
                                     <li><x-tag>Materialize CSS</x-tag> </li>
                                     <li><x-tag>Alpine JS</x-tag> </li>
                                     <li><x-tag>Laravel</x-tag> </li>
                                     <li><x-tag>Jquery</x-tag> </li>
                                     <li><x-tag>WordPress</x-tag></li>
                                 </ul>
                             </p>
                         </x-card>
                     </div>
                    </article>
         
                    <article class="mt-5">
                        <x-section-title title="En système de gestion des bases de données (SGBD)"></x-section-title>

                        <div class="mt-4">
                            <x-card>
                                <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-5 lg:gap-8">
                                    <x-tag>MySQL</x-tag>
                                    <x-tag>Oracle</x-tag>
                                    <x-tag>PostgreSQL</x-tag>
                                    <x-tag>Microsoft SQL Server</x-tag>
                                    <x-tag>SQLite</x-tag>
                                </div>
                            </x-card>
                        </div>
                    </article>
                    <article class="mt-5">
                        <x-section-title title="En environnement de développement"></x-section-title>

                        <div class="mt-4">
                            <x-card>
                                <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-5 lg:gap-8">
                                    <x-tag>Windows</x-tag>
                                    <x-tag>Linux / Ubuntu</x-tag>
                                </div>
                            </x-card>
                        </div>
                    </article>
            </div>
            <div x-show="active == 'experience'" class="border-2 rounded-md p-3 md:p-5 border-secondaryLight">

            </div>
            <div x-show="active == 'education'" class="border-2 rounded-md p-3 md:p-5 border-secondaryLight">

            </div>
            <div x-show="active == 'portfolio'" class="border-2 rounded-md p-3 md:p-5 border-secondaryLight">

            </div>
        </div>
       
    </div>
</div>
