<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
  

  // Validate.
  if(trim($request->data->name) === '' || (int)$request->data->price < 1)
  {
    return http_response_code(400);
  }
  // Sanitize.
  $id = mysqli_real_escape_string($con, trim($request->data->id));
  $name = mysqli_real_escape_string($con, trim($request->data->name));
  $slug = mysqli_real_escape_string($con, trim($request->data->slug));
  $description = mysqli_real_escape_string($con, trim($request->data->description));
  $price = mysqli_real_escape_string($con, trim($request->data->price));
    
  // Store.
  $sql = "UPDATE products SET name='{$name}', slug='{$slug}', description='{$description}', price='{$price}' WHERE id = {$id} ";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $products = [
      'name' => $name,
      'slug' => $slug,
      'description' => $description,
      'price' => $price,
      'id'    => mysqli_insert_id($con)
    ];
    echo json_encode(['data'=>$products]);
  }
  else
  {
    http_response_code(422);
  }
}