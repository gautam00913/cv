<div x-data="{ showModal: @entangle('showModal') }">
    <div
        x-show="showModal"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div
                x-show="showModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 w-full sm:max-w-lg pb-4"
                @click.away="$wire.closeModal()"
            >
                <h3 class="text-lg font-semibold leading-6 text-white bg-primary p-3" id="modal-title">
                    {{ __('messages.download_cv') }}
                </h3>
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <form wire:submit.prevent="download" class="space-y-5">

                        <div>
                            <label for="email" class="block text-sm font-bold text-primary">{{ __('messages.enter_email_confirm_identity') }} <span class="text-red-600">{{ __('messages.required') }}</span></label>
                            <input
                                type="email"
                                id="email"
                                wire:model="email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm px-2 py-3 border"
                                placeholder="{{ __('messages.placeholder_email') }}"
                            >
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <x-button
                        wire:click="download"
                        target="download"
                        class="w-full sm:ml-3 sm:w-auto bg-primary text-white hover:bg-primary/90"
                    >
                        {{ __('messages.download') }}
                    </x-button>
                    <x-button
                        wire:click="closeModal"
                        target="closeModal"
                        class="mt-3 w-full sm:mt-0 sm:w-auto bg-gray-300 text-gray-700 hover:bg-gray-400 hover:text-primary"
                    >
                        {{ __('messages.cancel') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</div>