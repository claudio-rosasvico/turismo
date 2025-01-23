<x-layouts.app>
    <x-slot name="title">
        Partidas
    </x-slot>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">Ver Partidas</h4>
                            </div>
                            {{-- <div>
                                <form action="{{ route('importar_partida_CURL') }}" method="post">
                                    @csrf
                                    <button type="submit" name="" id="" class="btn btn-primary"
                                        role="button">Cargar Excel CURL</button>
                                </form>
                            </div> --}}
                            <div>
                                <a name="" id="" class="btn btn-primary"
                                    href="{{ route('Cargar Partidas') }}" role="button">Cargar Partidas</a>
                            </div>
                        </div>
                        <div.card-body>
                            @livewire('index-partidas')
                        </div.card-body>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
