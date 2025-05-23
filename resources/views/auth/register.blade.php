<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-pink-500 to-purple-700">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-6 text-purple-700">Daftar KomikOnline</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700" for="name">Nama</label>
                    <input type="text" id="name" name="name" required autofocus
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700" for="password">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700" for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <button type="submit"
                        class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
                    Daftar
                </button>
            </form>

            <p class="mt-4 text-sm text-center text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Login di sini</a>
            </p>
        </div>
    </div>
</x-guest-layout>
