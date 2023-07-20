<div class="bg-white rounded shadow-md flex card text-grey-darkest">
    <img class="w-1/2 h-full rounded-l-sm" src="{{ $hotel->poster_url }}" alt="Hotel Image">
    <div class="w-full flex flex-col justify-between p-4">
        <div>
            <a class="block text-grey-darkest mb-2 font-bold"
               href="{{ route('hotels.show', ['hotel' => $hotel]) }}">{{ $hotel->name }}</a>
            <div class="text-xs">
                {{ $hotel->address }}
            </div>
        </div>
        <div class="pt-2">
            <span class="text-2xl text-grey-darkest">₽{{ $hotel->price }}</span>
            <span class="text-lg"> за ночь</span>
        </div>
        @if($hotel->facilities->isNotEmpty())
            <div class="flex items-center py-2">
                @foreach($hotel->facilities->take(2) as $facility)
                    <div class="pr-2 text-xs">
                        <span>•</span> {{ $facility->title }}
                    </div>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="flex justify-end">
                <x-link-button href="{{ route('hotels.show', ['hotel' => $hotel]) }}">Подробнее</x-link-button>
            </div>
            @if(auth()->user()->is_admin)
                <div class="flex justify-center">
                    <x-link-button href="{{ route('hotels.edit', ['hotel' => $hotel]) }}">Изменить</x-link-button>
                </div>
                <div class="flex sm:justify-start">
                    <x-link-button href="{{ route('hotels.show', ['hotel' => $hotel]) }}">Удалить</x-link-button>
                </div>
            @endif
        </div>

    </div>
</div>
