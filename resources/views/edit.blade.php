<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
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
        .navbar-collapse {
            justify-content: flex-end;
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
                    <a href="/form" class="nav-link">Ajouter Navette</a>
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

<div class="container mt-4">
    <h1 class="text-center my-4">Modifier la Navette</h1>
    <form action="{{ route('update', $voyage->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Ville de Départ</label>
            <input type="text" name="departure_city" class="form-control" value="{{ $voyage->departure_city }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ville d'Arrivée</label>
            <input type="text" name="arrival_city" class="form-control" value="{{ $voyage->arrival_city }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Heure de Départ</label>
            <input type="datetime-local" name="departure_time" class="form-control" value="{{ $voyage->departure_time }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Heure d'Arrivée</label>
            <input type="datetime-local" name="arrival_time" class="form-control" value="{{ $voyage->arrival_time }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description du Bus</label>
            <textarea name="bus_description" class="form-control">{{ $voyage->bus_description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</body>
</html>