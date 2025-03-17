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
                                <i class="fa-regular fa-calendar"></i> Apertura
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Precio Final</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Estado</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Imprimir</th>
                            <th class="text-secondary opacity-7">...</th>
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

                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $cotizacion->fecha_llamado ? date('d-m-Y', strtotime($cotizacion->fecha_llamado)) : '' }}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ '$' . number_format($cotizacion->precio_total, 2, ',', '.') }}</p>
                                </td>
                                <td>
                                    @if ($cotizacion->fecha_OP || (isset($cotizacion->contrato) && !$cotizacion->contrato->activo))
                                        <span class="badge bg-success">Finalizado</span>
                                    @elseif ($cotizacion->fecha_reso_adjudicacion)
                                        <span class="badge bg-info">Adjudicado</span>
                                    @else
                                        <span class="badge bg-secondary">En proceso</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="me-2" style="cursor: pointer;"
                                        wire:click="generarAnexo({{ $cotizacion->id }})" title="Imprimir Pliego">
                                        <i class="fa-solid fa-file"></i></a>
                                    @if (!$cotizacion->fecha_reso_adjudicacion)
                                        <a class="me-2" style="cursor: pointer;"
                                            wire:click="showModal({{ $cotizacion->id }})" title="Cargar Proveedores">
                                            <i class="fa-solid fa-truck-arrow-right"></i></a>
                                        @if ($cotizacion->proveedores->count() > 2 && $cotizacion->items->count() > 0)
                                            <a class="me-2" style="cursor: pointer;"
                                                wire:click="generarRecibidos({{ $cotizacion->id }})"
                                                title="Imprimir Recibidos">
                                                <i class="fa-solid fa-clipboard-check"></i></a>
                                            <a class="me-2" style="cursor: pointer;" wire:click="generarSobres({{ $cotizacion->id }})"
                                                title="Imprimir Sobres">
                                                <i class="fa-solid fa-envelope"></i></a>
                                            <a class="me-2" style="cursor: pointer;"
                                                wire:click="showModalOfertas({{ $cotizacion->id }})"
                                                title="Cargar Ofertas">
                                                <i class="fa-solid fa-envelope-open"></i></a>
                                        @endif
                                    @elseif(($cotizacion->fecha_reso_adjudicacion && !$cotizacion->contrato) || !$cotizacion->activo)
                                        <a class="me-2" style="cursor: pointer;"
                                            wire:click="showModalContrato({{ $cotizacion->id }})"
                                            title="Registrar contrato">
                                            <i class="fa-solid fa-file-signature"></i></a>
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
                                    <a href="/cotizaciones/show/{{ $cotizacion->id }}" class="text-success"
                                        style="cursor: pointer;" title="Ver Cotización">
                                        <i class="fa-regular fa-eye"></i></a>
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
                                    <ul
                                        class="list-group list-group-flush border border-secondary border-opacity-25 rounded">
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
                                <button type="button" class="btn btn-primary"
                                    wire:click="closeModal">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if ($modalShowContrato)
        <div>
            <div class="modal-backdrop show"></div>
            <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Cargar Contrato</h5>
                            <span class="ms-auto" style="cursor:pointer" wire:click="closeModal">
                                <strong>X</strong>
                            </span>
                        </div>
                        <div class="modal-body text-wrap text-start">
                            <form action="/contratos/store" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre"
                                            aria-describedby="helpId" placeholder=""
                                            value="{{ $cotizacion_contrato->nombre }}" />
                                    </div>
                                    <div class="col col-lg-4">
                                        <label for="expediente" class="form-label">Expediente</label>
                                        <input type="text" class="form-control" name="expediente" id="expediente"
                                            aria-describedby="helpId" placeholder=""
                                            value="{{ $cotizacion_contrato->expediente }}" />
                                    </div>
                                    <div class="col col-lg-4">
                                        <label for="nro_resolucion" class="form-label">Resolución</label>
                                        <input type="text" class="form-control" name="nro_resolucion"
                                            id="nro_resolucion" aria-describedby="helpId"
                                            placeholder="Nº Resolución" />
                                    </div>
                                    <div class="col col-lg-4">
                                        <label for="nombre" class="form-label">Proveedor</label>
                                        <select class="form-select form-select" name="proveedor_id"
                                            id="proveedor_id">
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}"
                                                    {{ $proveedor->id == $cotizacion_contrato->proveedor_ganador_id ? 'selected' : '' }}>
                                                    {{ $proveedor->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col col-lg-6">
                                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                        <input type="date" class="form-control" name="fecha_inicio"
                                            id="fecha_inicio" aria-describedby="helpId" placeholder="" />
                                    </div>
                                    <div class="col col-lg-6">
                                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin"
                                            aria-describedby="helpId" placeholder="" />
                                    </div>
                                    <div class="col col-lg-6">
                                        <label for="monto_total" class="form-label">Monto Total</label>
                                        <input type="number" class="form-control" name="monto_total"
                                            id="monto_total" aria-describedby="helpId" placeholder="" />
                                    </div>
                                    <div class="col col-lg-6">
                                        <label for="monto_mensual" class="form-label">Monto Mensual</label>
                                        <input type="number" class="form-control" name="monto_mensual"
                                            id="monto_mensual" aria-describedby="helpId" placeholder="" />
                                    </div>
                                    <div class="col-12">
                                        <label for="observacion" class="form-label">Observación</label>
                                        <textarea type="number" class="form-control" name="observacion" id="observacion" aria-describedby="helpId"
                                            placeholder=""></textarea>
                                    </div>

                                    <input type="hidden" name="cotizacion_id" id="cotizacion_id"
                                        value="{{ $cotizacion_contrato->id }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        wire:click="closeModal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($modalShowOfertas)
        <div>
            <div class="modal-backdrop show"></div>
            <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cargar Ofertas</h5>
                            <button type="button" class="btn-close" wire:click="closeModal"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Proveedor seleccionados -->
                            <div class="col-12 mt-4">
                                <h6>Proveedores Invitados</h6>
                                @foreach ($proveedores_cotizacion as $proveedor_cotizacion)
                                    <div class="row"
                                        wire:key="proveedor_cotizacion{{ $proveedor_cotizacion->id }}">
                                        <div class="col-12">
                                            <button type="button"
                                                class="btn {{ $proveedor_cotizacion->proveedor_id == $proveedorBotonId ? 'btn-info ' : 'btn-primary btn-sm' }}  w-100"
                                                wire:click="selectProveedorOfertas({{ $proveedor_cotizacion->proveedor_id }})">
                                                {{ $proveedor_cotizacion->proveedor->nombre }}
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                @if ($showInputOfertas && $ofertas_proveedor->count() > 0)
                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Cant.</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col"><i class="fa-solid fa-dollar-sign"></i>
                                                        Unit.
                                                    </th>
                                                    <th scope="col"><i class="fa-solid fa-dollar-sign"></i>
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ofertas_proveedor as $oferta)
                                                    <tr class="" wire:key="oferta{{ $oferta->id }}">
                                                        <td scope="row">{{ $oferta->item->cantidad }}</td>
                                                        <td>{{ $oferta->item->descripcion }}</td>
                                                        <td><input type="text" class="form-control"
                                                                name="precio_unitario" id="precio_unitario"
                                                                aria-describedby="helpId"
                                                                value="{{ $oferta->precio_unitario }}"
                                                                wire:change="updateOferta({{ $oferta->id }}, 'precio_unitario', $event.target.value)" />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                name="precio_total" id="precio_total"
                                                                aria-describedby="helpId"
                                                                value="{{ $oferta->precio_total }}"
                                                                wire:change="updateOferta({{ $oferta->id }}, 'precio_total', $event.target.value)" />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-end">
                                                        <p>TOTAL</p>
                                                    </td>
                                                    <td class="text-end">
                                                        {{ '$' . number_format($ofertas_proveedor->sum('precio_total'), 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <hr>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                            <button type="button" class="btn btn-primary" wire:click="closeModal">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

</div>
