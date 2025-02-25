<div>
    <div class="mx-3">
        <div class="mb-3">
            <div class="row align-items-between">
                <div class="col-12 col-lg-9">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control custom-padding" placeholder="Buscar Proveedor"
                            aria-label="searchProveedor" aria-describedby="basic-addon1" name="searchProveedor"
                            id="searchProveedor" wire:model.live="searchProveedor"
                            style="padding-left: 35px !important;">
                    </div>
                </div>
                <div class="col-12 col-lg-3 text-end">
                    <button type="button" class="btn btn-success" wire:click="showModal">
                        Cargar Proveedor
                    </button>

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
                                CUIT</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Teléfono</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Email</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Domicilio</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Venc. LD</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Observación</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                            @if ($proveedor->estado)
                                <tr wire:key="{{ $proveedor->id }}">
                                    <td>
                                        <h6 class="mb-0 text-xs">{{ $proveedor->nombre }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0 text-wrap">{{ $proveedor->CUIT }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $proveedor->telefono }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $proveedor->email }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $proveedor->domicilio }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $proveedor->venc_libre_deuda }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $proveedor->observaciones }}</p>
                                    </td>
                                    <td>
                                        <a class="" style="cursor: pointer;"
                                            wire:click="showModal({{ $proveedor->id }})">
                                            <i class="fa-regular fa-pen-to-square"></i></a>
                                        <a class="text-primary" style="cursor: pointer;"
                                            wire:click="deactivateproveedor({{ $proveedor->id }})">
                                            <i class="fa-solid fa-circle-xmark"></i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        @if ($proveedores->isEmpty())
                            <tr>
                                <td colspan="8">
                                    <div class="text-center">
                                        <p class="text-xs text-secondary mb-0">No se encontraron proveedores</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if ($modalShow)
            <div>
                <div class="modal-backdrop show"></div>
                <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                    aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-default">{{ $proveedor_id ? 'Actualizar Proveedor':'Cargar Proveedor' }}</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body text-wrap text-start">
                                <form action="" wire:submit="proveedorCreate">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre"
                                                    aria-describedby="helpId" placeholder="Nombre"
                                                    wire:model="nombre" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">CUIT</label>
                                                <input type="number" class="form-control" name="CUIT" id="CUIT"
                                                    aria-describedby="helpId" placeholder="CUIT" wire:model="CUIT" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Teléfono</label>
                                                <input type="number" class="form-control" name="telefono"
                                                    id="telefono" aria-describedby="helpId" placeholder="Teléfono"
                                                    wire:model="telefono" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    id="email" aria-describedby="helpId" wire:model="email"
                                                    placeholder="Email" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Domicilio</label>
                                                <input type="text" class="form-control" name="domicilio"
                                                    id="domicilio" aria-describedby="helpId" placeholder="Domicilio"
                                                    wire:model="domicilio" />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Vencimiento LD-ATER</label>
                                                <input type="date" class="form-control" name="venc_libre_deuda"
                                                    id="venc_libre_deuda" aria-describedby="helpId"
                                                    wire:model="venc_libre_deuda" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Descripción</label>
                                                <textarea class="form-control" name="observaciones" id="observaciones" rows="2" wire:model="observaciones"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-sm ml-auto"
                                            data-bs-dismiss="modal"
                                            wire:click="$set('modalShow', false)">Cancelar</button>
                                        <button type="submit" class="btn btn-success btn-sm ml-auto"
                                            data-bs-dismiss="modal">{{ $proveedor_id ? 'Actualizar':'Cargar' }} </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
