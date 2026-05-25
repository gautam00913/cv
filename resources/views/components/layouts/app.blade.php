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
                    <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                      <!-- Mobile menu button-->
                      <button @click="showMobile = !showMobile" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-black hover:primaryBase hover:text-white focus:ring-2 focus:ring-white focus:outline-hidden focus:ring-inset" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">{{ __('messages.open_main_menu') }}</span>
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
                          {{ __('messages.cv_builder') }}
                      </a>
                      <div class="hidden md:ml-6 md:block">
                        <div class="flex space-x-4">
                            <a href="{{ route('dashboard') }}" wire:navigate  
                                @if(Route::is('dashboard'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-primaryBase hover:text-white"@endif>
                                {{ __('messages.dashboard') }}
                            </a>
                            <a href="{{ route('competences') }}" wire:navigate
                                @if(Route::is('competences'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                                {{ __('messages.competences') }}
                            </a>
                            <a href="{{ route('educations') }}" wire:navigate
                                @if(Route::is('educations'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                                {{ __('messages.educations') }}
                            </a>
                            <a href="{{ route('experiences') }}" wire:navigate
                                @if(Route::is('experiences'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                                {{ __('messages.experiences') }}
                            </a>
                            <a href="{{ route('portfolios') }}" wire:navigate
                                @if(Route::is('portfolios'))class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page"
                                @else class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                                {{ __('messages.portfolio') }}
                            </a>
                        </div>
                      </div>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 md:static md:inset-auto md:ml-6 md:pr-0">
                      @auth
                        @livewire('notifications-dropdown')
                      @else
                        <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                          <span class="absolute -inset-1.5"></span>
                          <span class="sr-only">{{ __('messages.view_notifications') }}</span>
                          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                          </svg>
                        </button>
                        <div class="flex items-center gap-1 ml-3">
                          <a href="{{ route('locale', 'fr') }}" class="@if(app()->getLocale() == 'fr') font-bold text-white @else text-gray-400 @endif hover:text-white text-sm">FR</a>
                          <span class="text-gray-500">|</span>
                          <a href="{{ route('locale', 'en') }}" class="@if(app()->getLocale() == 'en') font-bold text-white @else text-gray-400 @endif hover:text-white text-sm">EN</a>
                        </div>
                      @endauth
                     
                      <!-- Profile dropdown -->
                      @auth
                        <div class="relative ml-3" @click.outside="showDropdown = false">
                          <div>
                            <button @click="showDropdown = !showDropdown" type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                              <span class="absolute -inset-1.5"></span>
                              <span class="sr-only">{{ __('messages.open_user_menu') }}</span>
                              @if (auth()->user()->profile->picture)
                                <img class="size-8 rounded-full" src="{{ Storage::url(auth()->user()->profile->picture) }}" alt="">
                              @else
                                <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                              @endif
                            </button>
                          </div>
                          <div x-cloak x-show="showDropdown" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="{{ route('profile') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">{{ __('messages.profile') }}</a>
                            <a href="{{ route('cv.download') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">{{ __('messages.download_the_cv') }}</a>
                            <a href="{{ route('notifications') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">{{ __('messages.notifications') }}</a>
                            <a href="{{ route('setting') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">{{ __('messages.settings') }}</a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">
                                <span class="text-gray-500">{{ __('messages.language') }}:</span>
                                <div class="flex items-center gap-2 mt-1">
                                    <a href="{{ route('locale', 'fr') }}" class="@if(app()->getLocale() == 'fr') font-bold text-primary @else text-gray-500 @endif hover:text-primary">FR</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="{{ route('locale', 'en') }}" class="@if(app()->getLocale() == 'en') font-bold text-primary @else text-gray-500 @endif hover:text-primary">EN</a>
                                </div>
                            </div>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="document.getElementById('logoutForm').submit();">{{ __('messages.logout') }}</a>
                            <form action="{{ route('logout') }}" method="POST" id="logoutForm">@method('DELETE')@csrf</form>
                          </div>
                        </div>
                      @endauth
                    </div>
                  </div>
                </div>
              
                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="md:hidden" id="mobile-menu">
                  <div x-cloak x-show="showMobile" class="space-y-1 px-2 pt-2 pb-3">
                    <a href="{{ route('dashboard') }}" wire:navigate
                        @if(Route::is('dashboard'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        {{ __('messages.dashboard') }}
                    </a>
                    <a href="{{ route('competences') }}" wire:navigate
                        @if(Route::is('competences'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        {{ __('messages.competences') }}
                    </a>
                    <a href="{{ route('educations') }}" wire:navigate
                        @if(Route::is('educations'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        {{ __('messages.educations') }}
                    </a>
                    <a href="{{ route('experiences') }}" wire:navigate
                        @if(Route::is('experiences'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        {{ __('messages.experiences') }}
                    </a>
                    <a href="{{ route('portfolios') }}" wire:navigate
                        @if(Route::is('portfolios'))class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page"
                        @else class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:primaryBase hover:text-white"@endif>
                        {{ __('messages.portfolio') }}
                    </a>
                  </div>
                </div>
            </nav>
        </header>
          
        <div class="container mx-auto min-h-full px-3 md:px-10 lg:px-20">
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
                          {{ __('messages.want_to_delete_element') }}
                      </p>
                  </div>
                  <!-- Modal footer -->
                  <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                      <template x-if="action">
                        <button @click="$dispatch(action, data)" type="button" id="confirm-delete" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">{{ __('messages.yes') }}</button>
                      </template>
                      <button @click="openModal = false" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary focus:z-10 focus:ring-4 focus:ring-primaryBase">{{ __('messages.no') }}</button>
                  </div>
              </div>
          </div>
        </div>
        @livewire('notifications')
        <footer x-data class="mt-auto bg-black text-white border-black relative">
            <p class="text-center py-3">{{ __('messages.copyright') }}</p>
            <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="absolute -top-6 right-2 bg-primary hover:bg-primary/90 text-white rounded-full p-3 shadow-lg transition-all duration-300 hover:scale-110"
                title="{{ __('messages.scroll_to_top') }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            </button>
        </footer>
        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
