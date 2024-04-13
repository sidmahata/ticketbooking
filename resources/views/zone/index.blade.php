<x-app-layout>
    <x-slot name="header">
        <div class="columns-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Zones') }}
            </h2>
            <div class="text-right">
                <a href="{{route('zone.create')}}">
                    <x-primary-button>{{ __('Add Zone') }}</x-primary-button>
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
                            <th class="text-left p-4 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zones as $zone)
                            <tr>
                                <td class="text-left p-4 ">{{$zone->name}}</td>
                                <td class="text-left p-4 ">
                                    <a class="pe-2" href="{{route('zone.edit', ['zone'=>$zone->id])}}">{{__('Edit')}}</a>
                                    <a href="{{route('zone.delete', ['zone'=>$zone->id])}}">{{__('Delete')}}</a>
                                </td>
                            </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>