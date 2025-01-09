<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Grant Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">RGMS</a>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('academicians.index') }}">Academicians</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('grants.index') }}">Grants</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('milestones.index') }}">Milestones</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
