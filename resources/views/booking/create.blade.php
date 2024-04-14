<x-frontend-layout>
    <x-slot name="header">
        <div class="columns-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New Booking') }}
            </h2>
        </div>        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('booking.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="booking_from_station" :value="__('From Station')" />
                                    <x-select-dropdown id="booking_from_station" name="from_station" :value="old('from_station', '')" class="mt-1 block w-full">
                                        <option value=''>Select One</option>
                                        @foreach ($stations as $station)
                                        <option value="{{$station->id}}" {{ old("from_station") == $station->id ? "selected" : "" }}>{{$station->name}}</option>
                                        @endforeach
                                    </x-select-dropdown>
                                    @error('from_station')
                                        <x-input-error :messages="$message" class="mt-2" />
                                    @enderror
                                </div>
                                <div>
                                    <x-input-label for="booking_to_station" :value="__('To Station')" />
                                    <x-select-dropdown id="booking_to_station" name="to_station" :value="old('to_station', '')" class="mt-1 block w-full">
                                        <option value=''>Select One</option>
                                        @foreach ($stations as $station)
                                        <option value="{{$station->id}}" {{ old("to_station") == $station->id ? "selected" : "" }}>{{$station->name}}</option>
                                        @endforeach
                                    </x-select-dropdown>
                                    @error('to_station')
                                        <x-input-error :messages="$message" class="mt-2" />
                                    @enderror
                                </div>   
                                <div>
                                    <x-input-label for="booking_client_name" :value="__('Your Name')" />
                                    <x-text-input id="booking_client_name" name="client_name" :value="old('client_name', '')" class="mt-1 block w-full" />
                                    @error('client_name')
                                        <x-input-error :messages="$message" class="mt-2" />
                                    @enderror
                                    
                                </div>                          
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
    
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>