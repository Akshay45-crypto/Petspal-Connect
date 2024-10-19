<?php
session_start(); // Start the session

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petspal Connect - Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
    
    <header>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petspal Connect - Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
    
    <header>
        <div class="container">
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

                    <!-- Show Login/Register only if user is not logged in -->
                    <li><a href="#">About Us</a></li>
                     <!-- Display the first name -->
                        <li><a href="logout.php">Logout</a></li>
                        <?php if (!$is_logged_in): ?>
                        <li><a href="userregistration.php">Login/Register</a></li>
                    <?php else: ?>
                        <li><a href="#">Welcome, <?php echo $_SESSION['user']; ?></a></li>
                        
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    
    <!-- Rest of the HTML structure -->

</body>
</html>

    </header>
    
    <main>
        <div class="content">
            <h1>Welcome to Petspal <span>Connect</span></h1>
            <p>Your one-stop platform for adopting and caring for pets.</p>
            <a href="findapet.php" class="adopt-button">I want to adopt a pet</a>
            <a href="listpet.html" class="rehome-button">I need to rehome a pet </a>
        </div>

        <!-- Why Choose Us Section -->
        <section class="why-choose-us">
            <h2>Why Choose Petspal Connect?</h2>
            <p>Because we enable direct pet adoption, from one good home to another.</p>
            <div class="benefits">
                <div class="benefit">
                    <div class="icon">
                        <img src="images/icons/favorite_24dp_8C1AF6_FILL0_wght400_GRAD0_opsz24.png" alt="Kind To Everyone">
                    </div>
                    <h3>Kind To Everyone</h3>
                    <p>We believe that...</p>
                    <ul>
                        <li>Every pet deserves to be safe, loved, and respected.</li>
                        <li>People who are great candidates for adoption shouldn't be put off by complicated processes or one-size-fits-all rules.</li>
                        <li>People who need to rehome their pets should be empowered to do so without being judged.</li>
                    </ul>
                </div>
                <div class="benefit">
                    <div class="icon">
                        <img src="images/icons/pets_24dp_8C1AF6_FILL0_wght400_GRAD0_opsz24.png" alt="Advocate Adoption">
                    </div>
                    <h3>Advocate Adoption</h3>
                    <p>This value sits at the heart of everything we do. Adoption reduces the demand for puppy farming, industrial-scale breeding, illegal pet imports, and other forms of exploitation and abuse.</p>
                    <p>We’re proud supporters of #AdoptDontShop.</p>
                </div>
                <div class="benefit">
                    <div class="icon">
                        <img src="images/icons/person_4_24dp_8C1AF6_FILL0_wght400_GRAD0_opsz24.png" alt="Responsible Rehoming">
                    </div>
                    <h3>Responsible Rehoming</h3>
                    <p>We’re champions of rehoming, but not at any cost. We believe in finding the right match between adopters and pets, not taking risks or rushing. We always prioritize pet welfare.</p>
                </div>
            </div>
        </section>
    </main>
   



    <footer>
        <div class="footer-container">
            <div class="footer-section about">
                <h3>About Petspal Connect</h3>
                <p>We’re reimagining how you can responsibly rehome and adopt pets...</p>
            </div>
            <div class="footer-section links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Frequently Asked Questions</a></li>
                    <li><a href="">Register for a free PetspalConnect Account</a></li>
                    <li><a href="userregistration.php">Login to your PetspalConnect Account</a></li>
                    <li><a href="#">Tips For Adopters</a></li>
                </ul>
            </div>
            <div class="footer-section follow">
                <h3>Follow Us</h3>
                <ul class="social-icons">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Copyright - PetspalConnect</p>
        </div>
    </footer>
</body>
</html>
