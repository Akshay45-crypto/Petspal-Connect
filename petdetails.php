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
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Database connection
    $conn = new mysqli("localhost", "root", "akshay", "petadoption");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Debug function
    function debug_log($message) {
        error_log(print_r($message, true));
    }

    $pet_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($pet_id > 0) {
        $stmt = $conn->prepare("SELECT * FROM pets WHERE id = ?");
        $stmt->bind_param("i", $pet_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            debug_log("Image path from DB: " . $row["image_path"]);
            ?>
            <div class="container">
                <div class="main-content">
                    <div class="petdetails">
                        <a href="findapet.php" class="back-link">Back to search results</a>
                        <h2><?php echo htmlspecialchars($row["name"]); ?></h2>
                        <h5>
                            <?php echo htmlspecialchars($row["breed"] ?: 'Unknown breed'); ?> | 
                            <strong><?php echo htmlspecialchars($row["age"]); ?></strong> years old
                        </h5>
                    </div>

                    <?php
                    // Image carousel
                    if (!empty($row["image_path"])) {
                        $images = array_filter(array_map('trim', explode(',', $row["image_path"])));
                        if (!empty($images)) {
                            echo '<div class="carousel">';
                            
                            // Radio buttons for slides
                            foreach ($images as $index => $image) {
                                echo '<input type="radio" name="slides" id="slide-' . ($index + 1) . '"' . 
                                     ($index === 0 ? ' checked' : '') . '>';
                            }

                            // Slides
                            echo '<ul class="carousel__slides">';
                            foreach ($images as $image) {
                                $imagePath = basename($image); // Get filename only
                                echo '<li class="carousel__slide">
                                        <figure>
                                            <div>
                                                <img src="uploads/' . htmlspecialchars($imagePath) . '" 
                                                     alt="' . htmlspecialchars($row["name"]) . '">
                                            </div>
                                            <figcaption>
                                                ' . htmlspecialchars($row["description"]) . '
                                            </figcaption>
                                        </figure>
                                    </li>';
                            }
                            echo '</ul>';

                            // Thumbnails
                            echo '<ul class="carousel__thumbnails">';
                            foreach ($images as $index => $image) {
                                $imagePath = basename($image);
                                echo '<li>
                                        <label for="slide-' . ($index + 1) . '">
                                            <img src="uploads/' . htmlspecialchars($imagePath) . '" 
                                                 alt="Thumbnail ' . ($index + 1) . '">
                                        </label>
                                    </li>';
                            }
                            echo '</ul>';
                            echo '</div>';
                        }
                    }
                    ?>

                    <div class="description">
                        <h3>Description</h3>
                        <p><?php echo htmlspecialchars($row["description"]); ?></p>
                    </div>
                </div>

                <div class="side-info">
                    <div class="animallocbox">
                        <h3>Animal Location</h3>
                        <p style="color: rgb(97, 97, 97);">I'm being cared for by:</p>
                        <p><?php echo htmlspecialchars($row["location"] ?? "N/A"); ?></p>
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
                        <li><strong>Sex:</strong> <?php echo htmlspecialchars($row["sex"] ?? "N/A"); ?></li>
                        <li><strong>Size:</strong> <?php echo htmlspecialchars($row["size"] ?? "N/A"); ?></li>
                        <li><strong>Vaccinated:</strong> <?php echo ($row["vaccinated"] ?? false) ? 'Yes' : 'No'; ?></li>
                        <li><strong>Neutered:</strong> <?php echo ($row["neutered"] ?? false) ? 'Yes' : 'No'; ?></li>
                    </ul>
                </div>

                <div class="details-box">
                    <h3>Features</h3>
                    <ul>
                        <?php
                        $features = [
                            'good_with_kids' => 'Great with kids',
                            'good_with_dogs' => 'Friendly with other dogs',
                            'good_with_cats' => 'Friendly with cats',
                            'house_trained' => 'House-trained',
                            'microchipped' => 'Microchipped',
                            'purebred' => 'Purebred',
                            'has_special_needs' => 'Has special needs',
                            'has_behavioural_issues' => 'Has behavioral issues'
                        ];

                        foreach ($features as $key => $label) {
                            if (isset($row[$key]) && $row[$key] === 'yes') {
                                echo '<li>' . htmlspecialchars($label) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        } else {
            echo "<p>Pet not found.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Invalid pet ID.</p>";
    }
    $conn->close();
    ?>
</body>
</html>
