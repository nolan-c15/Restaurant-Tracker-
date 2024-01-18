<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="This page is my project summary for the ITP303 final. Here I go over how I made my website in detail, in regards to the topic, insructions, data source, extras used, and css frameworks. Although this project took me countless hours, I enjoyed making it by incorporating the material I learned throughout this class.">
	<title>Project Summary</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		img {
			height: 400px;
			width: auto;

		}
	</style>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5">
        <h1 class="text-center mb-4">Project Summary</h1>
    </div>
    <div class="container mt-5 text-center">
    	<h3>Topic</h3>
    	<p>The purpose of this website is to provide a database of restaurants that others have previously eaten at and wrote descriptions and rated. A user can browse through the restaurant directory and search based on filters like Name, Cuisine, and Rating. Users also have the option to add their own restaurant to the list if they so choose to.</p>

    	<h3>Instructions</h3>
    	<p>Anyone can edit the site, there are no permissions / restrictions on the website. I chose to focus on other project extras besides user permissions.</p>

    	<h3>Data Source</h3>
    	<p>I populated my SQL database initially from a public Github restaurants CSV file I found online, which had several elements, like restaurant name, restaurant ID, cuisine, rating, etc. Specifically, I only populated the restaurants table as that was my primary table. I then manually synced and populated the cuisines and ratings table so that the ID would match with the actual rating / cuisine. </p>

    	<img id=finaldatabase img src="img/finaldatabase.png" alt="Final Database">

    	<h3>Data Source</h3>
    	<p>I populated my SQL database initially from a public Github restaurants CSV file I found online, which had several elements, like restaurant name, restaurant ID, cuisine, rating, etc. Specifically, I only populated the restaurants table as that was my primary table. I then manually synced and populated the cuisines and ratings table so that the ID would match with the actual rating / cuisine. </p>

    	<h3>Extras Used</h3>
    	<p>I connected to a Countries JSON API that allows users to search for a specific country and it will give them details like the Country capital and Coat of Arms. I also implemented pagination on the Restaurants Directory. I've attached a link to the API documentation</p>
    	<a href="https://restcountries.com/#rest-countries">Countries API Documentation</a>

    	<h3>CSS Frameworks Used</h3>
    	<p>I relied heavily on Bootstrap's Documentation to help shape a lot of my CSS frameworks. I utilized elements such as containers, columns, rows, responsive images, buttons, navbar, etc. Here is the link to Bootstrap's documentation</p>
    	<a href="https://getbootstrap.com/docs/5.3/getting-started/introduction/">Bootstrap Documentation</a>
    	<a href="https://getbootstrap.com/docs/5.3/components/navbar/#how-it-works/">Bootstrap Navbar</a>
    	<a href="https://getbootstrap.com/docs/5.3/components/pagination//">Bootstrap Pagination</a>
    	<a href="https://getbootstrap.com/docs/5.3/layout/containers//">Bootstrap Columns</a>



    </div>
    <?php include 'footer.php'; ?>
</body>
</html>