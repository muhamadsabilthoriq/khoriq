<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Manga') }}
            </h2>

            @auth
                <a href="{{ route('manga.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-semibold shadow">
                    + Tambah Manga
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($mangas->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($mangas as $manga)
                                <a href="{{ route('manga.show', $manga->id) }}"
                                   class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden shadow hover:shadow-md transition duration-300">
                                    
                                    @if ($manga->cover_image)
                                        <img src="{{ asset('storage/' . $manga->cover_image) }}"
                                             alt="{{ $manga->title }}"
                                             class="w-full h-52 object-cover">
                                    @else
                                        <div class="w-full h-52 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-300 text-sm">
                                            Tidak ada cover
                                        </div>
                                    @endif

                                    <div class="p-4">
                                        <h3 class="text-lg font-bold text-gray-800 dark:text-white truncate">
                                            {{ $manga->title }}
                                        </h3>

                                        @if ($manga->author)
                                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                {{ $manga->author }}
                                            </p>
                                        @endif

                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                                            {{ Str::limit($manga->description, 120) }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $mangas->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-300">Belum ada manga tersedia.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
