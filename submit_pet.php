<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "akshay";
$dbname = "petadoption";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging: Print POST data
print_r($_POST);
$breed = $_POST['pet-breed'] ?? '';
echo "Breed submitted: " . $breed;  // Debug statement


// Prepare statement
$stmt = $conn->prepare("INSERT INTO pets (name, breed, age, sex, size, vaccinated, neutered, location, description, features, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("Failed to prepare statement: " . $conn->error);
}

// Get basic pet information
$name = $_POST['pet-name'] ?? '';
$breed = $_POST['pet-breed'] ?? ''; // User-entered breed
$age = (int)$_POST['pet-age'];
$sex = $_POST['pet-sex'] ?? '';
$size = $_POST['pet-size'] ?? '';
$vaccinated = ($_POST['shots-up-to-date'] === 'yes') ? 1 : 0;
$neutered = ($_POST['neutered'] === 'yes') ? 1 : 0;
$location = "";
$description = $_POST['pet-description'] ?? '';

// Process features
$features = [];
if (isset($_POST['microchipped']) && $_POST['microchipped'] === 'yes') {
    $features[] = "Microchipped";
}
if (isset($_POST['house-trained']) && $_POST['house-trained'] === 'yes') {
    $features[] = "House-trained";
}
if (isset($_POST['good-with-dogs']) && $_POST['good-with-dogs'] === 'yes') {
    $features[] = "Friendly with other dogs";
}
if (isset($_POST['good-with-cats']) && $_POST['good-with-cats'] === 'yes') {
    $features[] = "Friendly with cats";
}
if (isset($_POST['good-with-kids']) && $_POST['good-with-kids'] === 'yes') {
    $features[] = "Great with kids";
}
if (isset($_POST['purebred']) && $_POST['purebred'] === 'yes') {
    $features[] = "Purebred";
}
if (isset($_POST['has-special-needs']) && $_POST['has-special-needs'] === 'yes') {
    $features[] = "Has special needs";
}
if (isset($_POST['has-behavioural-issues']) && $_POST['has-behavioural-issues'] === 'yes') {
    $features[] = "Has behavioral issues";
}

// Convert features array to string
$featuresString = implode(", ", $features);

// Handle image uploads
$imagePaths = [];
for ($i = 1; $i <= 4; $i++) {
    if (isset($_FILES["pet-photo$i"]) && $_FILES["pet-photo$i"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["pet-photo$i"]["name"]);
        
        if (move_uploaded_file($_FILES["pet-photo$i"]["tmp_name"], $target_file)) {
            $imagePaths[] = $target_file;
        } else {
            echo "Error uploading photo $i.<br>";
        }
    }
}

// Join image paths for storage
$imagePathsString = implode(", ", $imagePaths);

// Bind parameters and execute - do this ONCE, after all variables are prepared
$stmt->bind_param("ssiississss", 
    $name, 
    $breed,  // Now a free text entered by the user
    $age, 
    $sex, 
    $size, 
    $vaccinated, 
    $neutered, 
    $location, 
    $description,
    $featuresString,
    $imagePathsString
);

if ($stmt->execute()) {
    echo "New pet listing created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
