<?php
session_start(); // added session_start() to start session
include('database.php');
if (isset($_POST['submit'])) {
  $expenseid = $_POST['expenseid'];
  $dateexpense = $_POST['dateexpense'];
  $category = $_POST['category'];
  $cost = $_POST['cost'];
  $description = $_POST['description'];
  $stock = $_POST['stock'];

  $query = mysqli_query($db, "UPDATE tblexpense SET ExpenseDate='$dateexpense', Category='$category', ExpenseCost='$cost', Description='$description', Stock='$stock' WHERE ID='$expenseid'");
  if ($query) {
      echo "<script>alert('Expense successfully updated');</script>";
      echo "<script>window.location.href='manage-expenses.php'</script>";
  } else {
      echo "<script>alert('Something went wrong. Please try again');</script>";
  }
}

?>
