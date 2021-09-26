@php
$isNew = false;
if(!isset($user)) {
$user = new \App\Models\User();
$isNew = true;
}
@endphp

<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

    <div class="col-md-6">
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username ?? old('username') }}" required autocomplete="username" autofocus>

        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

    <div class="col-md-6">
        <input id="first_name" type="text" class="form-control @error('first_name')
                                is-invalid @enderror" name="first_name" value="{{ $user->first_name ?? old('first_name') }}" required autocomplete="first_name" autofocus>

        @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

    <div class="col-md-6">
        <input id="last_name" type="text" class="form-control @error('last_name')
        is-invalid @enderror" name="last_name" value="{{ $user->last_name ?? old('last_name') }}" required autocomplete="last_name" autofocus>

        @error('last_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{  $user->email ?? old('email') }}" required autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@if(!$isNew)
<div class="alert alert-success">
    Change Password (Opcional)
</div>
@endif
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" @if($isNew) {{ 'required' }} @endif autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

@if(!$isNew)

<div class="form-group row">
    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

    <div class="col-md-6">
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
    </div>

    @error('password_confirmation')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@endif
