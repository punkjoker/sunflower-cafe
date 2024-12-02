<?php
session_start();
include('database.php');

if (isset($_GET['categoryId'])) {
  $categoryId = intval($_GET['categoryId']);
  $userId = $_SESSION['detsuid'];

  $query = "SELECT Quantity FROM tblcategory WHERE CategoryId = $categoryId AND UserId = $userId";
  $result = mysqli_query($db, $query);

  if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode(['quantity' => $row['Quantity']]);
  } else {
    echo json_encode(['quantity' => 0]);
  }
}
?>
