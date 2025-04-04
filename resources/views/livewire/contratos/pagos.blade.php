<div class="card">
    <div class="card-header">
        <div class="row align-items-end">
            <div class="col-5">
                <h4>Pagos</h4>
            </div>
            <div class="col-5 text-start">
                @if ($total_OC - $total_pagos > 0)
                <p ><span class="badge bg-success">Saldo: {{ '$' . number_format($total_OC - $total_pagos, 2, ',', '.') }} </span></p>
                @else    
                <p><span class="badge bg-danger">Saldo: {{ '$' . number_format($total_OC - $total_pagos, 2, ',', '.') }} </span></p>
                @endif
            </div>
            <div class="col-auto ms-auto">
                <a class="btn-plus" wire:click="$set('modalPago', true)" title="Agregar Ítem">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th wire:click="sortBy('monto')" style="cursor: pointer;"
                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                            Monto

                        </th>
                        <th wire:click="sortBy('fecha_imputacion')" style="cursor: pointer;"
                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                            Fecha Imputación

                        </th>
                        <th wire:click="sortBy('nro_OP')" style="cursor: pointer;"
                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                            OP

                        </th>
                        <th wire:click="sortBy('nro_solicitud')" style="cursor: pointer;"
                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                            Solicitud Nº

                        </th>
                        <th wire:click="sortBy('pagado')" style="cursor: pointer;"
                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                            Pago

                        </th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                        <tr wire:key="{{ $pago->id }}">
                            <td class="text-center">
                                <p class="text-xs text-secondary mb-0 text-wrap">
                                    {{ '$ ' . number_format($pago->monto, 2, ',', '.') }}</p>
                            </td>
                            <td class="text-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $pago->fecha_imputacion ? date('d-m-Y', strtotime($pago->fecha_imputacion)) : '' }}
                                </p>
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
                            <td>
                                <a class=" me-1" style="cursor: pointer;" wire:click="editPago({{ $pago->id }})">
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
    
    @if ($modalPago)
            <div>
                <div class="modal-backdrop show"></div>
                <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                    aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                    <div class="modal-dialog pagos modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pagos</h5>
                                <button type="button" class="btn-close" wire:click="closeModal"></button>
                            </div>
                            <div class="modal-body">

                                <form wire:submit="pagoCreate">
                                    <div class="col-12">
                                        <div class="row">
                                            <label for="" class="form-label">Proveedor</label>
                                            <div class="col">
                                                {{ $contrato->proveedor->nombre }}
                                                <input type="hidden" name="proveedor_id" id="proveedor_id"
                                                    wire:model="proveedor_id">
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
                                        <div class="row mt-2">
                                            <div class="col col-lg-3">
                                                <label for="" class="form-label">Fecha Comprob.</label>
                                                <input type="date" class="form-control" name="fecha_comprobante"
                                                    id="fecha_comprobante" wire:model="fecha_comprobante" />
                                            </div>
                                            <div class="col col-lg-3">
                                                <label for="" class="form-label">Monto</label>
                                                <input type="text" class="form-control" name="monto"
                                                    id="monto" wire:model="monto" />
                                            </div>
                                            <div class="col col-lg-3">
                                                <label for="" class="form-label">Partida</label>
                                                <input type="text" class="form-control" name="partida_codigo"
                                                    id="partida_codigo" wire:model="partida_codigo" />
                                            </div>
                                            <div class="col col-lg-3">
                                                <label for="" class="form-label">Fecha Imput.</label>
                                                <input type="date" class="form-control" name="fecha_imputacion"
                                                    id="fecha_imputacion" wire:model="fecha_imputacion" />
                                            </div>
                                                <input type="hidden" name="tipo_pago_id"
                                                    id="tipo_pago_id" value="{{ $tipo_pago_id }}">
                                        </div>
                                        <div class="row  mt-2">
                                            <div class="col col-lg-4">
                                                <label for="" class="form-label">Nro. OP</label>
                                                <input type="text" class="form-control" name="nro_OP"
                                                    id="nro_OP" wire:model="nro_OP" />
                                            </div>
                                            <div class="col col-lg-4">
                                                <label for="" class="form-label">Expte. SIAF</label>
                                                <input type="text" class="form-control" name="nro_expte_siaf"
                                                    id="nro_expte_siaf" wire:model="nro_expte_siaf" />
                                            </div>
                                            <div class="col col-lg-4">
                                                <label for="" class="form-label">Nro. Solicitud</label>
                                                <input type="text" class="form-control" name="nro_solicitud"
                                                    id="nro_solicitud" wire:model="nro_solicitud" />
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
                                            wire:click="$set('modalPago', false)">Cerrar</button>
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
</div>