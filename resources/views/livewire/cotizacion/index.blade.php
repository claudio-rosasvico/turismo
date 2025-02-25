<div>
    <div class="mx-3">
        <div class="mb-3">
            <div class="row align-items-between">
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control custom-padding" placeholder="Buscar Cotización"
                            aria-label="updatedSearchCotizacion" aria-describedby="basic-addon1"
                            name="updatedSearchCotizacion" id="updatedSearchCotizacion"
                            wire:model.live="searchCotizacion" style="padding-left: 35px !important;">
                    </div>
                </div>
            </div>
        </div>
        <div class="card partidas-PC">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                Nombre</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Precio Estimado</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Fecha de Apertura</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Adjudicado</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Precio Final</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                OP</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Imprimir</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cotizaciones as $cotizacion)
                            <tr wire:key="{{ $cotizacion->id }}">
                                <td>
                                    <h6 class="mb-0 text-xs">{{ $cotizacion->nombre }}</h6>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs text-secondary mb-0 text-wrap">
                                        {{ '$' . number_format($cotizacion->precio_estimado, 2, ',', '.') }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $cotizacion->fecha_llamado }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $cotizacion->proveedor_ganador_id ? $cotizacion->proveedorGanador->nombre : '' }}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ '$' . number_format($cotizacion->precio_total, 2, ',', '.') }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $cotizacion->fecha_OP }}</p>
                                </td>
                                <td class="text-center">
                                    @if ($cotizacion->fecha_OP)
                                        <span class="badge bg-success">Finalizado</span>
                                    @elseif ($cotizacion->fecha_reso_adjudicacion)
                                        <span class="badge bg-info">Adjudicado</span>
                                    @else
                                        <a class="me-2" style="cursor: pointer;"
                                            wire:click="showModal({{ $cotizacion->id }})" title="Cargar Proveedores">
                                            <i class="fa-solid fa-user-plus"></i></a>
                                        <a class="me-2" style="cursor: pointer;"
                                            wire:click="generarRecibidos({{ $cotizacion->id }})"
                                            title="Imprimir Recibidos">
                                            <i class="fa-solid fa-clipboard-check"></i></a>
                                        <a class="me-2" style="cursor: pointer;"
                                            wire:click=""
                                            title="Imprimir Sobres">
                                            <i class="fa-solid fa-envelope"></i></a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('cotizaciones.edit', $cotizacion->id) }}" class=""
                                        style="cursor: pointer;" title="Editar Cotización">
                                        <i class="fa-regular fa-pen-to-square"></i></a>
                                    <a class="text-primary" style="cursor: pointer;"
                                        wire:click="delete_cotizacion({{ $cotizacion->id }})"
                                        title="Eliminar Cotización">
                                        <i class="fa-solid fa-circle-xmark"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @if ($cotizaciones->isEmpty())
                            <tr>
                                <td colspan="8">
                                    <div class="text-center">
                                        <p class="text-xs text-secondary mb-0">No se encontraron cotizaciones</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>

        <!-- Modal -->
        @if ($modalShow)
            <div>
                <div class="modal-backdrop show"></div>
                <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                    aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Seleccionar Proveedor</h5>
                                <button type="button" class="btn-close" wire:click="closeModal"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Input de búsqueda -->
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Buscar proveedor..."
                                        wire:model.live="busquedaProveedor">
                                </div>

                                <!-- Listado de proveedores filtrados -->
                                <div style="max-height: 300px; overflow-y: auto;">
                                    <ul class="list-group list-group-flush border border-secondary border-opacity-25 rounded">
                                        @foreach ($proveedoresFiltrados as $proveedor)
                                            <li class="list-group-item p-1 fs-6 fw-light lh-1"
                                                wire:click="addProveedor({{ $proveedor->id }})"
                                                style="cursor: pointer;">
                                                {{ $proveedor->nombre }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Proveedor seleccionados -->
                                <div class="col-12 mt-4">
                                    <h6>Proveedores Invitados</h6>
                                    @foreach ($proveedores_cotizacion as $proveedor_cotizacion)
                                        <div class="row">
                                            <div class="col-10">
                                                {{ $proveedor_cotizacion->proveedor->nombre }}
                                            </div>
                                            <div class="col-2">
                                                <a class="text-primary" style="cursor: pointer;"
                                                    wire:click="delete_proveedor_cotizacion({{ $proveedor_cotizacion->id }})"
                                                    title="Eliminar">
                                                    <i class="fa-solid fa-circle-xmark"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    wire:click="closeModal">Cerrar</button>
                                <button type="button" class="btn btn-primary" wire:click="closeModal">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- @if ($modalShow)
        <div>
            <div class="modal-backdrop show"></div>
            <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Cargar Proveedores</h5>
                            <span class="ms-auto" style="cursor:pointer" wire:click="closeModal">
                                <strong>X</strong>
                            </span>
                        </div>
                        <div class="modal-body text-wrap text-start">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="proveedores" class="form-label">Proveedores</label>
                                        <select class="form-select miSelect" name="proveedores" id="proveedores"
                                            wire:model="proveedor_seleccionado_id" wire:change="addProveedor">
                                            <option selected>Seleccione Proveedor</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}">
                                                    {{ $proveedor->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h6>Proveedores Invitados</h6>
                                    @foreach ($proveedores_cotizacion as $proveedor_cotizacion)
                                        <div class="row">
                                            <div class="col-10">
                                                {{ $proveedor_cotizacion->proveedor->nombre }}
                                            </div>
                                            <div class="col-2">
                                                <a class="text-primary" style="cursor: pointer;"
                                                    wire:click="delete_proveedor_cotizacion({{ $proveedor_cotizacion->id }})"
                                                    title="Eliminar">
                                                    <i class="fa-solid fa-circle-xmark"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}

</div>
