@extends('layouts.main')

@section('content')

<div class="card">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Edit City ({{ $city->name }})</h5>
        <a href="{{ route('cities.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <form action="{{ route('cities.update', $city->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{ old('name') ?? $city->name }}" id="name" name="name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <label for="country_code">Country</label>
                        <select name="country_id" id="country_id" class="form-control">
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if($city->country_id == $country->id) {{ 'selected' }} @endif
                                >{{ $country->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <label for="state_id">State</label>
                        <select name="state_id" required id="state_id" class="form-control">
                            <option value="{{ $city->state->id }}">{{ $city->state->name }}</option>
                        </select>

                        @error('state_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <div class="col-12">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">
    let currentState = "{{ $city->state_id }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#country_id').on('change', function(e) {
            var country_id = e.target.value;
            $.ajax({
                url: "{{ route('get-states') }}",
                type: "POST",
                data: {
                    country: country_id
                },
                success: function(data) {
                    console.log(data);
                    $('#state_id').empty();
                    $.each(data.states, function(index, state) {
                        if (currentState == state.id)
                            $('#state_id').append('<option selected value="' + state.id + '">' + state.name + '</option>');
                        else
                            $('#state_id').append('<option value="' + state.id + '">' + state.name + '</option>');
                    })
                }
            })
        });
    });
</script>
@endsection
