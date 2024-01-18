<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	require 'config/config_final.php';

	// Establish MySQL Connection.
	// $mysqli = new mysqli($host, $user, $pass, $db);
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// Check for any Connection Errors.
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	$sql_cuisine = "SELECT * FROM cuisines;";

	$results_cuisine = $mysqli->query( $sql_cuisine );

	// Check for SQL Errors.
	if ( !$results_cuisine ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$sql_rating = "SELECT * FROM ratings;";

	$results_rating = $mysqli->query( $sql_rating );

	// Check for SQL Errors.
	if ( !$results_rating ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection.
	$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="This is the add restaurants tab. In this website, the user is able to add any restaurant of their choosing to the restaurant directory. How exciting! Users must fill out all fields of the form, including the restaurant name, description, rating, and cuisine.">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    	h1{
    		color: olive;
    	}
    	.search-btn {
    		background-color: #BAB86C;
            color: white;
        }
        #restaurant-img {
        	width: 350px;
        	height: auto;
        }
    </style>
</head>

<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5">
		<h1 class="text-center mb-4">Add a Restaurant</h1>
		<div class="row justify-content-center">
	        <div class="col-md-4">
	        	<img id=restaurant-img img src="img/restaurant5.jpg" alt="Restaurant" class="img-fluid">
	        </div>
	   	</div>
        <form action="add_check.php" method="POST">

	        <!-- Restaurant Bar -->
	        <div class="row mt-4 justify-content-center">
	            <div class="col-md-2 text-right">
	                <label for="restaurant-name-search">Restaurant:</label>
	            </div>
	            <div class="col-md-4">
	                <input type="text" id="restaurant-name-search" class="form-control" name="restaurant_name" placeholder="Restaurant Name">
	            </div>
	        </div>

	        <!-- Description -->
	        <div class="row mt-2 justify-content-center">
	            <div class="col-md-2 text-right">
	                <label for="description">Description:</label>
	            </div>
	            <div class="col-md-4">
	                <input type="text" id="description" class="form-control" name="description" placeholder="Describe your experience!">
	            </div>
	        </div>

	        <!-- Cuisine Dropdown -->
	        <div class="row mt-2 justify-content-center">
	            <div class="col-md-2 text-right">
	                <label for="cuisine-id">Cuisine:</label>
	            </div>
	            <div class="col-md-4">
	                <select name="cuisine_id" id="cuisine-id" class="form-control">
	                    <option value="" selected>-- All --</option>
	                    <?php while ( $row = $results_cuisine->fetch_assoc() ) : ?>
	                        <option value="<?php echo $row['cuisine_id']; ?>">
	                            <?php echo $row['cuisine']; ?>
	                        </option>
	                    <?php endwhile; ?>
	                </select>
	            </div>
	        </div>

	        <!-- Rating Dropdown -->
	        <div class="row mt-2 justify-content-center">
	            <div class="col-md-2 text-right">
	                <label for="rating-id">Rating:</label>
	            </div>
	            <div class="col-md-4">
	                <select name="rating_id" id="rating-id" class="form-control">
	                    <option value="" selected>-- All --</option>
	                    <?php while ( $row = $results_rating->fetch_assoc() ) : ?>
	                        <option value="<?php echo $row['rating_id']; ?>">
	                            <?php echo $row['rating']; ?>
	                        </option>
	                    <?php endwhile; ?>
	                </select>
	            </div>
	        </div>

	        <!-- Search Button -->
	        <div class="row mt-2 justify-content-center">
	            <div class="col-md-6 text-center">
	                <button type="submit" class="search-btn btn">Submit</button>
	            </div>
	        </div>

    	</form>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>