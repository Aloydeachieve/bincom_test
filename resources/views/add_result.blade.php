@extends('layout')

@section('content')
<h3 class="mb-4">Add New Polling Unit Result</h3>

<form method="POST" action="/add-result" id="addResultForm">
    @csrf

    <!-- CHAINED DROPDOWNS -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label>State</label>
            <select id="state" class="form-select" required>
                <option value="">Select State</option>
                @foreach(\DB::table('states')->get() as $state)
                    <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>LGA</label>
            <select id="lga" class="form-select" required></select>
        </div>
        <div class="col-md-3">
            <label>Ward</label>
            <select id="ward" class="form-select" required></select>
        </div>
        <div class="col-md-3">
            <label>Polling Unit</label>
            <select name="polling_unit_uniqueid" id="polling_unit" class="form-select" required></select>
        </div>
    </div>

    <!-- PARTY RESULTS -->
    <div id="results-container">
        <div class="row mb-2">
            <div class="col">
                <input type="text" name="results[0][party_abbreviation]" placeholder="Party" class="form-control" required>
            </div>
            <div class="col">
                <input type="number" name="results[0][party_score]" placeholder="Score" class="form-control" required>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="addRow">+ Add Party</button>

    <!-- USER INFO -->
    <div class="mb-3">
        <label>Entered By User</label>
        <input type="text" name="entered_by_user" class="form-control" required>
    </div>

    <button class="btn btn-success w-100">Submit Results</button>
</form>
@endsection


@push('scripts')
<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let count = 1;

// ADD PARTY ROWS
document.getElementById('addRow').addEventListener('click', () => {
    const container = document.getElementById('results-container');
    const row = document.createElement('div');
    row.classList.add('row', 'mb-2');
    row.innerHTML = `
        <div class="col">
            <input type="text" name="results[${count}][party_abbreviation]" placeholder="Party" class="form-control" required>
        </div>
        <div class="col">
            <input type="number" name="results[${count}][party_score]" placeholder="Score" class="form-control" required>
        </div>
    `;
    container.appendChild(row);
    count++;
});

// CHAINED DROPDOWN AJAX
document.getElementById('state').addEventListener('change', function () {
    fetch(`/get-lgas/${this.value}`)
        .then(res => res.json())
        .then(data => {
            let options = '<option value="">Select LGA</option>';
            data.forEach(lga => options += `<option value="${lga.lga_id}">${lga.lga_name}</option>`);
            document.getElementById('lga').innerHTML = options;
            document.getElementById('ward').innerHTML = '';
            document.getElementById('polling_unit').innerHTML = '';
        });
});

document.getElementById('lga').addEventListener('change', function () {
    fetch(`/get-wards/${this.value}`)
        .then(res => res.json())
        .then(data => {
            let options = '<option value="">Select Ward</option>';
            data.forEach(ward => options += `<option value="${ward.ward_id}">${ward.ward_name}</option>`);
            document.getElementById('ward').innerHTML = options;
            document.getElementById('polling_unit').innerHTML = '';
        });
});

document.getElementById('ward').addEventListener('change', function () {
    fetch(`/get-polling-units/${this.value}`)
        .then(res => res.json())
        .then(data => {
            let options = '<option value="">Select Polling Unit</option>';
            data.forEach(pu => options += `<option value="${pu.uniqueid}">${pu.polling_unit_name ?? 'PU #' + pu.polling_unit_id}</option>`);
            document.getElementById('polling_unit').innerHTML = options;
        });
});

// SWEETALERT FEEDBACK
@if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Result Saved!',
        html: `{{ session('success') }}<br><br>
               <a href="{{ url('/polling-unit/' . old('polling_unit_uniqueid')) }}" class="btn btn-primary btn-sm mt-2">
               View Newly Added Result</a>
               <a href="{{ url('/add-result') }}" class="btn btn-outline-secondary btn-sm mt-2">
               + Add Another Result</a>`,
        showConfirmButton: false,
        allowOutsideClick: true,
        background: '#fefefe',
    });
@endif

@if (session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error Saving Result',
        text: '{{ session('error') }}',
        confirmButtonText: 'Try Again',
    });
@endif
</script>
@endpush
