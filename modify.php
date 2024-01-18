<?php
	require "config/config_final.php";

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

	// Cuisines:

	$sql_cuisine = "SELECT * FROM cuisines;";

	$results_cuisine = $mysqli->query( $sql_cuisine );

	// Check for SQL Errors.
	if ( !$results_cuisine ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Ratings:

	$sql_rating = "SELECT * FROM ratings;";

	$results_rating = $mysqli->query( $sql_rating );

	// Check for SQL Errors.
	if ( !$results_rating ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Restaurant Info:
	$restaurant_id = $_GET['restaurant_id'];

	$sql_restaurant = "SELECT * 
								FROM restaurants 
								WHERE restaurant_id = $restaurant_id;";

	$results_restaurant = $mysqli->query($sql_restaurant);
	if (!$results_restaurant) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$row_restaurant = $results_restaurant->fetch_assoc();

	// Close DB Connection
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
    	h1{
    		color: olive;
    	}
    	.restaurant-name {
    		color: #808000;
    	}
    	.search-btn {
    		background-color: #BAB86C;
            color: white;
        }
    </style>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5">
        <h1 class="text-center mb-4">Restaurant Modification</h1>
    </div><!-- .container -->

    <div class="container mt-5">
        <form action="modify_check.php" method="POST">

        	<input type="hidden" name="restaurant_id" value="<?php echo $row_restaurant['restaurant_id']; ?>">
        	<!-- Restaurant Bar -->
	        <div class="row mt-4 justify-content-center">
	            <div class="col-md-2 text-right">
	                <label for="restaurant-name-search">Restaurant:</label>
	            </div>
	            <div class="col-md-4">
	                <input type="text" id="restaurant-name-search" class="form-control" name="restaurant_name" value="<?php echo $row_restaurant['name']; ?>">
	            </div>
	        </div>

	        <!-- Description -->
	        <div class="row mt-2 justify-content-center">
	            <div class="col-md-2 text-right">
	                <label for="description">Description:</label>
	            </div>
	            <div class="col-md-4">
	                <input type="text" id="description" class="form-control" name="description" value="<?php echo $row_restaurant['description']; ?>">
	            </div>
	        </div>

	        <!-- Cuisine Dropdown -->
	        <div class="row mt-2 justify-content-center">
	            <div class="col-md-2 text-right">
	                <label for="cuisine-id">Cuisine:</label>
	            </div>
	            <div class="col-md-4">
	                <select name="cuisine" id="cuisine-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<?php while( $row = $results_cuisine->fetch_assoc() ): ?>

							<?php if ( $row['cuisine_id'] == $row_restaurant['cuisine_id'] ) : ?>

								<option value="<?php echo $row['cuisine_id']; ?>" selected>
									<?php echo $row['cuisine']; ?>
								</option>

							<?php else : ?>

								<option value="<?php echo $row['cuisine_id']; ?>">
									<?php echo $row['cuisine']; ?>
								</option>

							<?php endif; ?>

						<?php endwhile; ?>

					</select>
	            </div>
	        </div>

	        <!-- Cuisine Dropdown -->
	        <div class="row mt-2 justify-content-center">
	            <div class="col-md-2 text-right">
	                <label for="rating-id">Rating:</label>
	            </div>
	            <div class="col-md-4">
	                <select name="rating" id="rating-id" class="form-control">
						<option value="" selected disabled>-- Select One --</option>

						<?php while( $row = $results_rating->fetch_assoc() ): ?>

							<?php if ( $row['rating_id'] == $row_restaurant['rating_id'] ) : ?>

								<option value="<?php echo $row['rating_id']; ?>" selected>
									<?php echo $row['rating']; ?>
								</option>

							<?php else : ?>

								<option value="<?php echo $row['rating_id']; ?>">
									<?php echo $row['rating']; ?>
								</option>

							<?php endif; ?>

						<?php endwhile; ?>

					</select>
	            </div>
	        </div>

	        <div class="row mt-2 justify-content-center">
	            <div class="col-md-6 text-center">
	                <button type="submit" class="search-btn btn">Submit</button>
	            </div>
	        </div>


        </form>
    </div><!-- .container -->
    <?php include 'footer.php'; ?>

</body>
</html>