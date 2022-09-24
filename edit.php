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

$id = $_GET["id"];

$sql = $conn->query("select * from cars where CarId = $id");
$car = $sql->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car</title>
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
                    <li class="nav-item " >
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
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Update Car</h1>
            </div>
            <div class="card-body">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Car Image</label>
                        <input type="file" class="form-control" name="image">
                        <img src="./images/<?php echo $car->Image; ?>" alt="Car Image" style="width:100px;height:100px" class="mt-2">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Car Id</label>
                        <input type="number" class="form-control" name="car_name" value="<?php echo $car->CarId ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Car Model</label>
                        <input type="text" class="form-control" name="model" value="<?php echo $car->Model ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Car Price</label>
                        <input type="number" class="form-control" name="price" value="<?php echo $car->Price ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <input type="text" class="form-control" name="color" value="<?php echo $car->Color ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

</body>

</html>


<?php
if (isset($_POST["submit"])) {
    $image = $_FILES["image"]["name"];
    $car_name = $_POST["car_name"];
    $model = $_POST["model"];
    $price = $_POST["price"];
    $color = $_POST["color"];

    $sql = "update cars set Image = :img, CarId=:cid,Model = :model,Price = :price,Color = :color where CarID = :id";

    $query = $conn->prepare($sql);

    // Bind the parameters
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':img', $image, PDO::PARAM_STR);
    $query->bindParam(':cid', $car_name, PDO::PARAM_STR);
    $query->bindParam(':model', $model, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
    $query->bindParam(':color', $color, PDO::PARAM_STR);

    $query->execute();

    header("Location: index.php");
}

?>