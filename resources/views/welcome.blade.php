<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Navette Express</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('imageBus2.jpg');
            background-size: cover;
            background-position: center;
        }
        .navbar {
            background-color: #004085; /* Dark blue color */
        }
        .navbar-brand {
            color: #fff;
        }
        .navbar-nav .nav-link {
            color: #fff;
        }
        .navbar-nav .nav-link:hover {
            color: #ffd700; /* Gold color for hover effect */
        }
        .content {
            text-align: center;
            color: #fff;
            margin-top: 100px; /* Adjusted for more spacing */
        }
        .btn-primary {
            background-color: #004085; /* Matching navbar color */
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                        <!-- Display Logout if the user is logged in -->
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="border: none; background: none; color: #fff;">Logout</button>
                            </form>
                        </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container content">
        <h1>Welcome to Navette Express</h1>
        <p>Your go-to shuttle service for a quick and safe ride.</p>

        <!-- Button to go to the shuttle booking page -->
        <a href="/book-shuttle" class="btn btn-primary">Book a Shuttle</a>

        <!-- Add more content if needed -->
        <p>Experience reliable and comfortable transportation. Start your journey now!</p>
    </div>

    <!-- Bootstrap JS and Popper.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
