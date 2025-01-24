<div>
    <div class="mx-3">
        <div class="mb-3">
            <div class="row align-items-between">
                <div class="col-12 col-lg-9">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control custom-padding" placeholder="Buscar Modificación"
                            aria-label="searchModificacion" aria-describedby="basic-addon1" name="searchModificacion"
                            id="searchModificacion" wire:model.live="searchModificacion"
                            style="padding-left: 35px !important;">
                    </div>
                </div>
                <div class="col-12 col-lg-3 text-end">
                    <button type="button" class="btn btn-success" wire:click="$set('modalShow', true)">
                        Cargar Modificación
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
                                Partida</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Pg.</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Act.</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Monto</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Acción</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Fecha Solicitud</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modificaciones as $modificacion)
                            @if ($modificacion->activo)
                                <tr wire:key="{{ $modificacion->id }}">
                                    <td>
                                        <h6 class="mb-0 text-xs">{{ $modificacion->partida }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0 text-wrap">{{ $modificacion->pg }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $modificacion->ac }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0">
                                            {{ '$ ' . number_format($modificacion->monto, 2, ',', '.') }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p
                                            class="mb-0 badge  {{ $modificacion->accion == 1 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $modificacion->accion ? 'Aumentar' : 'Disminuir' }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0">
                                            {{ date('d-m-Y', strtotime($modificacion->fecha_solicitud)) }}</p>
                                    </td>
                                    <td>
                                        <a class="" style="cursor: pointer;"
                                            wire:click="showInfo({{ $modificacion->id }})">
                                            <i class="fa-solid fa-circle-info"></i></a>
                                        <a class="text-primary" style="cursor: pointer;"
                                            wire:click="deactivateModificacion({{ $modificacion->id }})">
                                            <i class="fa-solid fa-circle-xmark"></i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        @if ($modificaciones->isEmpty())
                            <tr>
                                <td colspan="8">
                                    <div class="text-center">
                                        <p class="text-xs text-secondary mb-0">No se encontraron modificaciones
                                            preupuestarias</p>
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
                                <h6 class="modal-title" id="modal-title-default">Cargar Modificación</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body text-wrap text-start">
                                <form action="" wire:submit="modificacionCreate">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Programa</label>
                                                <input type="text" class="form-control" name="pg" id="pg"
                                                    aria-describedby="helpId" placeholder="Programa" wire:model="pg"/>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Actividad</label>
                                                <input type="text" class="form-control" name="ac" id="ac"
                                                    aria-describedby="helpId" placeholder="Actividad" wire:model="ac" />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Monto</label>
                                                <input type="number" class="form-control" name="monto"
                                                    id="monto" aria-describedby="helpId" placeholder="Monto"
                                                    wire:model="monto" />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Fecha</label>
                                                <input type="date" class="form-control" name="fecha_solicitud"
                                                    id="fecha_solicitud" aria-describedby="helpId"
                                                    wire:model="fecha_solicitud" />

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Acción</label>
                                                    <select class="form-select" name="accion" id="accion"
                                                        wire:model="accion">
                                                        <option selected>Selec. Acción</option>
                                                        <option value="1">Aumentar</option>
                                                        <option value="0">Disminuir</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Partida</label>
                                                    <input type="text" class="form-control" name="partida"
                                                        id="partida" aria-describedby="helpId"
                                                        placeholder="Partida" wire:model="partidaModal"
                                                        wire:keyup="disponiblePartida" />
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Disponible</label>

                                                    @if (is_numeric($disponibleModal))
                                                        <p>{{ '$ ' . number_format($disponibleModal, 2, ',', '.') }}
                                                        </p>
                                                    @else
                                                        <p>{{ $disponibleModal }}</p>
                                                    @endif

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Descripción</label>
                                                    <textarea class="form-control" name="descripcion" id="descripcion" rows="2" wire:model="descripcion"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-sm ml-auto"
                                            data-bs-dismiss="modal"
                                            wire:click="$set('modalShow', false)">Cancelar</button>
                                        <button type="submit" class="btn btn-success btn-sm ml-auto"
                                            data-bs-dismiss="modal">Cargar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
        @if ($modalShowInfo)
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
        @endif
    </div>
</div>
