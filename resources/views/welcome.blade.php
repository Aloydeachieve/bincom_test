@extends('layout')

@section('content')
<div class="text-center mt-5">
    <h1 class="fw-bold mb-3 animate__animated animate__fadeInDown">🗳️ INEC Results Dashboard</h1>
    <p class="text-muted mb-4 animate__animated animate__fadeInUp">View, Summarize, and Add Polling Unit Results</p>

    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="{{ url('/polling-unit/8') }}" class="btn btn-outline-primary btn-lg animate__animated animate__zoomIn">View Polling Unit</a>
        <a href="{{ url('/lga-result') }}" class="btn btn-outline-success btn-lg animate__animated animate__zoomIn">LGA Total Results</a>
        <a href="{{ url('/add-result') }}" class="btn btn-outline-warning btn-lg animate__animated animate__zoomIn">Add New Result</a>
    </div>
</div>

<!-- Simple CSS animation using Animate.css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
