<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/Logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <title>Navette</title>
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
            padding-top: 80px;
            /* Adjust the space according to the navbar height */
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
                        <a href="{{ route('index') }}" class="nav-link">Tag</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('indexPermission') }}" class="nav-link">Permission</a>
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
        <h1 class="text-center my-4">Liste des Navettes</h1>
        <a href="{{ route('form') }}" class="btn btn-primary mb-4">Ajouter une Navette</a>

        <table class="table table-striped table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Ville de Départ</th>
                    <th>Ville d'Arrivée</th>
                    <th>Heure de Départ</th>
                    <th>Heure d'Arrivée</th>
                    <th>Description du Bus</th>
                    <th>status</th>
                    <th>update status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($voyages as $voyage)
                    <tr>
                        <td>{{ $voyage->departure_city }}</td>
                        <td>{{ $voyage->arrival_city }}</td>
                        <td>{{ $voyage->departure_time }}</td>
                        <td>{{ $voyage->arrival_time }}</td>
                        <td>{{ $voyage->bus_description }}</td>
                        <td class="status-text">{{ ucfirst($voyage->status) }}</td>
                        <td>
                            <button class="btn btn-sm btn-toggle-status" data-id="{{ $voyage->id }}"
                                data-status="{{ $voyage->status }}"
                                style="background-color: {{ $voyage->status == 'valid' ? '#dc3545' : '#28a745' }}; color: white;">
                                {{ $voyage->status == 'valid' ? 'Closed' : 'Valid' }}
                            </button>
                        </td>
                        <td>
                            <a href="{{ route('edit', $voyage->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('destroy', $voyage->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucun voyage disponible</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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

                                    let newColor = newStatus === "valid" ? "#dc3545" : "#28a745";
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