<x-app-layout>
    <form method="POST" action="{{ route('bookings.update', ['booking' => $bookings]) }}">
        @csrf
        @method('PATCH')
        <!-- Email Address -->

        <div class="flex items-center mr-5">
            <div class="relative">
                <input name="start_date" min="{{ date('Y-m-d') }}"
                       value="{{\Carbon\Carbon::make($bookings->started_at)->format('Y-m-d')}}"
                       placeholder="Дата заезда" type="date"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
            </div>
            <span class="mx-4 text-gray-500">по</span>
            <div class="relative">
                <input name="end_date" type="date" min="{{ date('Y-m-d') }}"
                       value="{{\Carbon\Carbon::make($bookings->finished_at)->format('Y-m-d')}}"
                       placeholder="Дата выезда"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>Сохранить
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
