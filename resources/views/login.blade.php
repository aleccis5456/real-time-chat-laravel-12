<x-layouts.app>
    <div class="relative bg-gray-800 h-screen">
        <div
            class="absolute top-64 right-0 left-0 mx-auto items-center justify-center bg-gray-500 p-5 max-w-xl rounded-lg shadow-lg">
            <div class="p-12">
                <h2 class="text-2xl text-white font-bold mb-6">Iniciar Sesión</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-white text-sm font-bold mb-2">Email:</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-800"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-white text-sm font-bold mb-2">Contraseña:</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-800"
                            required>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="cursor-pointer border border-white bg-gray-500 hover:border-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Iniciar Sesión
                        </button>
                        <p>
                            ¿No tienes una cuenta?
                            <a href="{{ route('register') }}"
                                class="inline-block align-baseline font-bold text-sm text-white">
                                Registrarse
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
