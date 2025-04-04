<div class="card">
    <div class="card-head mt-1 d-flex justify-content-between">
        <h5 class="ms-2">Items de Cotización</h5>
        @if (!$cotizacion->fecha_reso_llamado)
            <a class="btn-plus me-2" wire:click="$set('modalItem', true)" title="Agregar Ítem">
                <i class="fa-solid fa-plus"></i>
            </a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Descripción</th>
                        <th scope="col">Unidad</th>
                        <th scope="col" class="text-center">Cantidad</th>
                        <th scope="col" class="text-center">...</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="text-wrap">
                                {{ $item->descripcion }}
                            </td>
                            <td class="text-center">
                                {{ $item->unidad }}
                            </td>
                            <td class="text-center">
                                {{ $item->cantidad }}
                            </td>
                            <td class="text-center">
                                <a class="text-primary" style="cursor: pointer;"
                                    wire:click="delete_item({{ $item->id }})" title="Eliminar Item">
                                    <i class="fa-solid fa-circle-xmark"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @if ($modalItem)
        <div>
            <div class="modal-backdrop show"></div>
            <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cargar Item</h5>
                            <button type="button" class="btn-close" wire:click="closeModal"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-12">
                                <label for="" class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion"
                                    aria-describedby="helpId" placeholder="Descripcion" wire:model="descripcion" />
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Unid.</label>
                                <input type="text" class="form-control" name="unidad" id="unidad"
                                    aria-describedby="helpId" placeholder="" wire:model="unidad" />
                            </div>

                            <div class="col-6">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad"
                                    aria-describedby="helpId" placeholder="Cantidad" wire:model="cantidad" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm"
                                wire:click="closeModal">Cerrar</button>
                            <button type="button" class="btn btn-primary btn-sm"
                                wire:click="ItemCreate">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
