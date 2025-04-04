<div class="card">
    <div class="card-head mt-1 d-flex justify-content-between">
        <h5 class="ms-2">Órdenes de Compra</h5>
        @if ($cotizacion->fecha_reso_adjudicacion)        
            <a class="btn-plus me-2" wire:click="$set('modalOrdenCompra', true)" title="Agregar OC">
                <i class="fa-solid fa-plus" ></i>
            </a>
        @endif
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Número</th>
                        <th scope="col" class="text-center">Proveedor</th>
                        <th scope="col" class="text-center">Expt. SIAF</th>
                        <th scope="col" class="text-center">Monto</th>
                        <th scope="col" class="text-center">...</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordenes_compras as $orden_compra)
                        <tr>
                            <td class="text-wrap">
                                {{ $orden_compra->numero }}
                            </td>
                            <td class="text-wrap">
                                {{ $orden_compra->proveedor->nombre }}
                            </td>
                            <td class="text-center">
                                {{ $orden_compra->expediente_siaf }}
                            </td>
                            <td class="text-center">
                                {{ ' $' . number_format($orden_compra->precio_total, 2, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <a class="text-primary" style="cursor: pointer;"
                                    wire:click="delete_orden_compra({{ $orden_compra->id }})"
                                    title="Eliminar cotización">
                                    <i class="fa-solid fa-circle-xmark"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @if ($modalOrdenCompra)
        <div>
            <div class="modal-backdrop show"></div>
            <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cargar Orden de Compra</h5>
                            <button type="button" class="btn-close" wire:click="closeModal"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-4">
                                <label for="" class="form-label">Número OC</label>
                                <input type="number" class="form-control" name="numero" id="numero"
                                    aria-describedby="helpId" placeholder="Nº OC" wire:model="numero" />
                            </div>
                            <div class="col-4">
                                <label for="expediente_siaf" class="form-label">Expte. SIAF</label>
                                <input type="text" class="form-control" name="expediente_siaf" id="expediente_siaf"
                                    aria-describedby="helpId" placeholder="Expte. SIAF" wire:model="expediente_siaf" />
                            </div>
                            <div class="col-4">
                                <label for="precio_total" class="form-label">Precio Total</label>
                                <input type="text" class="form-control" name="precio_total" id="precio_total"
                                    aria-describedby="helpId" placeholder="Precio" wire:model="precio_total" />
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Proveedor</label>
                                <select class="form-select form-select-lg" name="proveedor_id" id="proveedor_id" wire:model="proveedor_id">
                                    <option selected>Seleccione Proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->proveedor->id }}">{{ $proveedor->proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm"
                                wire:click="closeModal">Cerrar</button>
                            <button type="button" class="btn btn-primary btn-sm"
                                wire:click="OrdenCompraCreate">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif {{-- FALTA SELECCIONAR PROVEEDOR EN OC --}}
</div>
