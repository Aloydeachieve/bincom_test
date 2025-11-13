@extends('layout')

@if ($lastSubmission)
<div class="alert alert-info mt-3">
    <strong>Last Submission:</strong> 
    Entered by <b>{{ $lastSubmission->entered_by_user }}</b> 
    on <b>{{ \Carbon\Carbon::parse($lastSubmission->date_entered)->format('d M Y, h:i A') }}</b>
</div>
@endif

@section('content')
<h3>Polling Unit: {{ $pollingUnit->polling_unit_name }}</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Party</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pollingUnit->results as $res)
            <tr>
                <td>{{ $res->party_abbreviation }}</td>
                <td>{{ $res->party_score }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
