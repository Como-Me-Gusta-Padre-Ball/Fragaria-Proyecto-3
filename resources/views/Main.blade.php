<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fragaria - Catálogo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 flex h-screen overflow-hidden">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col h-full">
        <div class="p-6 flex-1 overflow-y-auto">
            <h1 class="text-2xl font-bold mb-6">Fragaria</h1>

            <div class="bg-gray-50 p-3 rounded-lg mb-6">
                @auth
                    <p class="font-bold text-sm">{{ auth()->user()->Nickname ?? '@' . auth()->user()->user_name }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                @else
                    <p class="font-bold text-sm">@invitado</p>
                    <p class="text-xs text-gray-500">Sin iniciar sesión</p>
                @endauth
            </div>

            <form method="GET" action="{{ route('main') }}" id="filter-form">
                <div class="mb-6">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar perfume..." class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <button type="submit" class="hidden">Buscar</button> </div>

                <div class="mb-6">
                    <h3 class="font-bold text-sm mb-3">Filtrar por marca</h3>
                    <div class="space-y-2 text-sm text-gray-700">
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="marca" value="" onchange="this.form.submit()" {{ blank(request('marca')) ? 'checked' : '' }} class="text-blue-600"> <span>Todas</span>
                        </label>
                        @foreach(['Dior', 'Chanel', 'Versace', 'YSL', 'Armani'] as $marca)
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="marca" value="{{ $marca }}" onchange="this.form.submit()" {{ request('marca') == $marca ? 'checked' : '' }} class="text-blue-600"> <span>{{ $marca }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-sm mb-3">Filtrar por familia olfativa</h3>
                    <div class="space-y-2 text-sm text-gray-700">
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="familia" value="" onchange="this.form.submit()" {{ blank(request('familia')) ? 'checked' : '' }} class="text-blue-600"> <span>Todas</span>
                        </label>
                        @foreach(['Amaderado', 'Oriental', 'Cítrico', 'Dulce', 'Aromático'] as $familia)
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="familia" value="{{ $familia }}" onchange="this.form.submit()" {{ request('familia') == $familia ? 'checked' : '' }} class="text-blue-600"> <span>{{ $familia }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

        <div class="p-4 border-t border-gray-200">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-gray-800 text-white text-sm font-semibold py-2 rounded-md hover:bg-gray-700 transition cursor-pointer">
                        Cerrar sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-center w-full bg-blue-600 text-white text-sm font-semibold py-2 rounded-md hover:bg-blue-500 transition cursor-pointer">
                    Iniciar sesión
                </a>
            @endauth
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-8">
        <h2 class="text-3xl font-bold mb-8">Catálogo de perfumes</h2>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            @foreach($perfumes as $perfume)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 flex overflow-hidden h-56">
                    <div class="w-2/5 bg-gray-200">
                        <img src="{{ $perfume->imagen_url ?? 'https://placehold.co/400x500/eaeaea/a3a3a3?text=Sin+Imagen' }}" alt="{{ $perfume->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="w-3/5 p-5 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-1">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">{{ $perfume->marca }}</p>
                                    <h3 class="text-xl font-bold">{{ $perfume->name }}</h3>
                                </div>
                                <form action="{{ route('detalle.main') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="perfume_id" value="{{ $perfume->id }}">
                                    <button type="submit" class="bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1 rounded-md hover:bg-blue-100 transition">Ver detalle</button>
                                </form>
                            </div>
                            <span class="inline-block bg-gray-100 text-gray-600 text-[10px] px-2 py-1 rounded-md mb-3">{{ $perfume->categoria_olfativa }}</span>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $perfume->descripcion }}</p>
                            <div class="text-xs text-gray-700 space-y-1">
                                @php
                                    $promedioDuracion = $perfume->Reseña->avg('duracion') ?? 0;
                                    $promedioProyeccion = $perfume->Reseña->avg('proyeccion') ?? 0;
                                    if ($promedioProyeccion == 0) {
                                        $textoProyeccion = 'Sin datos';
                                    } elseif ($promedioProyeccion < 1.5) {
                                        $textoProyeccion = 'Suave';
                                    } elseif ($promedioProyeccion < 2.5) {
                                        $textoProyeccion = 'Moderado';
                                    } else {
                                        $textoProyeccion = 'Fuerte';
                                    }
                                @endphp
                                <p><span class="font-semibold">Duración:</span> {{ number_format($promedioDuracion, 1) }} horas</p>
                                <p>
                                    <span class="font-semibold">Proyección:</span>
                                    <span class="text-blue-600 font-medium">{{ $textoProyeccion }} </span>
                                </p>
                            </div>
                        </div>
                            <div class="flex items-center mt-3">
                            @php
                                $promedio = $perfume->Reseña->avg('calificacion') ?? 0;
                                $estrellasLlenas = round($promedio);
                                $estrellasVacias = 5 - $estrellasLlenas;
                            @endphp

                            <div class="text-yellow-400 text-sm">
                                {{ str_repeat('★', $estrellasLlenas) }}

                                <span class="text-gray-300">{{ str_repeat('★', $estrellasVacias) }}</span>
                            </div>

                            <span class="text-xs text-gray-700 font-bold ml-2">{{ number_format($promedio, 1) }}</span>
                            <span class="text-xs text-gray-500 ml-1">({{ $perfume->Reseña->count() }} reseñas)</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

</body>
</html>

