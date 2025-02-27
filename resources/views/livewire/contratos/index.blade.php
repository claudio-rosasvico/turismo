<div>
    <div class="mx-3">
        <div class="mb-3">
            <div class="row align-items-between">
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control custom-padding" placeholder="Buscar Contrato"
                            aria-label="updatedSearchContrato" aria-describedby="basic-addon1"
                            name="updatedSearchContrato" id="updatedSearchContrato" wire:model.live="searchContrato"
                            style="padding-left: 35px !important;">
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
                                Proveedor</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Fecha de Inicio</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Fecha de Fin</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Expediente</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Saldo de Reserva/s</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                ...</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contratos as $contrato)
                            <tr wire:key="{{ $contrato->id }}">
                                <td>
                                    <h6 class="mb-0 text-xs">{{ $contrato->nombre }}</h6>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs text-secondary mb-0 text-wrap">
                                        {{ $contrato->proveedor->nombre }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ date('d-m-Y', strtotime($contrato->fecha_inicio)) }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ date('d-m-Y', strtotime($contrato->fecha_fin)) }}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $contrato->expediente }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">Saldo de Reservas</p>
                                </td>
                                <td>
                                    <a class="" style="cursor: pointer;" title="Editar Contrato"
                                        wire:click="editContrato({{ $contrato->id }})">
                                        <i class="fa-regular fa-pen-to-square"></i></a>
                                    <a class="text-primary" style="cursor: pointer;"
                                        wire:click="delete_contrato({{ $contrato->id }})" title="Eliminar Contrato">
                                        <i class="fa-solid fa-circle-xmark"></i></a>
                                        <a href="/contratos/show/{{ $contrato->id }}" class="text-success" style="cursor: pointer;"
                                            title="Ver Contrato">
                                            <i class="fa-regular fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @if ($contratos->isEmpty())
                            <tr>
                                <td colspan="8">
                                    <div class="text-center">
                                        <p class="text-xs text-secondary mb-0">No se encontraron contratos</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if ($modalShowEdit)
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
                                <div class="row">
                                    <div class="col-12">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre"
                                            aria-describedby="helpId" placeholder="" value="{{ $nombre }}" wire:model="nombre" />
                                    </div>
                                    <div class="col col-lg-4">
                                        <label for="expediente" class="form-label">Expediente</label>
                                        <input type="text" class="form-control" name="expediente" id="expediente"
                                            aria-describedby="helpId" placeholder="" value="{{ $expediente }}" wire:model="expediente" />
                                    </div>
                                    <div class="col col-lg-4">
                                        <label for="nro_resolucion" class="form-label">Resolución</label>
                                        <input type="text" class="form-control" name="nro_resolucion"
                                            id="nro_resolucion" aria-describedby="helpId" placeholder=""
                                            value="{{ $nro_resolucion }}" wire:model="nro_resolucion" />
                                    </div>
                                    <div class="col col-lg-4">
                                        <label for="nombre" class="form-label">Proveedor</label>
                                        <select class="form-select form-select" name="proveedor_id"
                                            id="proveedor_id" wire:model="proveedor_id" >
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id }}"
                                                    {{ $proveedor->id == $proveedor_id ? 'selected' : '' }}>
                                                    {{ $proveedor->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col col-lg-6">
                                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                        <input type="date" class="form-control" name="fecha_inicio"
                                            id="fecha_inicio" aria-describedby="helpId" placeholder=""
                                            value="{{ $fecha_inicio }}" wire:model="fecha_inicio" />
                                    </div>
                                    <div class="col col-lg-6">
                                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin"
                                            aria-describedby="helpId" placeholder="" value="{{ $fecha_fin }}" wire:model="fecha_fin" />
                                    </div>
                                    <div class="col col-lg-6">
                                        <label for="monto_total" class="form-label">Monto Total</label>
                                        <input type="number" class="form-control" name="monto_total"
                                            id="monto_total" aria-describedby="helpId" placeholder=""
                                            value="{{ $monto_total }}" wire:model="monto_total" />
                                    </div>
                                    <div class="col col-lg-6">
                                        <label for="monto_mensual" class="form-label">Monto Mensual</label>
                                        <input type="number" class="form-control" name="monto_mensual"
                                            id="monto_mensual" aria-describedby="helpId" placeholder=""
                                            value="{{ $monto_mensual }}" wire:model="monto_mensual" />
                                    </div>
                                    <div class="col-12">
                                        <label for="observacion" class="form-label">Observación</label>
                                        <textarea type="number" class="form-control" name="observacion" id="observacion" aria-describedby="helpId"
                                            placeholder="" aria-valuemax="{{ $observacion }}" wire:model="observacion" ></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        wire:click="closeModal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" wire:click="contratoUpdate">Actualizar</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
