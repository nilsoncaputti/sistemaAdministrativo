<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($produto->nome) ? $produto->nome : ''}}" required>
    {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('descicao') ? 'has-error' : ''}}">
    <label for="descicao" class="control-label">{{ 'Descicao' }}</label>
    <textarea class="form-control" rows="5" name="descicao" type="textarea" id="descicao" >{{ isset($produto->descicao) ? $produto->descicao : ''}}</textarea>
    {!! $errors->first('descicao', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
