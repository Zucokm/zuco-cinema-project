<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Cinema: ') }} {{ $cinema->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.cinemas.update', $cinema->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" :value="__('Cinema Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $cinema->name) }}" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ old('address', $cinema->address) }}" required />
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-input-label for="township" :value="__('Township')" />
                            <x-text-input id="township" class="block mt-1 w-full" type="text" name="township" value="{{ old('township', $cinema->township) }}" required />
                        </div>
                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" value="{{ old('city', $cinema->city) }}" required />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Phone Number')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ old('phone', $cinema->phone) }}" required />
                    </div>

                    @if($cinema->photoPath)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 mb-2">Current Photo:</p>
                            <img src="{{ asset('storage/' . $cinema->photoPath) }}" class="w-32 h-20 object-cover rounded shadow">
                        </div>
                    @endif

                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('Replace Photo (Optional)')" />
                        <input type="file" name="photo" class="mt-1 block w-full text-sm text-gray-500" />
                    </div>

                    <div class="flex items-center justify-end mt-6 border-t pt-4">
                        <x-secondary-button onclick="window.history.back()" class="me-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>{{ __('Update Cinema') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>