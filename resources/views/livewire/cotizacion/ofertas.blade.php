<div>
    <div class="table-responsive-sm">
        <table class="table fs-7">
            <thead>
                <tr>
                    <th class="text-uppercase" scope="col">Items</th>
                    <th class="text-uppercase" scope="col">Cantidad</th>
                    @foreach ($cotizacion->proveedores as $proveedor)
                        <th class="text-wrap text-center" scope="col">{{ $proveedor->nombre }}</th>
                    @endforeach
                    <th class="text-uppercase" scope="col">
                        Precio Unitario
                    </th>
                    <th class="text-uppercase" scope="col">
                        Precio Total
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cotizacion->items as $item)
                    <tr class="">
                        <td class="text-wrap text-secondary " scope="row">{{ $item->descripcion }}</td>
                        <td class="text-center">{{ $item->cantidad }}</td>
                        @foreach ($cotizacion->proveedores as $proveedor)
                            <td class="text-center align-content-center">
                                <div class="text-center">
                                    <input type="number"
                                        class="form-control input-sm text-center text-md {{ $oferta_seleccionada[$item->id]->proveedor_id == $proveedor->id ? 'bg-warning' : '' }}"
                                        name="" id="" aria-describedby="helpId"
                                        wire:model="{{ $ofertas[$item->id][$proveedor->id]->precio_unitario }}"
                                        value="{{ $ofertas[$item->id][$proveedor->id]->precio_unitario }}"
                                        wire:change="updateOferta({{ $item->id }} , {{ $proveedor->id }}, $event.target.value)" />
                                </div>
                                <div class="form-check text-center align-justify-center">
                                    <input class="form-check-input text-center" type="radio" value="" name="item{{ $item->id }}"
                                        id="" {{ $oferta_seleccionada[$item->id]->proveedor_id == $proveedor->id ? 'checked' : '' }} wire:click="selectOferta({{ $item->id }} , {{ $proveedor->id }})"/>
                            </td>
                        @endforeach
                        <td class="text-center align-content-center">
                            @if (!empty($oferta_seleccionada[$item->id]))
                                
                                    {{ '$' . number_format($oferta_seleccionada[$item->id]->precio_unitario, 2, ',', '.') }}
                                
                            @endif
                        </td>
                        <td class="text-center align-content-center">
                            
                                {{ '$' . number_format($oferta_seleccionada[$item->id]->precio_unitario * $item->cantidad, 2, ',', '.') }}
                            
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    @foreach ($cotizacion->proveedores as $proveedor)
                        <td></td>
                    @endforeach
                    <td class="text-end"><p><strong> TOTAL</strong></p></td>
                    <td>
                        <p class="text-center">
                            <strong>{{ '$' . number_format($precio_total, 2, ',', '.') }}</strong>
                        </p>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>

</div>
