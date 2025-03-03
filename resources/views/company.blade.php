<!DOCTYPE html>
<html lang="fr">

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
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd700;
        }

        .btn-primary {
            background-color: #004085;
            border-color: #004085;
        }

        .btn-primary:hover {
            background-color: #003366;
            border-color: #003366;
        }

        .table {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: #004085;
            color: white;
        }

        td {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
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
                        <a href="/" class="nav-link text-white">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/form" class="nav-link text-white">Ajouter voyage</a>
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

    <!-- Content Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Liste des Offres de Navettes</h2>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Départ Time</th>
                        <th>Arrivée Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($voyages as $voyage)
                        <tr id="row-{{ $voyage->id }}">
                            <td>{{ $voyage->id }}</td>
                            <td>{{ $voyage->departure_city }}</td>
                            <td>{{ $voyage->arrival_city }}</td>
                            <td>{{ $voyage->departure_time }}</td>
                            <td>{{ $voyage->arrival_time }}</td>
                            <td class="status-text">{{ ucfirst($voyage->status) }}</td>
                            <td>
                                <button class="btn btn-sm btn-toggle-status" data-id="{{ $voyage->id }}"
                                    data-status="{{ $voyage->status }}"
                                    style="background-color: {{ $voyage->status == 'valid' ? '#28a745' : '#dc3545' }}; color: white;">
                                    {{ $voyage->status == 'valid' ? 'Closed' : 'Valid' }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap & jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- إضافة مكتبة SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $(".btn-toggle-status").click(function () {
            let btn = $(this);
            let voyageId = btn.data("id");
            let currentStatus = btn.data("status");
            let newStatus = currentStatus === "valid" ? "closed" : "valid";

            Swal.fire({
                title: "Êtes-vous sûr?",
                text: "Vous êtes sur le point de changer le statut de ce voyage.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, changer!",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "/voyages/update-status/" + voyageId,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: newStatus
                        },
                        success: function (response) {
                            if (response.success) {
                                btn.data("status", newStatus);
                                btn.text(newStatus === "valid" ? "Closed" : "Valid");
                                btn.closest("tr").find(".status-text").text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));

                                let newColor = newStatus === "valid" ? "#28a745" : "#dc3545";
                                btn.css({
                                    "background-color": newColor,
                                    "border-color": newColor,
                                    "color": "white"
                                });

                                Swal.fire({
                                    title: "Succès!",
                                    text: "Le statut a été mis à jour avec succès.",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                title: "Erreur!",
                                text: "Une erreur s'est produite lors de la mise à jour du statut.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });
</script>


</body>
</html>
