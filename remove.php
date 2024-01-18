<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
	if ( !isset($_GET['restaurant_id']) || trim($_GET['restaurant_id']) == ''
		|| !isset($_GET['restaurant_name']) || trim($_GET['restaurant_name']) == ''
	) {
		$error = "Invalid Restaurant ID.";
	}	else {
			require 'config/config_final.php';

			// DB Connection.
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if ( $mysqli->connect_errno ) {
				echo $mysqli->connect_error;
				exit();
			}

			$mysqli->set_charset('utf8');

			$restaurant_id = $_GET['restaurant_id'];

			$sql = "DELETE
							FROM restaurants
							WHERE restaurant_id = $restaurant_id;";

			$results = $mysqli->query($sql);

			if ( !$results ) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}

			// $row = $results->fetch_assoc();

			$mysqli->close();
	}
	
?>

!DOCTYPE html>
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
        <h1 class="text-center mb-4">Restaurant Removal :(</h1>
    </div><!-- .container -->

    <div class="container mt-5">
    	<div class="col-12 text-center">

			<?php if (isset($error) && trim($error) != '') : ?>
			
				<div class="text-danger">
					<?php echo $error; ?>
				</div>

			<?php else : ?>

				<div class="text-success"><span class="font-italic"><?php echo $_GET['restaurant_name']; ?></span> was successfully deleted.</div>

			<?php endif; ?>

		</div> <!-- .col -->
    </div>
    <div class="row mt-2 justify-content-center">
	    <form action="rest_directory.php" method="GET">
    		<button type="submit" class="search-btn btn">Back to Directory</button>
		</form>
	</div>
	<?php include 'footer.php'; ?>

</body>
</html>
