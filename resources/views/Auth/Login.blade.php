<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Fragaria</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-2">Fragaria</h1>
            <p class="text-gray-500 text-sm">Bienvenido de vuelta</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-800 mb-1">Correo Electrónico</label>
                <input type="email" id="email" name="email"
                    class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="correo@ejemplo.com" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-800 mb-1">Contraseña</label>
                <input type="password" id="password" name="password"
                    class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="••••••••" required>
            </div>

            <div class="flex items-center justify-between mt-2">
                <label class="flex items-center space-x-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember"
                        class="text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <span>Recordarme</span>
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white text-sm font-semibold py-3 rounded-lg hover:bg-blue-700 transition mt-4">
                Iniciar Sesión
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Regístrate</a>
        </p>
    </div>

</body>

</html>