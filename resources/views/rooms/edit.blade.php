<x-app-layout>
    <form method="POST" action="{{ route('rooms.update', ['room' => $room,'hotel' => $hotel]) }}">
        @csrf
        @method('PATCH')

        <!-- Email Address -->
        <div>
            <x-input-label for="title" :value="__('Title')"/>
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$room->title" required/>
        </div>
        <div>
            <x-input-label for="description" :value="__('Description')"/>
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                          :value="$room->description" required/>
        </div>
        <div>
            <x-input-label for="poster_url" :value="__('Image link')"/>
            <x-text-input id="poster_url" class="block mt-1 w-full" type="text" name="poster_url"
                          :value="$room->poster_url"/>
        </div>
        <div>
            <x-input-label for="type" :value="__('Type')"/>
            <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="$room->type"/>
        </div>
        <div>
            <x-input-label for="floor_area" :value="__('Floor Area')"/>
            <x-text-input id="floor_area" class="block mt-1 w-full" type="text" name="floor_area"
                          :value="$room->floor_area"/>
        </div>
        <div>
            <x-input-label for="price" :value="__('Price')"/>
            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="$room->price"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>Сохранить
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
