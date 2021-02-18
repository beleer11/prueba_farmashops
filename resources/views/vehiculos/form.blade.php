@if($modo == 'crear')
    <div class="mb-2"><h4>{{ $modo == 'crear' ? 'Agregar vehículo' : 'Modificar vehículo' }}</h4></div>
    <div class="col-md-12 mb-2" style="margin:0 auto">
        <div class="form-group">
            <label class="control-label" for="Marca">{{'Marca'}} *</label>
            <input class="col-md-12 form-control" type="text" name="marca" id="marca" 
                value="" required/>
        </div>
        <div class="form-group">
            <label for="Modelo">{{'Modelo'}} *</label>
            <input class="col-md-12 form-control" type="text" name="modelo" id="modelo" 
                value="" required/>
        </div>
        <div class="form-group">
            <label for="Color">{{'Color'}} *</label>    
            <input class="col-md-12 form-control" type="text" name="color" id="color" 
                value="" required/>
        </div>
        <div class="form-group">
            <label for="Descripcion">{{'Descripcion'}} *</label>    
            <textarea class="col-md-12 form-control" type="text" name="descripcion" id="descripcion" 
                value="" required></textarea>
        </div>
        </select>
        <div class="form-group">
            <label for="Asesor">{{'Asesor'}} *</label>
            <select id="asesor" name="asesor" class="form-control" required>
                <option value="">------Seleccionar------</option>
                @for ($i = 0; $i < count($select); $i++)
                    <option value="{{ $select[$i]->id }}">{{ $select[$i]->first_name . ' ' . $select[$i]->last_name }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="float-right">
        <input class="btn btn-success" type="submit" value="Guardar">
        <a class="btn btn-danger" href="{{ url('vehiculos') }}">Atras</a>
    </div>
@else
    <div class="mb-2"><h4>{{ $modo == 'crear' ? 'Agregar vehículo' : 'Modificar vehículo' }}</h4></div>
    <div class="col-md-12 mb-2" style="margin:0 auto">
        <div class="form-group">
        <label class="control-label" for="Marca">{{'Marca'}} *</label>
            <input class="col-md-12 form-control" type="text" name="marca" id="marca" 
                value="{{ isset($datos->marca) ? $datos->marca : '' }}" required/>
        </div>
        <div class="form-group">
        <label for="Modelo">{{'Modelo'}} *</label>
            <input class="col-md-12 form-control" type="text" name="modelo" id="modelo" 
                value="{{ isset($datos->modelo) ? $datos->modelo : '' }}" required/>
        </div>
        <div class="form-group">
        <label for="Color">{{'Color'}} *</label>    
            <input class="col-md-12 form-control" type="text" name="color" id="color" 
                value="{{ isset($datos->color) ? $datos->color : '' }}" required/>
        </div>
        <div class="form-group">
        <label for="Descripcion">{{'Descripcion'}} *</label>    
            <input class="col-md-12 form-control" type="text" name="descripcion" id="descripcion" 
                value="{{ isset($datos->descripcion) ? $datos->descripcion : '' }}" required/>
        </div>
        </select>
        <div class="form-group">
        <label for="Asesor">{{'Asesor'}} *</label>
            <select id="asesor" name="asesor" class="form-control" required>
                <option value="">------Seleccionar------</option>
                @for ($j = 0; $j < count($select); $j++)
                    <option value="{{ $select[$j]->id }}" @if($datos->asesor_id == $select[$j]->id) selected='selected' @endif>{{ $select[$j]->first_name . " ". $select[$j]->last_name}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="float-right">
        <input class="btn btn-success" type="submit" value="Guardar">
        <a class="btn btn-danger" href="{{ url('vehiculos') }}">Atras</a>
    </div>
@endif
