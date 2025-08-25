<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration | {{ config('app.name') }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')
    </head>

    <body class="antialiased bg-primary/60">
        <header>
            <nav x-data="{showMobile: false, showDropdown: false}" class="bg-primary" @click.outside="showMobile = false">
                <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                  <div class="relative flex h-16 items-center justify-between">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                      <!-- Mobile menu button-->
                      <button @click="showMobile = !showMobile" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-black hover:primaryBase hover:text-white focus:ring-2 focus:ring-white focus:outline-hidden focus:ring-inset" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!--
                          Icon when menu is closed.
              
                          Menu open: "hidden", Menu closed: "block"
                        -->
                        <svg x-show="!showMobile" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!--
                          Icon when menu is open.
              
                          Menu open: "block", Menu closed: "hidden"
                        -->
                        <svg x-show="showMobile" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                      </button>
                    </div>
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                      <a href="/" class="flex shrink-0 items-center text-secondaryLight italic">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-auto h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                          </svg>
                          CV Builder
                      </a>
                      <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a href="{{ route('dashboard') }}" wire:navigate  
                                @if(Route::is('dashboard'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-primaryBase hover:text-white"@endif>
                                Dashboard
                            </a>
                            <a href="{{ route('competences') }}" wire:navigate  
                                @if(Route::is('competences'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                                Compétences
                            </a>
                            <a href="{{ route('educations') }}" wire:navigate  
                                @if(Route::is('educations'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                                Educations
                            </a>
                            <a href="{{ route('experiences') }}" wire:navigate  
                                @if(Route::is('experiences'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                                Expériences
                            </a>
                            <a href="{{ route('portfolios') }}" wire:navigate  
                                @if(Route::is('portfolios'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                                Portfolio
                            </a>
                        </div>
                      </div>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                      <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                      </button>
              
                      <!-- Profile dropdown -->
                      @auth
                        <div class="relative ml-3" @click.outside="showDropdown = false">
                          <div>
                            <button @click="showDropdown = !showDropdown" type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                              <span class="absolute -inset-1.5"></span>
                              <span class="sr-only">Open user menu</span>
                              @if (auth()->user()->profile->picture)
                                <img class="size-8 rounded-full" src="{{ Storage::url(auth()->user()->profile->picture) }}" alt="">
                              @else
                                <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                              @endif
                            </button>
                          </div>
                          <div x-cloak x-show="showDropdown" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="{{ route('profile') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Profil</a>
                            <a href="{{ route('setting') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Paramètre</a>
                            <a class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="document.getElementById('logoutForm').submit();">Déconnexion</a>
                            <form action="{{ route('logout') }}" method="POST" id="logoutForm">@method('DELETE')@csrf</form>
                          </div>
                        </div>
                      @endauth
                    </div>
                  </div>
                </div>
              
                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="sm:hidden" id="mobile-menu">
                  <div x-cloak x-show="showMobile" class="space-y-1 px-2 pt-2 pb-3">
                    <a href="{{ route('dashboard') }}" wire:navigate 
                        @if(Route::is('dashboard'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        Dashboard
                    </a>
                    <a href="{{ route('competences') }}" wire:navigate 
                        @if(Route::is('competences'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        Compétences
                    </a>
                    <a href="{{ route('educations') }}" wire:navigate 
                        @if(Route::is('educations'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        Educations
                    </a>
                    <a href="{{ route('experiences') }}" wire:navigate 
                        @if(Route::is('experiences'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        Expériences
                    </a>
                    <a href="{{ route('portfolios') }}" wire:navigate 
                        @if(Route::is('portfolios'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        Portfolio
                    </a>
                  </div>
                </div>
            </nav>
        </header>
          
        <div class="container mx-auto min-h-full">
            {{ $slot }}
        </div>
        <div x-cloak x-data="{openModal: false, action: '', data: null}" @confirm-delete.window="{action, data} = $event.detail; openModal = true" @close-delete-modal.window="action = ''; data = null; openModal = false;"
        id="delete-modal" tabindex="-1" aria-hidden="true" x-show="openModal" class="bg-gray-800/20 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto">
              <!-- Modal content -->
              <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700" @click.outside="openModal = false">
                  <!-- Modal body -->
                  <div class="p-4 md:p-5 space-y-4">
                      <div class="flex items-center justify-center mx-auto h-20 w-20 rounded-full bg-red-300 text-4xl">
                        <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                      </div>
                      <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                          Voulez-vous vraiment supprimer cet élément ?
                      </p>
                  </div>
                  <!-- Modal footer -->
                  <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                      <template x-if="action">
                        <button  @click="$dispatch(action, data)" type="button" id="confirm-delete" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Oui</button>
                      </template>
                      <button @click="openModal = false" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary focus:z-10 focus:ring-4 focus:ring-primaryBase">Non</button>
                  </div>
              </div>
          </div>
        </div>
        @livewire('notifications')
        <footer class="mt-auto bg-black text-white border-black">
            <div class="row">
                <div class="col s12 m6">
                    <ul>
                        <li> <a href=""></a></li>
                    </ul>
                </div>
            </div>
                <p class="text-center py-3">&copy; 2022 &middot; gautier seth djossou, swoftware engineer - <em>All right reserved</em></p>
        </footer>
        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
