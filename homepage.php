<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Homepage</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Inventory</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
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

    <div class="row justify-content-center mt-5">
        <div class="col-11">
            <h1>Welcome to the Inventory System</h1>
            <p>This is the homepage of the Inventory System. Use the navigation bar to explore the features.</p>
            <?php
            require_once 'admin/credentials.php';

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM objects";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="row">';
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-xl-2 col-xl-3 col-md-4 col-sm-6">';
                    echo '<div class="card mb-4">';
                    echo '<img src="' . $row["IMG_SRC"] . '" class="card-img-top" alt="' . $row["NAME"] . '" style="object-fit: cover; aspect-ratio: 1/1; width: 100%; height: auto;">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["NAME"] . '</h5>';
                    echo '<p class="card-text">Ref: ' . $row["REF"] . '</p>';
                    echo '<div class="row justify-content-center">';
                    echo '<a href="edit.php?id=' . $row["REF"] . '" class="btn btn-primary col-5">Voir plus</a> ';
                    echo '<a href="delete.php?id=' . $row["REF"] . '" class="btn btn-outline-primary col-5 offset-1">Réserver</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html></html>