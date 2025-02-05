<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Homepage</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Inventory</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="ref_log.php">Register objects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome to the Inventory System</h1>
        <p>This is the homepage of the Inventory System. Use the navigation bar to explore the features.</p>
        <form action="traitement/register_object.php" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Nom</span>
                <input type="text" class="form-control" id="name" placeholder="Nom" aria-label="name" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="image">Image</label>
                <input type="file" class="form-control" id="image">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Référence</span>
                <input type="text" class="form-control" id="ref" placeholder="Référence" aria-label="ref" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="cat">Catégorie</label>
                <select class="form-select" id="cat">
                    <option selected>-- Choisissez une catégorie --</option>
                    <?php
                    $categories = json_decode(file_get_contents('json/categories.json'), true);
                    foreach ($categories as $category) {
                        echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Register Object</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>