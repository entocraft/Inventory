<?php
// Include the database credentials
require_once '../admin/credentials.php';

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the object from the form
    $name = htmlspecialchars(trim($_POST['name']));
    $ref = htmlspecialchars(trim($_POST['reference_number']));
    $category = htmlspecialchars(trim($_POST['category']));
    $desc = htmlspecialchars(trim($_POST['description']));

    // Check if the reference number already exists in the database
    $stmt = $conn->prepare("SELECT COUNT(*) FROM objects WHERE REF = ?");
    $stmt->bind_param("s", $ref);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        die("Error: Reference already exists.");
    }

    // Get the current date
    $date = date('Y-m-d H:i:s');

    // Handle the image upload
    $target_dir = "../imgs/objects/";
    $bdd_dir = "imgs/objects/";

    // Check if the target directory exists, if not create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $bdd_file = $bdd_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO objects (NAME, IMG_SRC, REF, CATEGORY, DESCRIPTION, ADDED_DATE) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $bdd_file, $ref, $category, $desc, $date);

            // Execute the statement
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    
}

// Close the connection
$conn->close();
?>