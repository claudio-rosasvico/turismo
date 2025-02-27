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
                                <h4 class="card-title">{{ isset($cotizacion) ? 'Actualizar Cotización' : 'Crear Cotización' }}
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
                            <form
                                action="{{ isset($cotizacion) ? route('cotizaciones.update', $cotizacion->id) : route('cotizaciones.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($cotizacion))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <!-- Campo: Nombre -->
                                    <div class="col col-lg-4 mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            required value="{{ isset($cotizacion) ? $cotizacion->nombre : '' }}">
                                    </div>

                                    <!-- Campo: Expediente -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="expediente" class="form-label">Expediente</label>
                                        <input type="text" class="form-control" id="expediente" name="expediente"
                                            required value="{{ isset($cotizacion) ? $cotizacion->expediente : '' }}">
                                    </div>


                                    <!-- Campo: Precio Estimado -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="precio_estimado" class="form-label">Precio Estimado</label>
                                        <input type="number" class="form-control" id="precio_estimado"
                                            name="precio_estimado" step="0.01" required
                                            value="{{ isset($cotizacion) ? $cotizacion->precio_estimado : '' }}">
                                    </div>

                                    <!-- Campo: Fecha de Autorización -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_autorizacion" class="form-label">Fecha de Autorización</label>
                                        <input type="date" class="form-control" id="fecha_autorizacion"
                                            name="fecha_autorizacion"
                                            value="{{ isset($cotizacion) ? $cotizacion->fecha_autorizacion : '' }}">
                                    </div>

                                    <!-- Campo: Fecha de Contaduría Llamado -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_contaduria_llamado" class="form-label">Fecha de Contaduría
                                            Llamado</label>
                                        <input type="date" class="form-control" id="fecha_contaduria_llamado"
                                            name="fecha_contaduria_llamado"
                                            value="{{ isset($cotizacion) ? $cotizacion->fecha_contaduria_llamado : '' }}">
                                    </div>

                                    <!-- Campo: Fecha de Resolución Llamado -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_reso_llamado" class="form-label">Fecha de Resolución
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
                                        <label for="fecha_llamado" class="form-label">Fecha de Llamado</label>
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

                                    <!-- Campo: Fecha de Contaduría Adjudicación -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_contaduria_adjudicacion" class="form-label">Fecha de
                                            Contaduría Adjudicación</label>
                                        <input type="date" class="form-control" id="fecha_contaduria_adjudicacion"
                                            name="fecha_contaduria_adjudicacion"
                                            value="{{ isset($cotizacion) ? $cotizacion->fecha_contaduria_adjudicacion : '' }}">
                                    </div>

                                    <!-- Campo: Fecha de Resolución Adjudicación -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_reso_adjudicacion" class="form-label">Fecha de Resolución
                                            Adjudicación</label>
                                        <input type="date" class="form-control" id="fecha_reso_adjudicacion"
                                            name="fecha_reso_adjudicacion"
                                            value="{{ isset($cotizacion) ? $cotizacion->fecha_reso_adjudicacion : '' }}">
                                    </div>

                                    <!-- Campo: Proveedor Ganador ID -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="proveedor_ganador_id" class="form-label">Proveedor Ganador</label>
                                        <select class="form-select" name="proveedor_ganador_id" id="proveedor_ganador_id" >
                                            <option value="0" selected>Selecciona un proveedor</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}" {{ (isset($cotizacion) && $cotizacion->proveedor_ganador_id == $proveedor->id) ? 'selected' : '' }}>{{ $proveedor->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Campo: Precio Total -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="precio_total" class="form-label">Precio Total</label>
                                        <input type="number" class="form-control" id="precio_total"
                                            name="precio_total" step="0.01"
                                            value="{{ isset($cotizacion) ? $cotizacion->precio_total : '' }}">
                                    </div>

                                    <!-- Campo: Fecha de OC -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_OC" class="form-label">Fecha de OC</label>
                                        <input type="date" class="form-control" id="fecha_OC" name="fecha_OC"
                                            value="{{ isset($cotizacion) ? $cotizacion->nombre : '' }}">
                                    </div value="{{ isset($cotizacion) ? $cotizacion->fecha_OC : '' }}">

                                    <!-- Campo: Fecha de OP -->
                                    <div class="col col-lg-2 mb-3">
                                        <label for="fecha_OP" class="form-label">Fecha de OP</label>
                                        <input type="date" class="form-control" id="fecha_OP" name="fecha_OP"
                                            value="{{ isset($cotizacion) ? $cotizacion->fecha_OP : '' }}">
                                    </div>

                                    <!-- Campo: Descripción -->
                                    <div class="col col-lg-4 mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="1"
                                            value="{{ isset($cotizacion) ? $cotizacion->descripcion : '' }}"></textarea>
                                    </div>
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
    <script>
            $('#proveedor_ganador_id').select2({
                placeholder: 'Seleccione Proveedor',
                allowClear: true,
            });
    </script>
@endpush
</x-layouts.app>
