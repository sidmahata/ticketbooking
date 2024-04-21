<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between h-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-4">
                {{ __('Bookings') }}
            </h2>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right">
                    <x-slot name="trigger">
                        <x-primary-button>
                            {{ __('Reports') }}&nbsp;
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </x-primary-button>                        
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('booking.report', ['type'=>'pdf'])">{{ __('Download Pdf') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('booking.report', ['type'=>'excel'])">{{ __('Download Excel') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('booking.report', ['type'=>'csv'])">{{ __('Download CSV') }}</x-dropdown-link>
                    </x-slot>
                </x-dropdown>
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