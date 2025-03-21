{{-- resources/views/notifications/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Повідомлення') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h3 class="text-lg font-bold mb-4">Список ваших повідомлень</h3>
            @if(count($notifications) > 0)
                <ul>
                    @foreach($notifications as $notification)
                        <li>{{ $notification }}</li>
                    @endforeach
                </ul>
            @else
                <p>Поки що немає нових повідомлень.</p>
            @endif
        </div>
    </div>
</x-app-layout>
