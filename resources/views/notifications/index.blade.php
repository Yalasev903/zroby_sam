<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8c0-3.866-3.134-7-7-7S4 4.134 4 8c0 4-2 6-2 6h20s-2-2-2-6z"></path>
                <path d="M14 21a2 2 0 0 1-4 0"></path>
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Повідомлення') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-700">Ваші повідомлення</h3>
                @if($notifications->isNotEmpty())
                <form action="{{ route('notifications.clear') }}" method="POST" onsubmit="return confirm('Ви впевнені?')">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:underline">
                        Очистити всі
                    </button>
                </form>
            @endif
            </div>

            @if($notifications->isNotEmpty())
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                        <div class="p-4 border rounded-lg shadow-sm bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $notification->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $notification->message }}</p>
                                </div>
                                <span class="text-xs text-gray-500">{{ $notification->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8c0-3.866-3.134-7-7-7S4 4.134 4 8c0 4-2 6-2 6h20s-2-2-2-6z"></path>
                        <path d="M14 21a2 2 0 0 1-4 0"></path>
                    </svg>
                    <p class="text-gray-600 mt-2">Поки що немає нових повідомлень.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
