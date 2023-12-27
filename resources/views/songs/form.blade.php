
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Title</label>
    <div class="col-md-10">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($song)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('album') ? 'has-error' : '' }}">
    <label for="album" class="col-md-2 control-label">Album</label>
    <div class="col-md-10">
        <input class="form-control" name="album" type="text" id="album" value="{{ old('album', optional($song)->album) }}" minlength="1" placeholder="Enter album here...">
        {!! $errors->first('album', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('singer_id') ? 'has-error' : '' }}">
    <label for="singer_id" class="col-md-2 control-label">Singer</label>
    <div class="col-md-10">
        <select class="form-control" id="singer_id" name="singer_id">
        	    <option value="" style="display: none;" {{ old('singer_id', optional($song)->singer_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select singer</option>
        	@foreach ($singers as $key => $singer)
			    <option value="{{ $key }}" {{ old('singer_id', optional($song)->singer_id) == $key ? 'selected' : '' }}>
			    	{{ $singer }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('singer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('release_year') ? 'has-error' : '' }}">
    <label for="release_year" class="col-md-2 control-label">Release Year</label>
    <div class="col-md-10">
        <input class="form-control" name="release_year" type="text" id="release_year" value="{{ old('release_year', optional($song)->release_year) }}" minlength="1" placeholder="Enter release year here...">
        {!! $errors->first('release_year', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('song_category_id') ? 'has-error' : '' }}">
    <label for="song_category_id" class="col-md-2 control-label">Song Category</label>
    <div class="col-md-10">
        <select class="form-control" id="song_category_id" name="song_category_id">
        	    <option value="" style="display: none;" {{ old('song_category_id', optional($song)->song_category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select song category</option>
        	@foreach ($songCategories as $key => $songCategory)
			    <option value="{{ $key }}" {{ old('song_category_id', optional($song)->song_category_id) == $key ? 'selected' : '' }}>
			    	{{ $songCategory }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('song_category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
    <label for="file" class="col-md-2 control-label">File</label>
    <div class="col-md-10">
        <div class="input-group uploaded-file-group">
            <label class="input-group-btn">
                <span class="btn btn-default">
                    Browse <input type="file" name="file" id="file" class="hidden">
                </span>
            </label>
            <input type="text" class="form-control uploaded-file-name" readonly>
        </div>

        @if (isset($song->file) && !empty($song->file))
            <div class="input-group input-width-input">
                <span class="input-group-addon">
                    <input type="checkbox" name="custom_delete_file" class="custom-delete-file" value="1" {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}> Delete
                </span>

                <span class="input-group-addon custom-delete-file-name">
                    {{ $song->file }}
                </span>
            </div>
        @endif
        {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
    </div>
</div>

