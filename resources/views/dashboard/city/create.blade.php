@extends('layouts.main')

@section('content')

<div class="card">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Create City</h5>
        <a href="{{ route('cities.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <form action="{{ route('cities.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <label for="country_code">Country</label>
                        <select name="country_id" id="country_id" class="form-control">
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>

                        @error('country_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                        <label for="state_id">State</label>
                        <select name="state_id" required id="state_id" class="form-control">
                            <option value="">Selecionar</option>
                        </select>

                        @error('stated_id')
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
                        $('#state_id').append('<option value="' + state.id + '">' + state.name + '</option>');
                    })
                }
            })
        });
    });
</script>
@endsection
