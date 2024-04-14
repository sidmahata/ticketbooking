<x-app-layout>
    <x-slot name="header">
        <div class="columns-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bookings') }}
            </h2>
            <div class="text-right">
                <!-- <a href="{{route('distance.create')}}">
                    <x-primary-button>{{ __('Add Distance') }}</x-primary-button>
                </a> -->
            </div>
        </div>        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                            <th class="text-left p-4 border-b">Client Name</th>
                            <th class="text-left p-4 border-b">Fron Station</th>
                            <th class="text-left p-4 border-b">To Station</th>
                            <th class="text-left p-4 border-b">Total Distance(Km)</th>
                            <th class="text-left p-4 border-b">Total Fare ($)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                            <tr>
                                <td class="text-left p-4 ">{{$booking->client_name}}</td>
                                <td class="text-left p-4 ">{{$booking->fromStation->name}}</td>
                                <td class="text-left p-4 ">{{$booking->toStation->name}}</td>
                                <td class="text-left p-4 ">{{$booking->total_distance}}</td>
                                <td class="text-left p-4 ">{{$booking->total_fare}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center p-4 ">No record found</td>
                            </tr>
                            @endforelse                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>