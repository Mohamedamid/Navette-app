<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="images/Logo.png">
    <title>Navette Express</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Fixed Navbar */
        .navbar {
            background-color: #343a40;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999;
        }

        /* Adjust content spacing so it's not hidden under the navbar */
        body {
            background-color: #f8f9fa;
            padding-top: 80px; /* Adjust the space according to the navbar height */
        }

        /* Styling the Navbar Brand */
        .navbar-brand {
            color: #fff !important;
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Styling the Nav Links */
        .navbar-nav .nav-item .nav-link {
            color: #fff !important;
            font-size: 1.1rem;
            padding-right: 15px;
        }

        /* Hover effect for the Nav Links */
        .navbar-nav .nav-item .nav-link:hover {
            color: #007bff !important;
        }

        /* Styling the Form */
        .container {
            max-width: 800px;
            margin-top: 30px;
        }

        h1 {
            font-size: 2.5rem;
            color: #343a40;
        }

        .form-control {
            border-radius: 0.375rem;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        textarea.form-control {
            min-height: 150px;
        }

        .btn {
            font-size: 1.1rem;
            border-radius: 0.375rem;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Add some margin-bottom to the form fields */
        .mb-3 {
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Navette Express</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link">Liste Navette</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link"
                            style="border: none; background: none; color: #fff;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-4">
    <h1 class="text-center my-4">Ajouter une Navette</h1>
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Ville de Départ</label>
            <input type="text" name="departure_city" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ville d'Arrivée</label>
            <input type="text" name="arrival_city" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Heure de Départ</label>
            <input type="datetime-local" name="departure_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Heure d'Arrivée</label>
            <input type="datetime-local" name="arrival_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description du Bus</label>
            <textarea name="bus_description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form> 
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
