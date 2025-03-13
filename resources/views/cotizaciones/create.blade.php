<x-layouts.app>
    <x-slot name="title">
        Crear Cotización
    </x-slot>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">
                                    {{ isset($cotizacion) ? 'Actualizar Cotización' : 'Crear Cotización' }}
                                </h4>
                            </div>
                            <div>
                                <a name="" id="" class="btn btn-primary"
                                    href="{{ route('cotizaciones.index') }}" role="button">
                                    Volver a la lista
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="cotizacionForm"
                                action="{{ isset($cotizacion) ? route('cotizaciones.update', $cotizacion->id) : route('cotizaciones.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($cotizacion))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <!-- Campo: Nombre -->
                                    <div class="col col-lg-6 mb-3">
                                        <label for="nombre" class="form-label">Nombre <span
                                                style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            required value="{{ isset($cotizacion) ? $cotizacion->nombre : '' }}">
                                    </div>

                                    <!-- Campo: Expediente -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="expediente" class="form-label">Expediente <span
                                                style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="expediente" name="expediente"
                                            required value="{{ isset($cotizacion) ? $cotizacion->expediente : '' }}">
                                    </div>


                                    <!-- Campo: Precio Estimado -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="precio_estimado" class="form-label">Precio Estimado <span
                                                style="color: red">*</span></label>
                                        <input type="number" class="form-control" id="precio_estimado"
                                            name="precio_estimado" step="0.01" required
                                            value="{{ isset($cotizacion) ? $cotizacion->precio_estimado : '' }}">
                                    </div>

                                    <!-- Campo: Fecha de Autorización -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_autorizacion" class="form-label"><i
                                                class="fa-regular fa-calendar"></i> Autorización SG</label>
                                        <input type="date" class="form-control" id="fecha_autorizacion"
                                            name="fecha_autorizacion"
                                            value="{{ isset($cotizacion) ? $cotizacion->fecha_autorizacion : '' }}">
                                    </div>

                                    <!-- Campo: Fecha de Resolución Llamado -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_reso_llamado" class="form-label"><i
                                                class="fa-regular fa-calendar"></i> Resolución
                                            Llamado</label>
                                        <input type="date" class="form-control" id="fecha_reso_llamado"
                                            name="fecha_reso_llamado"
                                            value="{{ isset($cotizacion) ? $cotizacion->fecha_reso_llamado : '' }}">
                                    </div>

                                    <!-- Campo: Numero -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numero" name="numero"
                                            value="{{ isset($cotizacion) ? $cotizacion->numero : '' }}">
                                    </div>
                                    <!-- Campo: Fecha de Llamado -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_llamado" class="form-label"><i
                                                class="fa-regular fa-calendar"></i> Llamado</label>
                                        <input type="date" class="form-control" id="fecha_llamado"
                                            name="fecha_llamado"
                                            value="{{ isset($cotizacion) ? $cotizacion->fecha_llamado : '' }}">
                                    </div>

                                    <!-- Campo: Hora de Llamado -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="hora_llamado" class="form-label">Hora de Llamado</label>
                                        <input type="time" class="form-control" id="hora_llamado" name="hora_llamado"
                                            value="{{ isset($cotizacion) ? $cotizacion->hora_llamado : '' }}">
                                    </div>

                                    <!-- Campo: Fecha de Resolución Adjudicación -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_reso_adjudicacion" class="form-label"><i
                                                class="fa-regular fa-calendar"></i> Resolución
                                            Adjud.</label>
                                        <input type="date" class="form-control" id="fecha_reso_adjudicacion"
                                            name="fecha_reso_adjudicacion"
                                            value="{{ isset($cotizacion) ? $cotizacion->fecha_reso_adjudicacion : '' }}">
                                    </div>

                                    <!-- Campo: Numero de Reso-->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="nro_reso_adjudicacion" class="form-label">Número de Reso</label>
                                        <input type="text" class="form-control" id="nro_reso_adjudicacion"
                                            name="nro_reso_adjudicacion"
                                            value="{{ isset($cotizacion) ? $cotizacion->nro_reso_adjudicacion : '' }}">
                                    </div>

                                    <!-- Campo: Descripción -->
                                    <div class="col  mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="1"
                                            value="{{ isset($cotizacion) ? $cotizacion->descripcion : '' }}"></textarea>
                                    </div>
                                    <small style="font-size:0.6rem">(<span style="color: red">*</span>) campos
                                        obligatorios</small>
                                </div>

                                <!-- Botón de envío -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit"
                                        class="btn btn-primary">{{ isset($cotizacion) ? 'Actualizar Cotización' : 'Crear Cotización' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script defer> 
/*             document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('cotizacionForm');
                const inputs = Array.from(form.querySelectorAll('input, textarea'));
                console.log(inputs);
                inputs.forEach((input, index) => {
                    input.addEventListener('input', function() {
                        if (index > 0) {
                            const previousInput = inputs[index - 1];
                            if (!previousInput.value.trim()) {
                                toast('error', 'falta el anterior', 'error');
                                input.setCustomValidity(
                                    'Complete el campo anterior antes de continuar.');
                                input.reportValidity();
                            } else {
                                input.setCustomValidity('');
                            }
                        }
                    });

                    input.addEventListener('blur', function() {
                        if (index > 0) {
                            const previousInput = inputs[index - 1];
                            if (!previousInput.value.trim()) {
                                previousInput.classList.add('is-invalid');
                                toast('Error', `Complete ${previousInput['nombre']}`, 'error');
                            } else {
                                previousInput.classList.remove('is-invalid');
                            }
                        }
                    });
                }); 
            }); */
        </script>
    @endpush
</x-layouts.app>
