@php
if(!isset($company)) {
$company = new \App\Models\Company();
}
@endphp

<div class="col-md-6">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" value="{{ old('name') ?? $company->name }}" id="name" name="name">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="name">E-mail</label>
        <input type="text" class="form-control" value="{{ old('email') ?? $company->email }}" id="email" name="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="name">Phone</label>
        <input type="text" class="form-control" value="{{ old('phone') ?? $company->phone }}" id="phone" name="phone">
        @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="name">Price</label>
        <input type="text" class="form-control" value="{{ old('price') ?? $company->price }}" id="price" name="price">
        @error('price')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="name">Expire Date</label>
        <input type="date" class="form-control" value="{{ old('expire_at') ?? $company->expire_at }}" id="expire_at" name="expire_at">
        @error('expire_at')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="name">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="1" @if($company->status == 1) {{ 'selected' }} @endif
                >Active</option>
            <option value="0" @if($company->status == 0) {{ 'selected' }} @endif
                >Inactive</option>
        </select>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="name">About</label>
        <textarea name="about" id="about" class="form-control" cols="30" rows="10">{{ nl2br($company->about) }}</textarea>
        @error('about')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>