<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$products = [];
$sql = "SELECT id, name, slug, description, price FROM products ";

// $name', '$slug', '$description', '$price
if($result = mysqli_query($con,$sql))
{
  $pr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $products[$pr]['id']    = $row['id'];
    $products[$pr]['name'] = $row['name'];
    $products[$pr]['slug'] = $row['slug'];
    $products[$pr]['description'] = $row['description'];
    $products[$pr]['price'] = $row['price'];
    $pr++;
  }
    
  echo json_encode(['data'=>$products]);
}
else
{
  http_response_code(404);
}