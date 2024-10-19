<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petspal Connect - Home</title>
    <link rel="stylesheet" href="findapet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
   
</head>
<body>
    
    
        <div class="navigation">
            <div class="logo">Petspal<span>Connect</span></div>
            <nav>
                <ul class="nav-links">
                    <li><a href="home.php">Home</a></li>
                    <li class="dropdown">
                        <a href="findapet.php" class="dropbtn">Adopt a Pet &#9662;</a>
                        <div class="dropdown-content">
                            <a href="readytoadopt.html">Are You Ready To Adopt A Pet?</a>
                           
                            <a href="testimonials.html">Testimonials from Adopters</a>
                            <a href="findapet.php">Browse Pets</a>
                        </div>
                    </li>
                    <li><a href="listpet.html">List a Pet</a></li>
                    <li><a href="userregistration.php">Login/Register</a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </nav>
        </div>
   
    <h1>Find Your New Best Friend: Explore Pets Ready for Adoption</h1>
    <section class="about-us">
        <div class="heading-paragraph">

        <p>Welcome to Petspal Connect, your trusted partner in finding and adopting pets. Our mission is to connect loving families with pets in need of a forever home. We are a passionate team dedicated to ensuring that every pet finds a safe and loving environment where they can thrive. Our platform offers a comprehensive list of pets available for adoption, making it easier for you to find the perfect companion.</p>
        <p>At Petspal Connect, we believe in the power of companionship and the joy that pets bring into our lives. Whether you're looking for a playful puppy, a gentle kitten, or a loyal senior pet, we are here to help you find the right match. We work closely with shelters and rescue organizations to provide you with accurate and up-to-date information about available pets.</p>
        
        </div>
    </section>
    
    <div class="container">
        
        
        <a href="pippin.html">
            <div class="pet">
                <div class="thumbnail">
                    <img src="images/petlistings/pippin-image-bde3897c-40f7-41d9-94f6-df5e82c3cae9.jpg" alt="Beagle">
                </div>
                <div class="pet-info">
                    <p class="petbreed">Beagle</p>
                    <p class="petname">Pippin</p>
                    <div class="location">
                        <img class="locationicon" src="images/icons/location_535239.png" alt="Location">
                        <p class="petplace">Perumbavoor</p>
                    </div>
                </div>
            </div>
        </a>
        
        
        
        <div class="pet-list"> <!-- This is your existing class -->
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Database connection
        $conn = new mysqli("localhost", "root", "akshay", "petadoption");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to get pets
        $sql = "SELECT id, breed, name, location, image_path FROM pets"; 
        $result = $conn->query($sql);

        // Begin dynamic pet listing
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagePaths = explode(", ", $row["image_path"]);
                $firstImage = $imagePaths[0] ?? ''; 
                
                echo '
                <div class="pet">
                    <a href="petdetails.php?id=' . htmlspecialchars($row["id"]) . '">
                        <div class="thumbnail">';
                
                if (!empty($firstImage)) {
                    echo '<img src="' . htmlspecialchars($firstImage) . '" alt="' . htmlspecialchars($row["breed"]) . '">';
                } else {
                    echo '<img src="images/placeholder.jpg" alt="No image available">'; 
                }
                
                echo '</div>
                    <div class="pet-info">
                    <p class="petbreed">' . htmlspecialchars($row["breed"]) . '</p>
                        <p class="petname">' . htmlspecialchars($row["name"]) . '</p>
                        <p class="petlocation">Location: ' . htmlspecialchars($row["location"]) . '</p>
                    </div>
                    </a> 
                </div>';
            }
        } else {
            echo "<p>No pets found.</p>";
        }

        $conn->close();
        ?>
    </div> <!-- Closing the pet-list div -->
    </div>

    
</body>
</html>