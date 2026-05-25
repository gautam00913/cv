<div x-data="{ show: false }" @click.outside="show = false" class="relative">
    <button
        @click="show = !show"
        type="button"
        class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
    >
        <span class="absolute -inset-1.5"></span>
        <span class="sr-only">{{ __('messages.view_notifications') }}</span>
        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>
        @if($unreadCount > 0)
            <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-medium text-white">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    <div
        x-cloak
        x-show="show"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-10 mt-2 min-w-64 sm:w-80 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
        role="menu"
    >
        <div class="flex items-center justify-between px-4 py-2 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-900">{{ __('messages.notifications') }}</h3>
            @if($unreadCount > 0)
                <button
                    wire:click="markAllAsRead"
                    class="text-xs text-blue-600 hover:text-blue-800"
                >
                    {{ __('messages.mark_all_as_read') }}
                </button>
            @endif
        </div>

        @forelse($notifications as $notification)
            <div
                @if(!$notification->read_at) class="bg-blue-50" @endif
                class="border-b border-gray-100 last:border-0"
                wire:key="notification-{{ $notification->id }}"
            >
                <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer" wire:click="markAsRead('{{ $notification->id }}')">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 mt-0.5">
                            @if(!$notification->read_at)
                                <span class="h-2 w-2 rounded-full bg-blue-500 block"></span>
                            @endif
                        </div>
                        @switch($notification->type)
                            @case(App\Notifications\ContactNotification::class)
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ __('messages.new_contact_message_from') }} <span class="font-semibold">{{ $notification->data['full_name'] ?? __('messages.unknown') }}</span>
                                        </p>
                                        <div class="mt-1 space-y-1">
                                            <p class="text-xs text-gray-500">
                                                <span class="font-medium">{{ __('messages.subject') }}:</span> {{ $notification->data['subject'] ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                @break
                            @case(App\Notifications\CVDownloadNotification::class)
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ __('messages.cv_downloaded_by') }} <span class="font-semibold">{{ $notification->data['email'] ?? __('messages.unknown') }}</span>
                                        </p>
                                        <div class="mt-1 space-y-1">
                                            <p class="text-xs text-gray-500">
                                                <span class="font-medium">IP:</span> {{ $notification->data['ip_address'] ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                @break
                        
                            @default
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ __('messages.new_visit_from') }} <span class="font-semibold">{{ $notification->data['country_name'] ?? __('messages.unknown') }}</span>
                                    </p>
                                    <div class="mt-1 space-y-1">
                                        <p class="text-xs text-gray-500">
                                            <span class="font-medium">IP:</span> {{ $notification->data['ip_address'] ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            <span class="font-medium">{{ __('messages.date') }}:</span> {{ $notification->data['date'] ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                        @endswitch
                    </div>
                </div>
            </div>
        @empty
            <div class="px-4 py-6 text-center">
                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
                <p class="mt-2 text-sm text-gray-500">{{ __('messages.no_notifications') }}</p>
            </div>
        @endforelse
    </div>
</div>