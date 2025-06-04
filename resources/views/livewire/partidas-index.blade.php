<div>
    <div class="mx-3">
        <div class="mb-3">
            <p>Ultima Carga:
                {{ $partidas->count() > 0 ? date('d-m-Y', strtotime($partidas->first()->created_at)) : '' }}</p>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control custom-padding" placeholder="Buscar Partida"
                    aria-label="searchPartida" aria-describedby="basic-addon1" name="searchPartida" id="searchPartida"
                    wire:model.live.debounce.300ms="searchPartida">

                    
            </div>
        </div>
        @desktop
            <div class="card partidas-PC">
                <div class="table-responsive" wire:loading.remove>
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" wire:click="sortBy('CODIGO')" style="cursor: pointer" >
                                    Código
                                    @if ($sortField === 'CODIGO')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Descripción</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Pg</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Act</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" wire:click="sortBy('CREDITO_ACTUAL')" style="cursor: pointer">
                                    Crédito
                                    @if ($sortField === 'CREDITO_ACTUAL')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"  wire:click="sortBy('RESERVADO')" style="cursor: pointer">
                                    Reservado
                                    @if ($sortField === 'RESERVADO')
                                    @if ($sortDirection === 'asc')
                                        <i class="fas fa-arrow-up"></i>
                                    @else
                                        <i class="fas fa-arrow-down"></i>
                                    @endif
                                @endif
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"  wire:click="sortBy('DISPONIBLE')" style="cursor: pointer">
                                    Disponible
                                    @if ($sortField === 'DISPONIBLE')
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
                            @foreach ($partidas as $partida)
                                <tr wire:key="{{ $partida->id }}">
                                    <td>
                                        <h6 class="mb-0 text-xs">{{ $partida->CODIGO }}</h6>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0 text-wrap">{{ $partida->DESCRIPCION }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $partida->PG }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs text-secondary mb-0">{{ $partida->AC }}</p>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-xs text-secondary mb-0">
                                            {{ '$' . number_format($partida->CREDITO_ACTUAL, 2, ',', '.') }}
                                        </p>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-xs text-secondary mb-0">
                                            {{ '$' . number_format($partida->RESERVADO, 2, ',', '.') }}
                                        </p>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ '$' . number_format($partida->DISPONIBLE, 2, ',', '.') }}
                                        </p>
                                    </td>
                                    <td class="text-end">
                                        <a class="text-xs text-secondary mb-0 cursor-pointer mr-2" data-bs-toggle="modal"
                                            data-bs-target="#modal-default"
                                            wire:click="showInfoPartida('{{ $partida->CODIGO }}')"><i
                                                class="fa-solid fa-circle-info"></i></a>
                                        @foreach ($partida->modificacion as $modificacion)
                                            @if ($modificacion->accion && $modificacion->activo)
                                                <span class="ms-2 cursor-pointer"
                                                    wire:click="showModificacionPartida({{ $modificacion->id }})"><i
                                                        class="fa-solid fa-up-long text-info"></i></span>
                                            @elseif(!$modificacion->accion && $modificacion->activo)
                                                <span class="ms-2 cursor-pointer"
                                                    wire:click="showModificacionPartida({{ $modificacion->id }})"><i
                                                        class="fa-solid fa-down-long text-danger"></i></span>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            @if ($partidas->isEmpty())
                                <tr>
                                    <td colspan="8">
                                        <div class="text-center">
                                            <p class="text-xs text-secondary mb-0">No se encontraron partidas</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="container mt-4">
                        {{ $partidas->links() }}
                    </div>
                </div>
                <div class="container text-center mt-3">
                    <div wire:loading wire:target="searchPartida" class="spinner-border text-success text-center" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            </div>
        @elsedesktop
            <div class="partidas-movil">
                @foreach ($partidas as $partida)
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="cardpartida">
                                <div class="cardpartida-header bg-success text-star pt-4 pb-3">
                                    <div>
                                        <h1 class="font-weight-bold mt-2 text-center">
                                            <small>{{ $partida->CODIGO }}</small>
                                        </h1>
                                        <span class="text-dark text-wrap"
                                            style="white-space: normal; word-break: break-word;">
                                            {{ $partida->DESCRIPCION }}
                                        </span>
                                    </div>
                                </div>
                                <div class="cardpartida-body text-lg-left text-start pt-0">
                                    <div class="d-flex justify-content-lg-start pt-2">
                                        <ul>
                                            <li class="">Prog.: {{ $partida->PG }} / Activ.: {{ $partida->AC }}
                                            </li>
                                            <li class="">Crédito:
                                                {{ '$ ' . number_format($partida->CREDITO_ACTUAL, 2, ',', '.') }}</li>
                                            <li class="">Reservado:
                                                {{ '$ ' . number_format($partida->RESERVADO, 2, ',', '.') }}</li>
                                            <li class="">Disponible:
                                                {{ '$ ' . number_format($partida->DISPONIBLE, 2, ',', '.') }}</li>
                                        </ul>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <p class="cursor-pointer text-center"
                                            wire:click="showInfoPartida('{{ $partida->CODIGO }}')">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </p>
                                        @foreach ($partida->modificacion as $modificacion)
                                            @if ($modificacion->accion)
                                                <span class="ms-3 cursor-pointer"
                                                    wire:click="showModificacionPartida({{ $modificacion->id }})"><i
                                                        class="fa-solid fa-up-long text-info"></i></span>
                                            @else
                                                <span class="ms-3 cursor-pointer"
                                                    wire:click="showModificacionPartida({{ $modificacion->id }})"><i
                                                        class="fa-solid fa-up-long text-danger"></i></span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @enddesktop
        @if ($modalShow)
            <div>
                <div class="modal-backdrop show"></div>
                <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                    aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-default">
                                    {{ $codigoModal }} /
                                    {{ $tituloModal }}</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body text-wrap text-start">
                                <p>{{ $infoModal }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success  ml-auto" data-bs-dismiss="modal"
                                    wire:click="$set('modalShow', false)">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($modalModificacion)
            <div>
                <div class="modal-backdrop show"></div>
                <div class="modal fade show" id="modal-default" tabindex="-1" role="dialog"
                    aria-labelledby="modal-default" aria-modal="true" style="display: block;">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6>Monto: {{ '$ ' . number_format($monto_modificacion, 2, ',', '.') }}</h6>
                                <span class="ms-auto" style="cursor:pointer"
                                    wire:click="$set('modalModificacion', false)">
                                    <strong>X</strong>
                                </span>
                            </div>
                            <div class="modal-body text-wrap text-start">
                                <p><strong>Fecha:</strong> {{ date('d-m-Y', strtotime($fecha_modificacion)) }}</p>
                                <p><strong>Descripción:</strong> {{ $descripcion_modificacion }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<script>
    document.getElementById('searchPartida').focus();
</script>
