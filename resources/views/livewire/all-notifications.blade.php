<div>
    <div class="bg-white lg:w-4/5 md:mx-auto dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden my-5">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Toutes les notifications</h2>
            @if($unreadCount > 0)
                <button wire:click="markAllAsRead" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    Tout marquer comme lu
                </button>
            @endif
        </div>

        <div class="overflow-y-auto max-h-[60vh]">
            @forelse($notifications as $notification)
                <div
                    @if(!$notification->read_at) class="bg-blue-50 dark:bg-blue-900/20" @endif
                    class="border-b border-gray-100 dark:border-gray-700 last:border-0"
                    wire:key="notification-{{ $notification->id }}"
                >
                    <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer" wire:click="markAsRead('{{ $notification->id }}')">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                @if(!$notification->read_at)
                                    <span class="h-2 w-2 rounded-full bg-blue-500 block"></span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                @switch($notification->type)
                                    @case(App\Notifications\ContactNotification::class)
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                Nouveau message de contact de <span class="font-semibold">{{ $notification->data['full_name'] ?? 'Inconnu' }}</span>
                                            </p>
                                            <div class="mt-1 space-y-1">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">Objet:</span> {{ $notification->data['subject'] ?? 'N/A' }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">Date:</span> {{ $notification->created_at->format('d/m/Y à H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    @break
                                    @case(App\Notifications\CVDownloadNotification::class)
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                Téléchargement de CV par <span class="font-semibold">{{ $notification->data['email'] ?? 'Inconnu' }}</span>
                                            </p>
                                            <div class="mt-1 space-y-1">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">IP:</span> {{ $notification->data['ip_address'] ?? 'N/A' }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">Date:</span> {{ $notification->created_at->format('d/m/Y à H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    @break
                                    @default
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                Nouvelle visite de <span class="font-semibold">{{ $notification->data['country_name'] ?? 'Inconnu' }}</span>
                                            </p>
                                            <div class="mt-1 space-y-1">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">IP:</span> {{ $notification->data['ip_address'] ?? 'N/A' }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-medium">Date:</span> {{ $notification->created_at->format('d/m/Y à H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Aucune notification</p>
                </div>
            @endforelse
        </div>
        <div class="mt-5">
            {{ $notifications->links() }}
        </div>
    </div>
</div>