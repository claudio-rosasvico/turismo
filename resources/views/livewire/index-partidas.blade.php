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
        <div class="card">
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
                            <tr>
                                <td>
                                    <h6 class="mb-0 text-xs">{{ $partida->CODIGO }}</h6>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">{{ $partida->DESCRIPCION }}</p>
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
    </div>
</div>
