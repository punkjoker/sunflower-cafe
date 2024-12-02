<?php
session_start();
include('database.php');

if (isset($_POST['delete-category-submit'])) {
  $categoryId = mysqli_real_escape_string($db, $_POST['category-id']);
  $userId = $_SESSION['detsuid'];

  // Use prepared statement to prevent SQL injection
  $stmt = $db->prepare("DELETE FROM tblcategory WHERE CategoryId = ? AND UserId = ?");
  $stmt->bind_param("ii", $categoryId, $userId);
  $result = $stmt->execute();

  if ($result) {
    $message = "Category deleted successfully!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<script type='text/javascript'>window.location.href = 'add-expenses.php';</script>";
    exit();
  } else {
    echo "Error: " . mysqli_error($db);
  }
}
?>
