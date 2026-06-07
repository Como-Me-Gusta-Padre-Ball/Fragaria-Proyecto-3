<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle - Dior Sauvage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen pb-12">

    <div class="max-w-4xl mx-auto pt-8 px-4">

        <form action="{{ route('main') }}" method="get">
            @csrf
            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 mb-6 inline-block">← Volver al catálogo</button>
        </form>

                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-1/3">
                <img src="https://placehold.co/400x400/eaeaea/a3a3a3?text=Dior+Sauvage" alt="Dior Sauvage" class="w-full rounded-xl object-cover">
            </div>
            <div class="w-full md:w-2/3 flex flex-col justify-center">
                <h1 class="text-3xl font-bold mb-1">Dior Sauvage</h1>
                <p class="text-gray-500 text-sm mb-4">Dior • Amaderado</p>
                <p class="text-gray-700 mb-6 text-sm leading-relaxed">Fragancia moderna y sofisticada con notas frescas y especiadas. Destaca por su gran versatilidad y excelente rendimiento.</p>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Duración promedio</p>
                        <p class="font-bold">8 horas</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Proyección</p>
                        <p class="font-bold">Intenso</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Calificación</p>
                        <p class="font-bold">4.8 / 5 <span class="text-yellow-400">★</span></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Total reseñas</p>
                        <p class="font-bold">124 reseñas</p>
                    </div>
                </div>
            </div>
        </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
            <h2 class="text-xl font-bold mb-4">Añadir Tu Reseña</h2>

                        <p class="text-sm text-gray-700 mb-6">
                Añadir Reseña para comenzar a calificar con estrellas y escribir la reseña.
            </p>

            <form action="{{ route('subir_resena') }}" method="post" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Tu Calificación (haz clic para asignar estrellas)</label>
                    <div class="flex items-center text-gray-300 text-xl cursor-pointer">
                        <span class="hover:text-yellow-400">★</span>
                        <span class="hover:text-yellow-400">★</span>
                        <span class="hover:text-yellow-400">★</span>
                        <span class="hover:text-yellow-400">★</span>
                        <span class="hover:text-yellow-400">★</span>
                    </div>
                </div>

                <div>
                    <label for="review_text" class="block text-sm font-semibold text-gray-800 mb-2">Escribe tu reseña</label>
                    <textarea id="review_text" name="review_text" rows="4" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Excelente perfume..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="duration" class="block text-sm font-semibold text-gray-800 mb-2">Duración (horas)</label>
                        <input type="number" id="duration" name="duration" min="0" max="24" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., 9">
                    </div>
                    <div>
                        <label for="projection" class="block text-sm font-semibold text-gray-800 mb-2">Proyección</label>
                        <select id="projection" name="projection" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500 bg-white">
                            <option value="" disabled selected>Selecciona</option>
                            <option value="Leve">Leve</option>
                            <option value="Moderado">Moderado</option>
                            <option value="Intenso">Intenso</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 text-white text-sm font-semibold px-6 py-3 rounded-md hover:bg-blue-700 transition">Subir reseña</button>
                </div>
            </form>
        </div>

                <h2 class="text-xl font-bold mb-4">Reseñas de usuarios</h2>
        <div class="space-y-4">

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-bold text-sm">@fraglover</p>
                        <p class="text-xs text-gray-400">20 mayo 2026</p>
                    </div>
                    <div class="text-yellow-400 text-sm">★★★★<span class="text-gray-300">★</span></div>
                </div>
                <p class="text-sm text-gray-700 mb-3">Muy elegante y versátil. Perfecto para oficina y ocasiones formales.</p>
                <div class="flex space-x-4 text-xs text-gray-600">
                    <p><span class="font-semibold">Duración:</span> 6 horas</p>
                    <p><span class="font-semibold">Proyección:</span> Moderado</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-bold text-sm">@nightwolf</p>
                        <p class="text-xs text-gray-400">18 mayo 2026</p>
                    </div>
                    <div class="text-yellow-400 text-sm">★★★★★</div>
                </div>
                <p class="text-sm text-gray-700 mb-3">Una bomba. Cumplidos asegurados toda la noche.</p>
                <div class="flex space-x-4 text-xs text-gray-600">
                    <p><span class="font-semibold">Duración:</span> 10 horas</p>
                    <p><span class="font-semibold">Proyección:</span> Intenso</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
