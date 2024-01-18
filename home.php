<?php

	require 'config/config_final.php';

	// Establish MySQL Connection.
	// $mysqli = new mysqli($host, $user, $pass, $db);
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// Check for any Connection Errors.
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

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
	<meta name="description" content="100 characters...">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    	.content {
    		padding-bottom: 30px;
    	}
    	h1{
    		color: olive;
    	}
    	.search-btn {
    		background-color: #BAB86C;
            color: white;
        }
        #restaurant-img {
        	height: 350px;
        	width: auto;
        }
    </style>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5">
        <h1 class="text-center mb-4">Welcome to Restaurant Rater</h1>
        
        <div class="row">
            <div class="col-md-6">
                <img id="restaurant-img" src="img/restaurant.jpeg" alt="Descriptive Text">
            </div>
            <div class="col-md-6">
            	<h3>What is Restaurant Rater?</h3>
                <p>There are so many different restaurants to try that it's hard to keep track of which ones are worth going and which ones are worth passing on and making a meal at home. With Restaurant Rater you can see an array of restaurants that have been rated by others, with the name, description, rating, and cuisine. Feel free to add a review of your own by clicking on "ADD A RESTAURANT" or browse our existing list through "RESTAURANT DIRECTORY"</p>

                <p>Down below is a SEARCH option where you can filter by cuisines if you want to. Or you can just click SEARCH and you'll see a list of all the restaurants that we have available / reviewed. Happy Searching!</p>

                <p>Don't forget to add a review of your favorite restaurant before you leave :)</p>
            </div>
        </div>
    </div> <!--container-->

    <div class="container mt-5">

        <form action="rest_directory.php" method="GET">

	        <!-- Search Bar -->
	        <div class="row mt-4 justify-content-center">
	            <div class="col-md-2 text-right">
	                <label for="restaurant-name-search">Restaurant:</label>
	            </div>
	            <div class="col-md-4">
	                <input type="text" id="restaurant-name-search" class="form-control" name="restaurant_name" placeholder="Olive Garden...">
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
	                <button type="submit" class="search-btn btn">Search</button>
	            </div>
	        </div>

    	</form>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>