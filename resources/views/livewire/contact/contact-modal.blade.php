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
                    {{ __('messages.contact_me') }}
                </h3>
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    @if ($isSuccess)
                        <div class="max-w-md mx-auto mt-10">
                            <div class="flex items-start gap-4 bg-teal-50 border border-teal-200 text-teal-800 p-4 rounded-lg shadow-sm">
                                <!-- Icon -->
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 text-teal-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <!-- Content -->
                                <div>
                                    <h3 class="font-semibold text-teal-700">{{ __('messages.message_sent') }}</h3>
                                    <p class="text-sm mt-1 text-teal-600">
                                        {{ __('messages.your_message_sent_successfully') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <form wire:submit.prevent="submit" class="space-y-5">
                            <div>
                                <label for="full_name" class="block text-sm font-bold text-primary">{{ __('messages.full_name') }} <span class="text-red-600">{{ __('messages.required') }}</span></label>
                                <input
                                    type="text"
                                    id="full_name"
                                    wire:model="full_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm px-2 py-3 border"
                                    placeholder="{{ __('messages.placeholder_full_name') }}"
                                >
                                @error('full_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-bold text-primary">{{ __('messages.email') }} <span class="text-red-600">{{ __('messages.required') }}</span></label>
                                <input
                                    type="email"
                                    id="email"
                                    wire:model="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm px-2 py-3 border"
                                    placeholder="{{ __('messages.placeholder_email') }}"
                                >
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-bold text-primary">{{ __('messages.phone_optional') }}</label>
                                <input
                                    type="tel"
                                    id="phone"
                                    wire:model="phone"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm px-2 py-3 border"
                                    placeholder="{{ __('messages.placeholder_phone') }}"
                                >
                                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-bold text-primary">{{ __('messages.subject_contact') }} <span class="text-red-600">{{ __('messages.required') }}</span></label>
                                <input
                                    type="text"
                                    id="subject"
                                    wire:model="subject"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm px-2 py-3 border"
                                    placeholder="{{ __('messages.placeholder_subject') }}"
                                >
                                @error('subject') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-bold text-primary">{{ __('messages.message') }} <span class="text-red-600">{{ __('messages.required') }}</span></label>
                                <textarea
                                    id="message"
                                    wire:model="message"
                                    rows="5"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm px-2 py-3 border"
                                    placeholder="{{ __('messages.placeholder_message') }}"
                                ></textarea>
                                @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </form>
                    @endif
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    @if ($isSuccess)
                        <x-button
                            wire:click="closeModal"
                            target="closeModal"
                            class="w-full sm:ml-3 sm:w-auto bg-primary text-white hover:bg-primary/90"
                        >
                            {{ __('messages.close') }}
                        </x-button>
                    @else
                        <x-button
                            wire:click="submit"
                            target="submit"
                            class="w-full sm:ml-3 sm:w-auto bg-primary text-white hover:bg-primary/90"
                        >
                            {{ __('messages.send') }}
                        </x-button>
                        <x-button
                            wire:click="closeModal"
                            target="closeModal"
                            class="mt-3 w-full sm:mt-0 sm:w-auto bg-gray-300 text-gray-700 hover:bg-gray-400 hover:text-primary"
                        >
                            {{ __('messages.cancel') }}
                        </x-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>