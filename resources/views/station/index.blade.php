<x-app-layout>
    <x-slot name="header">
        <div class="columns-2 py-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Stations') }}
            </h2>
            <div class="text-right">
                <a href="{{route('station.create')}}">
                    <x-primary-button>{{ __('Add Station') }}</x-primary-button>
                </a>
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
                            <th class="text-left p-4 border-b">Name</th>
                            <th class="text-left p-4 border-b">Zone</th>
                            <th class="text-left p-4 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stations as $station)
                            <tr>
                                <td class="text-left p-4 ">{{$station->name}}</td>
                                <td class="text-left p-4 ">{{$station->zone->name}}</td>
                                <td class="text-left p-4 ">
                                    <a class="pe-2" href="{{route('station.edit', ['station'=>$station->id])}}">{{__('Edit')}}</a>
                                    <a href="{{route('station.delete', ['station'=>$station->id])}}">{{__('Delete')}}</a>
                                </td>
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