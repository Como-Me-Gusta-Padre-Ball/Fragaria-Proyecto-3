<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle - {{ $perfume->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 min-h-screen pb-12">

    <div class="max-w-4xl mx-auto pt-8 px-4">

        <form action="{{ route('main') }}" method="get">
            @csrf
            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 mb-6 inline-block">← Volver al catálogo</button>
        </form>

        <!-- Información del Perfume -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 flex flex-col md:flex-row gap-8">
            <!-- Imagen del perfume dinámica -->
            <div class="w-full md:w-1/3">
                <img src="{{ $perfume->imagen_url ?? 'https://placehold.co/400x500/eaeaea/a3a3a3?text=Sin+Imagen' }}" alt="{{ $perfume->name }}" class="w-full rounded-xl object-cover max-h-80">
            </div>

            <!-- Información del Perfume -->
            <div class="w-full md:w-2/3 flex flex-col justify-center">
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">{{ $perfume->marca }}</p>
                <h1 class="text-3xl font-bold mb-1">{{ $perfume->name }}</h1>
                <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-md mb-4 self-start">{{ $perfume->categoria_olfativa }}</span>

                <p class="text-gray-700 mb-6 text-sm leading-relaxed">{{ $perfume->descripcion }}</p>

                <!-- Bloque de Métricas calculadas dinámicamente -->
                @php
                    $promedioDuracion = $perfume->Reseña->avg('duracion') ?? 0;
                    $promedioProyeccion = $perfume->Reseña->avg('proyeccion') ?? 0;
                    $promedioCalificacion = $perfume->Reseña->avg('calificacion') ?? 0;

                    if ($promedioProyeccion == 0) {
                        $textoProyeccion = 'Sin datos';
                    } elseif ($promedioProyeccion < 1.5) {
                        $textoProyeccion = 'Leve';
                    } elseif ($promedioProyeccion < 2.5) {
                        $textoProyeccion = 'Moderado';
                    } else {
                        $textoProyeccion = 'Intenso';
                    }
                @endphp

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Duración promedio</p>
                        <p class="font-bold text-gray-800">{{ number_format($promedioDuracion, 1) }} horas</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Proyección</p>
                        <p class="font-bold text-blue-600">{{ $textoProyeccion }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Calificación</p>
                        <p class="font-bold text-gray-800">
                            {{ number_format($promedioCalificacion, 1) }} / 5
                            <span class="text-yellow-400">★</span>
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 mb-1">Total reseñas</p>
                        <p class="font-bold text-gray-800">{{ isset($reseñas) ? count($reseñas) : 0 }} reseñas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección del Formulario -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
            <h2 class="text-xl font-bold mb-4" id="form_title">Añadir Tu Reseña</h2>

            @auth
                <p class="text-sm text-gray-700 mb-6">
                    Hola, <strong>{{ Auth::user()->Nickname ?? Auth::user()->user_name }}</strong>. Añade tu reseña para comenzar a calificar con estrellas.
                </p>

                <form action="{{ route('subir_resena') }}" method="post" class="space-y-6" id="resena_form">
                    @csrf

                    <input type="hidden" name="perfume_id" value="{{ $perfume->id }}">
                    <input type="hidden" name="calificacion" id="calificacion_input" value="{{ old('calificacion', 0) }}">

                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">Tu Calificación (haz clic para asignar estrellas)</label>
                        <div class="flex items-center text-gray-300 text-2xl cursor-pointer space-x-1" id="estrellas_div">
                            <span class="estrella hover:text-yellow-400 transition-colors" data-val="1">★</span>
                            <span class="estrella hover:text-yellow-400 transition-colors" data-val="2">★</span>
                            <span class="estrella hover:text-yellow-400 transition-colors" data-val="3">★</span>
                            <span class="estrella hover:text-yellow-400 transition-colors" data-val="4">★</span>
                            <span class="estrella hover:text-yellow-400 transition-colors" data-val="5">★</span>
                        </div>
                    </div>

                    <div>
                        <label for="review_text" class="block text-sm font-semibold text-gray-800 mb-2">Escribe tu reseña</label>
                        <textarea id="review_text" name="comentario" rows="4" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Excelente perfume...">{{ old('comentario') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="duration" class="block text-sm font-semibold text-gray-800 mb-2">Duración (horas)</label>
                            <input type="number" id="duration" name="duracion" min="1" max="24" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., 9" value="{{ old('duracion') }}">
                        </div>
                        <div>
                            <label for="projection" class="block text-sm font-semibold text-gray-800 mb-2">Proyección</label>
                            <select id="projection" name="proyeccion" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500 bg-white">
                                <option value="" disabled selected>Selecciona</option>
                                <option value="1" {{ old('proyeccion') == '1' ? 'selected' : '' }}>Leve</option>
                                <option value="2" {{ old('proyeccion') == '2' ? 'selected' : '' }}>Moderado</option>
                                <option value="3" {{ old('proyeccion') == '3' ? 'selected' : '' }}>Intenso</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-blue-600 text-white text-sm font-semibold px-6 py-3 rounded-md hover:bg-blue-700 transition">Subir reseña</button>
                    </div>
                </form>
            @else
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-center">
                    <p class="text-gray-600 mb-4">Debes iniciar sesión para poder dejar tu opinión sobre este perfume.</p>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white text-sm font-semibold px-6 py-2 rounded-md hover:bg-blue-700 transition inline-block">
                        Iniciar sesión
                    </a>
                </div>
            @endauth
        </div>

        <!-- Listado Inferior de Reseñas -->
        <h2 class="text-xl font-bold mb-4">Reseñas de usuarios</h2>

        <div class="space-y-4">
            @if(isset($reseñas) && count($reseñas) > 0)

                {{-- 1. IDENTIFICAR SI EL USUARIO EN SESIÓN TIENE UNA RESEÑA AQUÍ --}}
                @php
                    $resenaUsuarioActual = Auth::check()
                        ? $reseñas->where('user_id', Auth::id())->first()
                        : null;
                @endphp

                {{-- SI EL USUARIO TIENE RESEÑA, SE DESPLIEGA CON PRIORIDAD ABSOLUTA EN LA CIMA --}}
                @if($resenaUsuarioActual)
                    <div class="bg-blue-50/60 rounded-2xl shadow-sm p-6 border-2 border-blue-200 relative">
                        <span class="absolute top-3 right-4 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full">
                            Tu Reseña
                        </span>

                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-bold text-sm text-blue-900">{{ $resenaUsuarioActual->user->Nickname ?? $resenaUsuarioActual->user->user_name ?? 'Tu Cuenta' }}</p>
                                <p class="text-xs text-gray-400">{{ $resenaUsuarioActual->fecha_publicacion }}</p>
                            </div>
                            <div class="text-yellow-400 text-sm mr-16">
                                @for($i = 0; $i < $resenaUsuarioActual->calificacion; $i++) ★ @endfor
                            </div>
                        </div>

                        <p class="text-sm text-gray-700 mb-4">{{ $resenaUsuarioActual->comentario }}</p>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs text-gray-600 border-t border-blue-100 pt-3">
                            <div class="flex space-x-4">
                                <p><span class="font-semibold">Duración:</span> {{ $resenaUsuarioActual->duracion }} horas</p>
                                <p><span class="font-semibold">Proyección:</span>
                                    @if($resenaUsuarioActual->proyeccion == 1) Leve
                                    @elseif($resenaUsuarioActual->proyeccion == 2) Moderado
                                    @elseif($resenaUsuarioActual->proyeccion == 3) Intenso
                                    @else {{ $resenaUsuarioActual->proyeccion }} @endif
                                </p>
                            </div>

                            {{-- BOTONES EXCLUSIVOS PARA EL PROPIETARIO DE LA RESEÑA --}}
                            <div class="flex space-x-2 self-end sm:self-auto">
                                <button onclick="prepararEdicion('{{ $resenaUsuarioActual->comentario }}', '{{ $resenaUsuarioActual->calificacion }}', '{{ $resenaUsuarioActual->duracion }}', '{{ $resenaUsuarioActual->proyeccion }}')" class="bg-amber-50 text-amber-700 border border-amber-200 text-xs font-semibold px-3 py-1.5 rounded-md hover:bg-amber-100 transition flex items-center gap-1">
                                    ✏️ Editar
                                </button>

                                <form action="{{ route('eliminar_resena', $resenaUsuarioActual->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar tu reseña? Esta acción no se puede deshacer.');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 border border-red-200 text-xs font-semibold px-3 py-1.5 rounded-md hover:bg-red-100 transition flex items-center gap-1">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- 2. DESPLIEGUE DEL RESTO DE LAS RESEÑAS --}}
                @foreach($reseñas as $reseña)
                    @if(!Auth::check() || $reseña->user_id != Auth::id())
                        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-bold text-sm">{{ $reseña->user->Nickname ?? $reseña->user->user_name ?? 'Usuario' }}</p>
                                    <p class="text-xs text-gray-400">{{ $reseña->fecha_publicacion }}</p>
                                </div>
                                <div class="text-yellow-400 text-sm">
                                    @for($i = 0; $i < $reseña->calificacion; $i++) ★ @endfor
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 mb-3">{{ $reseña->comentario }}</p>
                            <div class="flex space-x-4 text-xs text-gray-600">
                                <p><span class="font-semibold">Duración:</span> {{ $reseña->duracion }} horas</p>
                                <p><span class="font-semibold">Proyección:</span>
                                    @if($reseña->proyeccion == 1) Leve
                                    @elseif($reseña->proyeccion == 2) Moderado
                                    @elseif($reseña->proyeccion == 3) Intenso
                                    @else {{ $reseña->proyeccion }} @endif
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p class="text-sm text-gray-500">Aún no hay reseñas registradas para este perfume.</p>
            @endif
        </div>
    </div>

    <!-- POPUPS DIRECTOS USANDO INYECCIÓN BLADE -->
    @if ($errors->any())
        <script>
            alert("Atención:\n- {!! implode('\n- ', $errors->all()) !!}");
        </script>
    @endif

    @if (session('success'))
        <script>
            alert("¡Éxito!\n{!! session('success') !!}");
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const estrellas = document.querySelectorAll('.estrella');
            const inputCalificacion = document.getElementById('calificacion_input');

            // Función reutilizable para pintar estrellas en la UI
            window.pintarEstrellas = function(valor) {
                estrellas.forEach(e => {
                    e.classList.remove('text-yellow-400');
                    e.classList.add('text-gray-300');
                });

                for(let i = 0; i < valor; i++) {
                    if(estrellas[i]) {
                        estrellas[i].classList.remove('text-gray-300');
                        estrellas[i].classList.add('text-yellow-400');
                    }
                }
            }

            estrellas.forEach(estrella => {
                estrella.addEventListener('click', function() {
                    const valor = this.getAttribute('data-val');
                    inputCalificacion.value = valor;
                    pintarEstrellas(valor);
                });
            });
        });

        // Carga los datos de la reseña en el formulario superior y actualiza las estrellas
        // Carga los datos de la reseña en el formulario superior y cambia el botón a modo actualizar
function prepararEdicion(comentario, calificacion, duracion, proyeccion) {
    const textarea = document.getElementById('review_text');
    if(textarea) {
        textarea.value = comentario;
        textarea.focus();
    }

    const inputDuracion = document.getElementById('duration');
    if(inputDuracion) inputDuracion.value = duracion;

    const selectProyeccion = document.getElementById('projection');
    if(selectProyeccion) selectProyeccion.value = proyeccion;

    const inputCalificacion = document.getElementById('calificacion_input');
    if(inputCalificacion) inputCalificacion.value = calificacion;

    // Invoca la actualización visual de estrellas
    if(typeof window.pintarEstrellas === 'function') {
        window.pintarEstrellas(calificacion);
    }

    // Cambia los textos informativos para avisar que está editando
    const tituloForm = document.getElementById('form_title');
    if(tituloForm) tituloForm.innerText = "Modificar Tu Reseña";

    const botonSubmit = document.querySelector('#resena_form button[type="submit"]');
    if(botonSubmit) {
        botonSubmit.innerText = "Guardar Cambios";
        botonSubmit.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        botonSubmit.classList.add('bg-amber-600', 'hover:bg-amber-700'); // Color ámbar de edición
    }

    window.scrollTo({ top: document.getElementById('resena_form').offsetTop - 40, behavior: 'smooth' });
}
    </script>
</body>
</html>
