<?php
	// Check to see if any required fields are missing.
error_reporting(E_ALL); ini_set('display_errors', 1);
	if ( !isset($_POST['restaurant_name']) || trim($_POST['restaurant_name']) == ''
		|| !isset($_POST['description']) || trim($_POST['description']) == ''
		|| !isset($_POST['cuisine_id']) || trim($_POST['cuisine_id']) == ''
		|| !isset($_POST['rating_id']) || trim($_POST['rating_id']) == '') {
		// One or more of the required fields is empty.
		$error = "Please fill out all sections to provide a complete restaurant review.";
	} else {

		require 'config/config_final.php';
		// DB Connection.
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$restaurant_name = $_POST['restaurant_name'];
		$description = $_POST['description'];
		$cuisine_id = $_POST['cuisine_id'];
		$rating_id = $_POST['rating_id'];

		$sql = "INSERT INTO restaurants (name, description, cuisine_id, rating_id)
						VALUES ('$restaurant_name', '$description', $cuisine_id, $rating_id);";

		$results = $mysqli->query($sql);

		if (!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}


		$mysqli->close();
	}

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
    	.search-btn {
    		background-color: #BAB86C;
            color: white;
        }
        .custom-container {
        	width: 60%; /* Adjust the width of the container */
        	margin: auto; /* Center the container */
    	}
    </style>
</head>

<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5">
		<h1 class="text-center mb-4">Add a Restaurant</h1>
	</div>

	<div class="container mt-5">
		<div class="col-12 text-center">

				<?php if ( isset($error) && trim($error) != '' ) : ?>

					<div class="text-danger">
						<!-- Show Error Messages Here. -->
						<?php echo $error; ?>
					</div>

				<?php else : ?>

					<div class="text-success">
						<span class="font-italic"><?php echo $restaurant_name; ?></span> was successfully added.
					</div>

				<?php endif; ?>

		</div> <!-- .col -->
	</div>

	<div class="row mt-2 justify-content-center">
	    <form action="add_restaurant.php" method="GET">
    		<button type="submit" class="search-btn btn">Back</button>
		</form>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>
