<div class="row mb-3">
    <div class="col-12">
        <label for="descripcion">Descripción del producto o servicio</label>
        <textarea id="descripcion" name="descripcion">{!! $descripcion !!}</textarea>
        @error('descripcion')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
            </span>
        @enderror
    </div>
</div>