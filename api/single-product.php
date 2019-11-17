<?php
require 'connect.php';

  $id= $_GET['id'];

  $query = "SELECT * FROM products WHERE id = {$id} ";
  $sql = mysqli_query($con,$query);
  $row = mysqli_fetch_assoc($sql);
  
  
  echo json_encode(['data'=>$row]);