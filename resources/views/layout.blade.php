<!DOCTYPE html>
<html>

<head>
  <title>Bincom Election Test</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="/">Bincom Test</a>
      <div class="navbar-nav">
        <a class="nav-link" href="/polling-unit/8">Polling Unit</a>
        <a class="nav-link" href="/lga-result">LGA Result</a>
        <a class="nav-link" href="/add-result">Add Result</a>
      </div>
    </div>
  </nav>
  <div class="container">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
  </div>
  <footer class="bg-light text-center text-muted py-3 mt-5 border-top">
    <div class="container">
      <small>
        Developed by <strong>Aloydeachieve</strong> —
        <a href="https://github.com/Aloydeachieve" target="_blank" class="text-decoration-none text-primary">
          GitHub
        </a>
        |
        {{ now()->format('Y') }}
      </small>
      <br>
      <small>Laravel Developer | Bincom ICT Interview Project</small>
    </div>
  </footer>

  <!-- Optional SweetAlert2 for global use -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('scripts')
</body>

</html>