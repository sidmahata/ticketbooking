<x-app-layout>
    <x-slot name="header">
        <div class="columns-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Station') }}
            </h2>
        </div>        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('station.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="station_name" :value="__('Name')" />
                                    <x-text-input id="station_name" name="name" :value="old('name', '')" class="mt-1 block w-full" />
                                    @error('name')
                                        <x-input-error :messages="$message" class="mt-2" />
                                    @enderror
                                </div>
                                <div>
                                    <x-input-label for="station_zone" :value="__('Zone')" />
                                    <x-select-dropdown id="station_zone" name="zone" :value="old('zone', '')" class="mt-1 block w-full">
                                        <option value=''>Select One</option>
                                        @foreach ($zones as $zone)
                                        <option value="{{$zone->id}}" {{ old("zone") == $zone->id ? "selected" : "" }}>{{$zone->name}}</option>
                                        @endforeach
                                    </x-select-dropdown>
                                    @error('zone')
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
</x-app-layout>