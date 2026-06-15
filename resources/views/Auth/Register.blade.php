<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Fragaria</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-2">Fragaria</h1>
            <p class="text-gray-500 text-sm">Crea tu cuenta para descubrir y reseñar</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="user_name" class="block text-sm font-semibold text-gray-800 mb-1">Nombre Completo</label>
                <input type="text" id="user_name" name="user_name" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ej. Juan Pérez" required>
            </div>

            <div>
                <label for="Nickname" class="block text-sm font-semibold text-gray-800 mb-1">Nickname</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 text-sm">@</span>
                    <input type="text" id="Nickname" name="Nickname" class="w-full border border-gray-300 rounded-lg p-3 pl-8 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="usuario_unico" required>
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-800 mb-1">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="correo@ejemplo.com" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-800 mb-1">Contraseña</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-gray-900 text-white text-sm font-semibold py-3 rounded-lg hover:bg-gray-800 transition mt-6">
                Registrarse
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Inciar sesión</a>
        </p>
    </div>

</body>
</html>

