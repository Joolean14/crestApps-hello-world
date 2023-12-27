
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($singer)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
    <label for="gender" class="col-md-2 control-label">Gender</label>
    <div class="col-md-10">
        <select class="form-control" id="gender" name="gender">
        	    <option value="" style="display: none;" {{ old('gender', optional($singer)->gender ?: '') == '' ? 'selected' : '' }} disabled selected>Select gender</option>
        	@foreach (['male' => 'Male',
'female' => 'Female'] as $key => $text)
			    <option value="{{ $key }}" {{ old('gender', optional($singer)->gender) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('music_type') ? 'has-error' : '' }}">
    <label for="music_type" class="col-md-2 control-label">Music Type</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="music_type_country">
            	<input id="music_type_country" class="required" name="music_type[]" type="checkbox" value="country" {{ in_array('country', old('music_type', optional($singer)->music_type) ?: []) ? 'checked' : '' }}>
                Country
            </label>
        </div>
        <div class="checkbox">
            <label for="music_type_pop">
            	<input id="music_type_pop" class="required" name="music_type[]" type="checkbox" value="pop" {{ in_array('pop', old('music_type', optional($singer)->music_type) ?: []) ? 'checked' : '' }}>
                Pop
            </label>
        </div>
        <div class="checkbox">
            <label for="music_type_rock">
            	<input id="music_type_rock" class="required" name="music_type[]" type="checkbox" value="rock" {{ in_array('rock', old('music_type', optional($singer)->music_type) ?: []) ? 'checked' : '' }}>
                Rock
            </label>
        </div>
        <div class="checkbox">
            <label for="music_type_jazz">
            	<input id="music_type_jazz" class="required" name="music_type[]" type="checkbox" value="jazz" {{ in_array('jazz', old('music_type', optional($singer)->music_type) ?: []) ? 'checked' : '' }}>
                Jazz
            </label>
        </div>
        <div class="checkbox">
            <label for="music_type_rap">
            	<input id="music_type_rap" class="required" name="music_type[]" type="checkbox" value="rap" {{ in_array('rap', old('music_type', optional($singer)->music_type) ?: []) ? 'checked' : '' }}>
                Rap
            </label>
        </div>

        {!! $errors->first('music_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_retired') ? 'has-error' : '' }}">
    <label for="is_retired" class="col-md-2 control-label">Is Retired</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_retired_1">
            	<input id="is_retired_1" class="" name="is_retired" type="checkbox" value="1" {{ old('is_retired', optional($singer)->is_retired) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_retired', '<p class="help-block">:message</p>') !!}
    </div>
</div>

