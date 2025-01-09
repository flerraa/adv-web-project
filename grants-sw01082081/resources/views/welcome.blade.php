<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Grant Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Welcome to the Research Grant Management System</h1>
        <p class="text-center lead">Manage Academicians, Research Grants, and Project Milestones with ease.</p>

        <div class="row mt-5">
            <!-- Academicians -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Academicians</h5>
                        <p class="card-text">Manage academician profiles including their details and positions.</p>
                        <a href="{{ route('academicians.index') }}" class="btn btn-primary">Manage Academicians</a>
                    </div>
                </div>
            </div>

            <!-- Grants -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Research Grants</h5>
                        <p class="card-text">Manage research grants, assign project leaders, and track budgets.</p>
                        <a href="{{ route('grants.index') }}" class="btn btn-success">Manage Grants</a>
                    </div>
                </div>
            </div>

            <!-- Milestones -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Milestones</h5>
                        <p class="card-text">Track project milestones, set deadlines, and monitor progress.</p>
                        <a href="{{ route('milestones.index') }}" class="btn btn-warning">Manage Milestones</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
