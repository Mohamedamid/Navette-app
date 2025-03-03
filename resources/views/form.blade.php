<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Navette Express</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    body {
        background-image: url('/images/imageBus2.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .navbar {
        background-color: #004085;
    }

    .navbar-brand,
    .navbar-nav .nav-link {
        color: #fff;
    }

    .navbar-nav .nav-link:hover {
        color: #ffd700;
    }

    .container-box {
        max-width: 90%;
        margin-top: 50px;
    }

    .container-form {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #004085;
        border-color: #004085;
    }

    .btn-primary:hover {
        background-color: #003366;
        border-color: #003366;
    }
    .container{
        height:90vh !important;
    }
</style>

<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Navette Express</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/company" class="nav-link">Company</a>
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

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <form id="voyageForm" action="{{ route('store') }}" method="POST" class="container-form">
                @csrf

                <h4 class="mb-3 text-center">Ajouter une Navette</h4>

                <div class="mb-3">
                    <label class="form-label text-dark">Departure City</label>
                    <input type="text" id="departure_city" name="departure_city" class="form-control border-primary"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark">Arrival City</label>
                    <input type="text" id="arrival_city" name="arrival_city" class="form-control border-primary"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark">Departure Time</label>
                    <input type="datetime-local" id="departure_time" name="departure_time"
                        class="form-control border-primary" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark">Arrival Time</label>
                    <input type="datetime-local" id="arrival_time" name="arrival_time"
                        class="form-control border-primary" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark">Bus Description</label>
                    <textarea name="bus_description" id="bus_description"
                        class="form-control border-primary"></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("voyageForm").addEventListener("submit", function (event) {
            event.preventDefault();

            let departureCity = document.getElementById("departure_city").value.trim();
            let arrivalCity = document.getElementById("arrival_city").value.trim();
            let departureTime = document.getElementById("departure_time").value;
            let arrivalTime = document.getElementById("arrival_time").value;

            if (departureCity === "" || arrivalCity === "" || departureTime === "" || arrivalTime === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Attention!',
                    text: 'Veuillez remplir tous les champs requis.',
                });
                return;
            }

            Swal.fire({
                title: "Confirmation",
                text: "Voulez-vous vraiment soumettre ce formulaire ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#004085",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, soumettre!",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("voyageForm").submit();
                }
            });
        });
    </script>

</body>

</html>