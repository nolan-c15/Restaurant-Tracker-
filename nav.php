<style>
    .navbar-custom {
        background-color: olive; /* Red background */
        color: white;
        padding-bottom: 30px;
    }
    .navbar-custom .navbar-brand,
    .navbar-custom .nav-link {
        color: white !important; /* Ensure text is white */
    }

</style>

<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-custom">
	  <a class="navbar-brand" href="#">RestaurantRater</a>
	  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="home.php">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="project_summary.php">Project Summary</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="rest_directory.php">Restaurant Directory</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="add_restaurant.php">Add Restaurant</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="api.php">Country API</a>
	      </li>
	    </ul>
	  </div>
	</nav>