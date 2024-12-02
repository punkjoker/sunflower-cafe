<?php
include('database.php');

if (isset($_GET['categoryId'])) {
    $categoryId = intval($_GET['categoryId']);
    $query = mysqli_query($db, "SELECT CategoryName, Quantity FROM tblcategory WHERE CategoryId = '$categoryId'");
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'Category not found']);
    }
}
?>
