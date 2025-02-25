<div class="col col-lg-6 mb-3">
    <input type="hidden" name="cotizacion_id" value="{{ $cotizacion_id }}">
    <div class="row">
        <div class="col-6">
            <label for="proveedor_ganador_id" class="form-label">Proveedores Participantes</label>
            <select class="form-select form-select" name="" id="" wire:change="addProveedorParticipante({{ $proveedor->id }})">
                <option selected>Selecciona un proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            @if ($proveedores_participantes)
                @foreach ($proveedores_participantes as $proveedor_participante)
                    {{ $proveedor_participante->nombre }}
                @endforeach
            @endif
        </div>
    </div>
</div>
