{{-- IMÁGENES PERSONALIZADAS IA --}}

@if($paciente->imagen_personalizada)

    @php

        $imagenes = $paciente->imagen_personalizada;

    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">

        @foreach($imagenes as $img)

            <div class="bg-white rounded-2xl shadow p-2">

                <img
                    src="{{ asset($img) }}"
                    class="w-full h-40 object-contain rounded-xl"
                >

            </div>

        @endforeach

    </div>

@endif