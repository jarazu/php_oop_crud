<?php
require 'connect.php';

  $id= $_GET['id'];
  $sql = "delete from `products` where `id` = '{$id}' limit 1";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    
    echo json_encode(true);
  }
  else
  {
    http_response_code(422);
  }