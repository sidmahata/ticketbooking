<x-frontend-layout>
    <x-slot name="header">
        <div class="columns-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Your Booking') }}
            </h2>
            <div class="text-right">
                <a href="{{route('booking.create')}}">
                    <x-primary-button>{{ __('New Booking') }}</x-primary-button>
                </a>
            </div>
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
                                    <h4 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h4>
                                    <p class="mt-1 text-sm text-gray-600">{{ $booking->client_name }}</p>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ __('From Station') }}</h4>
                                    <p class="mt-1 text-sm text-gray-600">{{ $booking->fromStation->name }}</p>
                                </div>   
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ __('To Station') }}</h4>
                                    <p class="mt-1 text-sm text-gray-600">{{ $booking->toStation->name }}</p>
                                </div>  
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ __('Total Distance') }}</h4>
                                    <p class="mt-1 text-sm text-gray-600">{{ $booking->total_distance }} Km</p>
                                </div> 
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ __('Total Fare') }}</h4>
                                    <p class="mt-1 text-sm text-gray-600">${{ $booking->total_fare}}</p>
                                </div>   
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ __('Date') }}</h4>
                                    <p class="mt-1 text-sm text-gray-600">{{date('d M Y - H:i A', strtotime($booking->created_at));}}</p>
                                </div>                      
                            </div>
                        </form>
                    </section>
    
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>