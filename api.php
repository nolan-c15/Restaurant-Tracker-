<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="This is the Country API. Unfortunately, I wasn't able to fully flush it out because of limited time but I tried to do the best with what I could. Users can search for a country and it will show more information. Weirdly, this API didn't include several major countries.">
    <title>Country Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
	    .navbar-custom {
	        background-color: #ff0000; /* Red color */
	    }
	    .navbar-custom .navbar-brand,
	    .navbar-custom .nav-link {
	        color: white; /* White text for better visibility */
	    }
	    .search-btn {
    		background-color: #BAB86C;
            color: white;
        }
	</style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<?php include 'nav.php'; ?>
<!-- End Navbar -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
            	<p class="lead">Welcome to the Country API! If there is a certain cuisine/country that you would like to learn more about, please search for it here.</p>
                <input type="text" id="country-name" class="form-control mb-2" placeholder="Enter Country Name">   
                <!-- <button id="get-flag" class="btn btn-primary btn-block">Get Flag</button>  -->
                <button type="submit" id="get-flag" class="search-btn btn">Search</button>
            </div>
        </div>
        <div id="container" class="row mt-4">
            <!-- Cards will be inserted here -->
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#get-flag').click(function(){
                var countryName = $('#country-name').val(); // Get the value of the input field

                // jQuery AJAX request
                $.ajax({
                    url: `https://restcountries.com/v3.1/name/${countryName}`,
                    method: 'GET',
                    success: function(response) {
                        // Assuming response is an array and we take the first result
                        var country = response[0];
                        var cardHtml = `
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img class="card-img-top" src="${country.coatOfArms.png}" alt="Coat of arms of ${country.name.common}">
                                    <div class="card-body">
                                        <h5 class="card-title">${country.name.common}</h5>
                                        <p class="card-text">Capital: ${country.capital[0]}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#container').append(cardHtml); // Append the new card to the container
                    },
                    error: function() {
                        console.error('Error fetching data');
                        $('#container').html('<p class="text-danger">Error fetching data</p>'); // Show error in container
                    }
                });
            });
        });
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>
