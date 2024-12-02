<?php
session_start();
include('database.php');

if (isset($_POST['add-category-submit'])) {
  $CategoryName = mysqli_real_escape_string($db, $_POST['category-name']);
  $CategoryQuantity = mysqli_real_escape_string($db, $_POST['category-quantity']);
  $userId = $_SESSION['detsuid'];

  // Use prepared statement to prevent SQL injection
  $stmt = $db->prepare("INSERT INTO tblcategory (CategoryName, Quantity, UserId) VALUES (?, ?, ?)");
  $stmt->bind_param("sii", $CategoryName, $CategoryQuantity, $userId);
  $result = $stmt->execute();

  if ($result) {
    $message = "New stock added successfully!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<script type='text/javascript'>window.location.href = 'add-expenses.php';</script>";
    exit();
  } else {
    // Error adding category
    echo "Error: " . mysqli_error($db);
  }
}
?>
