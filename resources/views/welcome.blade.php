<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Navette Express</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/images/imageBus2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .navbar {
            background-color: #004085;
            /* Dark blue color */
        }

        .navbar-brand {
            color: #fff;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd700;
            /* Gold color for hover effect */
        }

        .content {
            text-align: center;
            color: #fff;
            margin-top: 100px;
            /* Adjusted for more spacing */
        }

        .btn-primary {
            background-color: #004085;
            /* Matching navbar color */
            border-color: #004085;
        }

        .btn-primary:hover {
            background-color: #003366;
            border-color: #003366;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Navette Express</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="{{ route('company') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link"
                                style="border: none; background: none; color: #fff;">company</button>
                        </form>
                    </li>
                    <!-- Display Logout if the user is logged in -->
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

    <!-- Content Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Liste des Offres de Navettes</h2>
        <div class="row">
            @foreach($voyages as $voyage)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $voyage->departure_city }} - {{ $voyage->arrival_city }}</h5>
                            <p class="card-text"><strong>Heure de Départ:</strong> {{ $voyage->departure_time }}</p>
                            <p class="card-text"><strong>Heure d'Arrivée:</strong> {{ $voyage->arrival_time }}</p>
                            <p class="fw-bold {{ $voyage->status == 'valid' ? 'text-success' : 'text-danger' }}">
                                {{ ucfirst($voyage->status) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>