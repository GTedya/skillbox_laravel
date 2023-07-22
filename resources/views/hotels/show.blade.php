@php
    $startDate = request()->get('start_date', \Carbon\Carbon::now()->format('Y-m-d'));
    $endDate = request()->get('end_date', \Carbon\Carbon::now()->addDay()->format('Y-m-d'));
@endphp

<x-app-layout>
    @if(auth()->user()->is_admin)
        <form action="{{ url('hotels',$hotel) }}" method="POST">
            @method('DELETE')
            @csrf
            <x-button>Удалить</x-button>
        </form>
        <x-link-button href="{{ route('hotels.edit', ['hotel' => $hotel]) }}">Изменить</x-link-button>
    @endif
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex flex-wrap mb-12">
            <div class="flex items-center">
                <div class="w-full flex justify-start md:w-1/3 mb-8 md:mb-0">
                    <img class="h-full rounded-l-sm" src="{{ $hotel->poster_url }}" alt="Room Image">
                </div>
                <div class="w-full md:w-2/3 px-4">
                    <div class="text-2xl font-bold">{{ $hotel->name }}</div>

                    <div class="w-5 h-5 mr-1 text-blue-700">{{ $hotel->address }}</div>
                </div>
                <div>{{ $hotel->description }}</div>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="text-2xl text-center md:text-start font-bold">Забронировать комнату</div>

        <form method="get" action="{{ url()->current() }}">
            <div class="flex my-6">
                <div class="flex items-center mr-5">
                    <div class="relative">
                        <input name="start_date" min="{{ date('Y-m-d') }}" value="{{ $startDate }}"
                               placeholder="Дата заезда" type="date"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                    </div>
                    <span class="mx-4 text-gray-500">по</span>
                    <div class="relative">
                        <input name="end_date" type="date" min="{{ date('Y-m-d') }}" value="{{ $endDate }}"
                               placeholder="Дата выезда"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                    </div>
                </div>
                <div>
                    <x-the-button type="submit" class=" h-full w-full">Загрузить номера</x-the-button>
                </div>
                @if(auth()->user()->is_admin)
                    <div class="flex items-center mr-5">
                        <x-link-button class=" h-full w-full" href="{{ route('rooms.create', ['hotel' => $hotel]) }}">
                            Добавить номер
                        </x-link-button>
                    </div>
                @endif
            </div>
        </form>
        @if($startDate && $endDate)
            <div class="flex flex-col w-full lg:w-4/5">
                @foreach($rooms as $room)
                    <x-rooms.room-list-item :room="$room" :startDate="$startDate" :endDate="$endDate" class="mb-4"/>
                    @if(auth()->user()->is_admin)
                        <form action="{{ route('rooms.delete',['room'=>$room, 'hotel' => $room->hotel]) }}"
                              method="POST">
                            @method('DELETE')
                            @csrf
                            <x-the-button class=" h-full w-full">Удалить</x-the-button>
                        </form>
                        <x-link-button href="{{ route('rooms.edit', ['room' => $room,'hotel' => $hotel]) }}">Изменить
                        </x-link-button>
                    @endif
                @endforeach
            </div>
        @else
            <div></div>
        @endif
    </div>
</x-app-layout>
