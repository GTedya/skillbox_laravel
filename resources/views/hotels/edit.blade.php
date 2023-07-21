<x-app-layout>
    <form method="POST" action="{{ route('hotels.update', ['hotel' => $hotel]) }}">
        @csrf
        @method('PATCH')
        <!-- Email Address -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$hotel->title ?? null" required />
        </div>
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$hotel->description ?? null" required />
        </div>
        <div>
            <x-input-label for="poster_url" :value="__('Image link')" />
            <x-text-input id="poster_url" class="block mt-1 w-full" type="text" name="poster_url" :value="$hotel->poster_url ?? null" />
        </div>
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$hotel->address ?? null" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>Сохранить
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
