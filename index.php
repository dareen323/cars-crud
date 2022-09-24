<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=shop", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
           
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php"><b>Rent cars page</b></a>
                    </li>
                    <li class="nav-item">
                    <a class="btn btn-primary"href="./create.php?message='Added record successfully'" role="button">Add car</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
    <?php 
    $query = $conn->query("select * from cars");
    $cars = $query->fetchAll(PDO::FETCH_OBJ);

    ?>

    <div class="container mt-5">
        <div class="row">
            <?php foreach ($cars as $car) : ?>
                <div class="col-md-4 my-2">
                    <div class="card" style="width: 18rem;">
                        <img src="./images/<?php echo $car->Image ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo $car->Model ?></h2>
                            <h6 class="card-text"><?php echo $car->CarId ?></h6>
                            <p class="card-text"><?php echo $car->Price ?></p>
                            <p class="card-text"><?php echo $car->Color ?></p>
                            <a href="edit.php?id=<?php echo $car->CarId ?>" class="btn btn-primary">Update info</a>
                            <a href="delete.php?id=<?php echo $car->CarId ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


</body>

</html>