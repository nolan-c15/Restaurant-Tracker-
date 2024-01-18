<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
    require 'config/config_final.php';

    // Check for required data.
    if ( !isset($_POST['restaurant_name']) || trim($_POST['restaurant_name']) == ''
        || !isset($_POST['description']) || trim($_POST['description']) == ''
        || !isset($_POST['cuisine']) || trim($_POST['cuisine']) == ''
        || !isset($_POST['rating']) || trim($_POST['rating']) == ''
    ) {
        $error = "Please fill out all required fields.";
    } else {

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ( $mysqli->connect_errno ) {
            echo $mysqli->connect_error;
            exit();
        }

        $mysqli->set_charset('utf8');

        $restaurant_id = $_POST['restaurant_id'];
        $restaurant = $_POST['restaurant_name'];
        $description = $_POST['description'];
        $cuisine = $_POST['cuisine'];
        $rating = $_POST['rating'];

        $sql = "UPDATE restaurants
                        SET name = '$restaurant',
                        description = '$description',
                        cuisine_id = $cuisine,
                        rating_id = $rating
                        WHERE restaurant_id = $restaurant_id;";

        // $sql = "INSERT INTO tracks (name, album_id, media_type_id, genre_id, composer, milliseconds, bytes, unit_price) VALUES ('$track', $album, $media_type, $genre, $composer, $milliseconds, $bytes, $price);";

        $results = $mysqli->query($sql);

        if ( !$results ) {
            echo $mysqli->error;
            $mysqli->close();
            exit();
        }

        // Close MySQL Connection
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
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Confirm Modification</h1>
    </div>

    <div class="container mt-5">
        <div class="row mt-4">
            <div class="col-12 text-center">

                <?php if ( isset($error) && trim($error) != '' ) : ?>

                    <div class="text-danger">
                        <?php echo $error; ?>
                    </div>

                <?php else : ?>

                    <div class="text-success">
                        <span class="font-italic"><?php echo $restaurant; ?></span> was successfully edited.
                    </div>

                <?php endif; ?>

            </div> <!-- .col -->
        </div> <!-- .row -->
        <div class="row mt-2 justify-content-center">
            <form action="rest_directory.php" method="GET">
                <button type="submit" class="search-btn btn">See Directory Update</button>
            </form>
        </div>
    </div> <!-- container -->
    <?php include 'footer.php'; ?>

</body>
</html>

