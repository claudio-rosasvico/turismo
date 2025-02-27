<div>
    <div class="mx-3">
        <div class="mb-3">
            <div class="row align-items-between">
                <div class="col-12 col-lg-9">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control custom-padding" placeholder="Buscar Pago"
                            aria-label="searchPago" aria-describedby="basic-addon1" name="searchPago" id="searchPago"
                            wire:model.live="searchPago" style="padding-left: 35px !important;">
                    </div>
                </div>
                <div class="col-12 col-lg-3 text-end">
                    <button type="button" class="btn btn-success" wire:click="$set('modalShow', true)">
                        Cargar Pago
                    </button>

                </div>
            </div>
        </div>
        <div class="card partidas-PC">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th wire:click="sortBy('proveedor_id')" style="cursor: pointer;"
                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                Proveedor
                                @if ($sortField === 'proveedor_id')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                            </th>
                            <th wire:click="sortBy('monto')" style="cursor: pointer;"
                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Monto
                                @if ($sortField === 'monto')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                            </th>
                            <th wire:click="sortBy('fecha_imputacion')" style="cursor: pointer;"
                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Fecha Imputación
                                @if ($sortField === 'fecha_imputacion')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                            </th>
                            <th wire:click="sortBy('nro_OP')" style="cursor: pointer;"
                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                OP
                                @if ($sortField === 'nro_OP')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                            </th>
                            <th wire:click="sortBy('nro_solicitud')" style="cursor: pointer;"
                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Solicitud Nº
                                @if ($sortField === 'nro_solicitud')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                            </th>
                            <th wire:click="sortBy('pagado')" style="cursor: pointer;"
                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Pago
                                @if ($sortField === 'pagado')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Modalidad
                                @if ($sortField === 'tipo_pago_id')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                            </th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr wire:key="{{ $pago->id }}">
                                <td>
                                    <h6 class="mb-0 text-xs">{{ $pago->proveedor->nombre }}</h6>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs text-secondary mb-0 text-wrap">
                                        {{ '$ ' . number_format($pago->monto, 2, ',', '.') }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ date('d-m-Y', strtotime($pago->fecha_imputacion)) }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $pago->nro_OP }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs text-secondary mb-0">{{ $pago->nro_solicitud }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="mb-0 badge  {{ $pago->pagado ? 'bg-success' : 'bg-warning' }}">
                                        {{ $pago->pagado ? 'Pagado' : 'En proceso' }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $pago->tipo_pago->nombre }}</p>
                                </td>
                                <td>
                                    <a class=" me-1" style="cursor: pointer;"
                                        wire:click="editPago({{ $pago->id }})">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="text-primary me-1" style="cursor: pointer;"
                                        wire:click="deletePago({{ $pago->id }})">
                                        <i class="fa-solid fa-trash"></i></a>
                                    @if ($pago->pagado)
                                        <a class="text-danger me-1" style="cursor: pointer;"
                                            wire:click="cancelarPago({{ $pago->id }})" title="Cancelar Pago">
                                            <i class="fa-solid fa-square-xmark"></i></a>
                                    @else
                                        <a class="text-success me-1" style="cursor: pointer;"
                                            wire:click="confirmarPago({{ $pago->id }})" title="Confirmar Pago">
                                            <i class="fa-solid fa-square-check"></i></a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        {{--                         @if ($pagos->isEmpty())
                            <tr>
                                <td colspan="8">
                                    <div class="text-center">
                                        <p class="text-xs text-secondary mb-0">No se encontraron pagos</p>
                                    </div>
                                </td>
                            </tr>
                        @endif --}}
                    </tbody>
                </table>
            </div>
        </div>
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
                                @if (!$proveedorSeleccionado)
                                    <!-- Listado de proveedores filtrados -->
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <ul
                                            class="list-group list-group-flush border border-secondary border-opacity-25 rounded">
                                            @foreach ($proveedoresFiltrados as $proveedor)
                                                <li class="list-group-item p-1 fs-6 fw-light lh-1"
                                                    wire:click="addProveedor({{ $proveedor->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $proveedor->nombre }} ({{ $proveedor->CUIT }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Form Pago -->
                                <form wire:submit="pagoCreate">
                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <label for="" class="form-label">Proveedor</label>
                                            <div class="col-10">
                                                {{ $proveedorSeleccionado ? $proveedorSeleccionado->nombre : 'No hay proveedor seleccionado' }}
                                                <input type="hidden" name="proveedor_id" id="proveedor_id"
                                                    wire:model="proveedor_id">
                                            </div>
                                            <div class="col-2">
                                                @if ($proveedorSeleccionado)
                                                    <a class="" style="cursor: pointer;"
                                                        wire:click="$set('proveedorSeleccionado', null)"
                                                        title="Eliminar">
                                                        <i class="fa-solid fa-circle-xmark"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-lg-4">
                                                <label for="" class="form-label">Expediente</label>
                                                <input type="text" class="form-control" name="expediente"
                                                    id="expediente" wire:model="expediente" />
                                            </div>
                                            <div class="col col-lg-4">
                                                <label for="" class="form-label">Sucursal</label>
                                                <input type="text" class="form-control" name="sucursal"
                                                    id="sucursal" wire:model="sucursal" />
                                            </div>
                                            <div class="col col-lg-4">
                                                <label for="" class="form-label">Nro. Comprobante</label>
                                                <input type="text" class="form-control" name="nro_comprobante"
                                                    id="nro_comprobante" wire:model="nro_comprobante" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-lg-4">
                                                <label for="" class="form-label">Fecha Comprob.</label>
                                                <input type="date" class="form-control" name="fecha_comprobante"
                                                    id="fecha_comprobante" wire:model="fecha_comprobante" />
                                            </div>
                                            <div class="col col-lg-4">
                                                <label for="" class="form-label">Monto</label>
                                                <input type="text" class="form-control" name="monto"
                                                    id="monto" wire:model="monto" />
                                            </div>
                                            <div class="col col-lg-4">
                                                <label for="" class="form-label">Partida</label>
                                                <input type="text" class="form-control" name="partida_codigo"
                                                    id="partida_codigo" wire:model="partida_codigo" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-lg-6">
                                                <label for="" class="form-label">Fecha Imput.</label>
                                                <input type="date" class="form-control" name="fecha_imputacion"
                                                    id="fecha_imputacion" wire:model="fecha_imputacion" />
                                            </div>
                                            <div class="col col-lg-6">
                                                <label for="" class="form-label">Tipo de Pago</label>
                                                <select class="form-select form-select" name="tipo_pago_id"
                                                    id="tipo_pago_id" wire:model="tipo_pago_id">
                                                    <option value="">Seleccione...</option>
                                                    @foreach ($tipos_pagos as $tipo_pago)
                                                        <option value="{{ $tipo_pago->id }}">{{ $tipo_pago->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-lg-6">
                                                <label for="" class="form-label">Nro. OP</label>
                                                <input type="text" class="form-control" name="nro_OP"
                                                    id="nro_OP" wire:model="nro_OP" />
                                            </div>
                                            <div class="col col-lg-6">
                                                <label for="" class="form-label">Expte. SIAF</label>
                                                <input type="text" class="form-control" name="nro_expte_siaf"
                                                    id="nro_expte_siaf" wire:model="nro_expte_siaf" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-lg-6">
                                                <label for="" class="form-label">Nro. Solicitud</label>
                                                <input type="text" class="form-control" name="nro_solicitud"
                                                    id="nro_solicitud" wire:model="nro_solicitud" />
                                            </div>
                                            <div class="col col-lg-6 align-content-center">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        wire:model="pagado" {{ $pagado ? 'checked' : '' }} />
                                                    <label for="" class="form-label">Pagado</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="observacion" class="form-label">Observación</label>
                                                    <textarea class="form-control" name="observacion" id="observacion" rows="2" wire:model="observacion"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            wire:click="closeModal">Cerrar</button>
                                        @if ($pago_id)
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        @else
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- @if ($modalShowInfo)
            <div>
                <div class="modal-backdrop show"></div>
                <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                    aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="ms-auto" style="cursor:pointer"
                                    wire:click="$set('modalShowInfo', false)">
                                    <strong>X</strong>
                                </span>
                            </div>
                            <div class="modal-body text-wrap text-start">
                                <p>{{ $modalInfoDescripcion }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}
    </div>
</div>
