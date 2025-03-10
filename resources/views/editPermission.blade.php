<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>les permission</h1>
    <form action="{{ route('updatePermission') }} " method="POST">
        @csrf
        <div class="container">
            <div class="mb-3">
                <input type="hidden" class="form-control" id="id" name="id" value="{{ $permissions->id }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $permissions->name }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $permissions->description }}">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</body>
</html>