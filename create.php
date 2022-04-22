<?php

//**@var $pdo \PDO */
require_once "database.php";
require_once "functions.php";


$errors = [];

$title = '';
$price = '';
$description = '';
$product = [
  'image' => ''
];

if ($_SERVER['REQUEST_METHOD'] ==='POST') {

  require_once "validate_product.php";



$statement = $pdo->prepare("INSERT INTO products(title, image, description, price, create_date)  VALUE(:title, :image, :description, :price, :date)");
$statement->bindValue(':title', $title);
$statement->bindValue(':image', $imagePath);
$statement->bindValue(':description', $description);
$statement->bindValue(':price', $price);
$statement->bindValue(':date', date('Y-m-d H:i:s'));
$statement->execute();
header('Location: index.php');
}





?>


<?php include_once "views/partials/header.php"; ?>
<p>
    <a href="index.php" class="btn btn-secondary"> Go Back to Products </a> 
  </p>
  
    <h1>Create new Product</h1>

    <?php include_once "views/products/form.php"?>

  </body>
 </html>

 <?php
$pdo = new PDO ('mysql:host=localhost;port=3306;dbname=products_crud1', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$errors = [];

$title = '';
$price = '';
$description = '';

if ($_SERVER['REQUEST_METHOD'] ==='POST') {

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$date = date('Y-m-d H:i:s');

if (!$title) {
 $errors[] = 'Product title is required';
}
if (!$price) {
 $errors[] = 'Product price is required';
}

if (!is_dir('images')) {
  mkdir('images');
}

if (empty($errors)) {
$image = $_FILES['image'] ?? null;
$imagePath = '';
if ($image && $image['tmp_name']) {

  $imagePath = 'images/'.randomString(8).'/'.$image['name'];
mkdir(dirname($imagePath));
  move_uploaded_file($image['tmp_name'], $imagePath);

}



$statement = $pdo->prepare("INSERT INTO products(title, image, description, price, create_date)  VALUE(:title, :image, :description, :price, :date)");
$statement->bindValue(':title', $title);
$statement->bindValue(':image', $imagePath);
$statement->bindValue(':description', $description);
$statement->bindValue(':price', $price);
$statement->bindValue(':date', $date);
$statement->execute();
header('Location: index.php');
}
}

function randomString($n)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) -1);
    $str .= $characters[$index];
  }
  return $str;
}
?>
