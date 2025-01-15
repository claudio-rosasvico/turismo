<div>
    <div class="mx-3">
        <div class="mb-3">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" placeholder="Buscar Partida" aria-label="searchPartida"
                    aria-describedby="basic-addon1" name="searchPartida" id="searchPartida"
                    wire:model.live="searchPartida">
            </div>
        </div>
        @desktop
            <div class="card partidas-PC">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Código</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Descripción</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Pg</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Act</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Crédito</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Reservado</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Disponible</th>
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
                                        <p class="text-xs text-secondary mb-0">
                                            {{ '$' . number_format($partida->DISPONIBLE, 2, ',', '.') }}
                                        </p>
                                    </td>
                                    @if ($partida->info_partida != null)
                                        <td class="text-end">
                                            <a class="text-xs text-secondary mb-0 cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#modal-default"
                                                wire:click="showInfoPartida('{{ $partida->CODIGO }}')"><i
                                                    class="fa-solid fa-circle-info"></i></a>
                                            <div wire:ignore class="modal fade {{ $modalShow ? ' show' : '' }}"
                                                id="modal-default" tabindex="-1" role="dialog"
                                                aria-labelledby="modal-default"
                                                {{ $modalShow ? 'aria-modal="true" style="display: block;"' : 'aria-hidden="true"' }}>
                                                <div class="modal-dialog modal- modal-dialog-centered modal-"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="modal-title-default">
                                                                {{ $partida->CODIGO }} /
                                                                {{ $partida->info_partida->titulo }}</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-wrap text-start">
                                                            <p>{{ $partida->info_partida->descripcion }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success  ml-auto"
                                                                data-bs-dismiss="modal">Aceptar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
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
                </div>
            </div>
        @elsedesktop
            <div class="partidas-movil">
                @foreach ($partidas as $partida)
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="cardpartida">
                                <div class="cardpartida-header bg-success text-star pt-4 pb-3">
                                    <h1 class="font-weight-bold mt-2 text-center">
                                        <small>{{ $partida->CODIGO }}</small>
                                    </h1>
                                    <span class="text-dark text-wrap" style="white-space: normal; word-break: break-word;">
                                        {{ $partida->DESCRIPCION }}
                                    </span>
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
                                            <li class=""><i class="fa-solid fa-circle-info"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @enddesktop
    </div>
</div>
