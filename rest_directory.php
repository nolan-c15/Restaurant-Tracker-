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

	$mysqli->set_charset('utf8');

	// Retrieve results from the DB.
	$sql = "SELECT restaurants.name AS restaurant, restaurants.description AS description, cuisines.cuisine AS cuisine, ratings.rating AS rating, restaurant_id
				FROM restaurants
				LEFT JOIN cuisines
					ON restaurants.cuisine_id = cuisines.cuisine_id
				LEFT JOIN ratings
					ON restaurants.rating_id = ratings.rating_id
				WHERE 1 = 1";

	//check restaurant name match
	if ( isset($_GET['restaurant_name']) && trim($_GET['restaurant_name']) != '' ) {
		$restaurant_name = $mysqli->escape_string( $_GET['restaurant_name'] );
		$sql = $sql . " AND restaurants.name LIKE '%$restaurant_name%'";
	}
	//check cuisine match
	if ( isset( $_GET['cuisine_id'] ) && trim( $_GET['cuisine_id'] ) != '' ) {
		$cuisine_id = $_GET['cuisine_id'];
		$sql = $sql . " AND restaurants.cuisine_id = $cuisine_id";
	}
	//check rating match
	if ( isset( $_GET['rating_id'] ) && trim( $_GET['rating_id'] ) != '' ) {
		$rating_id = $_GET['rating_id'];
		$sql = $sql . " AND restaurants.rating_id = $rating_id";
	}

	$sql = $sql . ";";

	$results = $mysqli->query($sql);

	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$total_results = $results->num_rows;

	$results_per_page = 10;

	$last_page = ceil($total_results / $results_per_page);

	// $current_page = 1;

	if ( isset($_GET['page']) && trim($_GET['page']) != '' ) {
		$current_page = $_GET['page'];
	} else {
		$current_page = 1;
	}

	if ($current_page < 1 || $current_page > $last_page) {
		$current_page = 1;
	}

	$start_index = ($current_page - 1) * $results_per_page;


	// echo "<hr>$sql<hr>";

	$sql = rtrim($sql, ';');

	// echo "<hr>$sql<hr>";

	$sql = $sql . " LIMIT $start_index, $results_per_page";

	// echo "<hr>$sql<hr>";

	$results = $mysqli->query($sql);

	if ( !$results ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	// Close MySQL Connection
	$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="This page is the restaurant directory for Restaurant Rater. It contains the ability to edit or delete restaurants, as well as browse the selection of restaurants that people have already ate at. It displays helpful information like the restaurant name, description, cuisine, and rating.">
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

        #restaurant-img {
        	height: 200px;
        	width: 330px;
        }

        .pagination .page-link {
        	color: olive; /* Change the font color to olive green */
    	}

   	 	/* Optionally, change the hover color */
    	.pagination .page-link:hover {
        	color: darkolivegreen; /* Darker olive color on hover */
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
        <h1 class="text-center mb-4">Restaurant Directory</h1>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <img id=restaurant-img img src="img/restaurant4.jpeg" alt="Restaurant" class="img-fluid">
            </div>
            <div class="col-md-4">
                <img id=restaurant-img src="img/restaurant2.jpg" alt="Restaurant2" class="img-fluid">
            </div>
            <div class="col-md-4">
                <img id=restaurant-img src="img/restaurant3.jpeg" alt="Restaurant3" class="img-fluid">
            </div>
        </div>
    </div><!-- .container -->

    <div class="custom container mt-5">


		<div class="row">
				<div class="col-12">
					<nav aria-label="Page Navigation">
						<ul class="pagination justify-content-center">
							<li class="page-item <?php if ($current_page <= 1) { echo 'disabled'; } ?>">
								<a class="page-link" href="<?php
									$_GET['page'] = 1;
									echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
								?>">First</a>
							</li>
							<li class="page-item <?php if ($current_page <= 1) { echo 'disabled'; } ?>">
								<a class="page-link" href="<?php
									$_GET['page'] = $current_page - 1;
									echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
								?>">Previous</a>
							</li>
							<li class="page-item active">
								<a class="page-link" href=""><?php echo $current_page; ?></a>
							</li>
							<li class="page-item <?php if ($current_page >= $last_page) { echo 'disabled'; } ?>">
								<a class="page-link" href="<?php
									$_GET['page'] = $current_page + 1;
									echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
								?>">Next</a>
							</li>
							<li class="page-item <?php if ($current_page >= $last_page) { echo 'disabled'; } ?>">
								<a class="page-link" href="<?php
									$_GET['page'] = $last_page;
									echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET);
								?>">Last</a>
							</li>
						</ul>
					</nav>
				</div> <!-- .col -->
	    		<div class="col-12">

					<?php if ( $total_results == 0 ) : ?>

					Search returned 0 results.

					<?php else : ?>

						Showing 
						<?php echo $start_index + 1; ?>
						-
						<?php echo $start_index + $results->num_rows; ?>
						of 
						<?php echo $total_results; ?> 
						result(s).

					<?php endif; ?>

				</div>
				<div class="col-12">
					<table class="table table-hover mt-4">
						<thead>
							<tr>
								<th></th>
								<th>Restaurant Name</th>
								<th>Description</th>
								<th>Cuisine</th>
								<th>Rating</th>
								<th></th>
							</tr>
						</thead>
						<tbody>

							<?php while ( $row = $results->fetch_assoc() ) : ?>
								<tr>
									<td>
										<a href="modify.php?restaurant_id=<?php echo $row['restaurant_id']; ?>" class="btn btn-outline-success">
											Edit
										</a>
									</td>
									<td class="restaurant-name"><?php echo $row['restaurant']; ?></td>
									<td><?php echo $row['description']; ?></td>
									<td><?php echo $row['cuisine']; ?></td>
									<td><?php echo $row['rating']; ?></td>
									<td>
										<a href="remove.php?restaurant_id=<?php echo $row['restaurant_id']; ?>&restaurant_name=<?php echo $row['restaurant']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete \'<?php echo $row['restaurant']; ?>\'?');">
											Delete
										</a>
									</td>
								</tr>
							<?php endwhile; ?>

						</tbody>
					</table>
				</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
	<?php include 'footer.php'; ?>
</body>
</html>