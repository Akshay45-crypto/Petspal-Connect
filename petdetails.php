<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($row["name"]) ? htmlspecialchars($row["name"]) . " - Details" : "Pet Details"; ?></title>
    <link rel="stylesheet" href="petdetails.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Database connection
            $conn = new mysqli("localhost", "root", "akshay", "petadoption"); // Use your credentials

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch pet ID from URL
            $pet_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            // Use prepared statement to fetch pet details
            if ($pet_id > 0) {
                $stmt = $conn->prepare("SELECT * FROM pets WHERE id = ?");
                $stmt->bind_param("i", $pet_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display pet details
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    
                    // Debugging: Check if breed is being retrieved correctly
                    var_dump($row["breed"]);
                    
                    echo '<div class="petdetails">
                            <a href="findapet.php" class="back-link">Back to search results</a>
                            <h2>' . htmlspecialchars($row["name"]) . '</h2>
                            <h5>' . (isset($row["breed"]) && !empty($row["breed"]) ? htmlspecialchars($row["breed"]) : 'Unknown breed') . 
                            ' | <strong>' . htmlspecialchars($row["age"]) . '</strong> years old</h5>
                        </div>
                        <img class="img1" src="uploads/' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
                    
                    echo '<div class="description">
                            <h3>Description</h3>
                            <p>' . htmlspecialchars($row["description"]) . '</p>
                          </div>';
                    
                    // Fetch feature-related data
                    $good_with_kids = $row["good_with_kids"];
                    $good_with_dogs = $row["good_with_dogs"];
                    $good_with_cats = $row["good_with_cats"];
                    $house_trained = $row["house_trained"];
                    $microchipped = $row["microchipped"];
                    $purebred = $row["purebred"];
                    $has_special_needs = $row["has_special_needs"];
                    $has_behavioural_issues = $row["has_behavioural_issues"];
                } else {
                    echo "<p>Pet not found.</p>";
                }
                $stmt->close();
            } else {
                echo "<p>Invalid pet ID.</p>";
            }

            $conn->close();
            ?>
        </div>

        <div class="side-info">
            <div class="animallocbox">
                <h3>Animal Location</h3>
                <p style="color: rgb(97, 97, 97);">I'm being cared for by:</p>
                <p><?php echo isset($row["location"]) ? htmlspecialchars($row["location"]) : "N/A"; ?></p>
            </div>
            <div class="adopt">
                <p>Thinking about adoption?</p>
                <p>Submit your adoption application by clicking the button below.</p>
                <a href="list-a-pet.html">
                    <button class="submit">Submit</button>
                </a>
            </div>
        </div>
    </div>

    <div class="extra-details">
        <div class="details-box">
            <h3>Additional Details</h3>
            <ul>
                <li><strong>Sex:</strong> <?php echo isset($row["sex"]) ? htmlspecialchars($row["sex"]) : "N/A"; ?></li>
                <li><strong>Size:</strong> <?php echo isset($row["size"]) ? htmlspecialchars($row["size"]) : "N/A"; ?></li>
                <li><strong>Vaccinated:</strong> <?php echo isset($row["vaccinated"]) && $row["vaccinated"] ? 'Yes' : 'No'; ?></li>
                <li><strong>Neutered:</strong> <?php echo isset($row["neutered"]) && $row["neutered"] ? 'Yes' : 'No'; ?></li>
            </ul>
        </div>

        <div class="details-box">
            <h3>Features</h3>
            <ul>
                <?php
                // Check each feature and display it if it's "yes"
                if (isset($good_with_kids) && $good_with_kids === 'yes') {
                    echo '<li>Great with kids</li>';
                }
                if (isset($good_with_dogs) && $good_with_dogs === 'yes') {
                    echo '<li>Friendly with other dogs</li>';
                }
                if (isset($good_with_cats) && $good_with_cats === 'yes') {
                    echo '<li>Friendly with cats</li>';
                }
                if (isset($house_trained) && $house_trained === 'yes') {
                    echo '<li>House-trained</li>';
                }
                if (isset($microchipped) && $microchipped === 'yes') {
                    echo '<li>Microchipped</li>';
                }
                if (isset($purebred) && $purebred === 'yes') {
                    echo '<li>Purebred</li>';
                }
                if (isset($has_special_needs) && $has_special_needs === 'yes') {
                    echo '<li>Has special needs</li>';
                }
                if (isset($has_behavioural_issues) && $has_behavioural_issues === 'yes') {
                    echo '<li>Has behavioral issues</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
