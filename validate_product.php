<?php

  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $imagePath = '';
  

  if (!$title) {
    $errors[] = 'Product title is required';
  }
if (!$price) {
  $errors[] = 'Product price is required';
}

if (!is_dir('images')) {
  mkdir('images');
}

// if (empty($errors)) {
//   $image = $_FILES['image'] ?? null;
//   $imagePath = $product['image'];

//   if ($product['image']) {
//     unlink($product['image']);
//   }

  if (empty($errors)) {
    $image = $_FILES['image'] ?? null;
    $imagePath = '';
    if ($image && $image['tmp_name']) {
    
      if ($product['image']) {
        unlink($product['image']);
      }

      $imagePath = 'images/'.randomString(8).'/'.$image['name'];
    mkdir(dirname($imagePath));
      move_uploaded_file($image['tmp_name'], $imagePath);
    
    }

  // if ($image && $image['tmp_name']) {
  //   $imagePath = 'images/' .randomString(8). '/' .$image['name'];
  //   mkdir(dirname($imagePath));
  //  'move_upload_files'($image['tmp_name'], $imagePath);
  // }

 
  
}


