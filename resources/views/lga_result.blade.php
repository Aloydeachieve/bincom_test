@extends('layout')

@section('content')
<h3>Summed Results by LGA</h3>
<form method="GET" class="mb-3">
    <div class="input-group">
        <select name="lga_id" class="form-select">
            <option value="">Select LGA</option>
            @foreach($lgas as $lga)
                <option value="{{ $lga->lga_id }}" {{ request('lga_id') == $lga->lga_id ? 'selected' : '' }}>
                    {{ $lga->lga_name }}
                </option>
            @endforeach
        </select>
        <button class="btn btn-primary">View</button>
    </div>
</form>

@if(count($results))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Party</th>
            <th>Total Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $res)
            <tr>
                <td>{{ $res->party_abbreviation }}</td>
                <td>{{ $res->total_score }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
