<?php
session_start();
error_reporting(0);
include('database.php');

if (strlen($_SESSION['detsuid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $userid = $_SESSION['detsuid'];
    $dateexpense = $_POST['dateexpense'];
    $categoryId = $_POST['category'];
    $description = $_POST['category-description'];
    $costitem = $_POST['costitem'];
    $stock = $_POST['stock'];

    // Insert into tblexpense
    $query = mysqli_query($db, "INSERT INTO tblexpense(UserId, ExpenseDate, CategoryId, category, ExpenseCost, Description, Stock) SELECT '$userid', '$dateexpense', CategoryId, CategoryName, '$costitem', '$description', '$stock' FROM tblcategory WHERE CategoryId = '$categoryId'");

    if ($query) {
      // Update category quantity
      $updateQuery = mysqli_query($db, "UPDATE tblcategory SET Quantity = Quantity - '$stock' WHERE CategoryId = '$categoryId'");
      if ($updateQuery) {
        $message = "Expense added successfully";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script type='text/javascript'>window.location.href = 'manage-expenses.php';</script>";
      } else {
        $message = "Failed to update category quantity";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    } else {
      $message = "Expense could not be added";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }
?>







<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="css/style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="js/scripts.js"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

     <style> 
.container {
  background-color: #f2f2f2;
  border-radius: 5px;
  box-shadow: 0px 0px 10px #aaa;
  padding: 20px;
  margin-top: 20px;
}

.form-group label {
  font-weight: bold;
}

.form-control {
  border-radius: 3px;
  border: 1px solid #ccc;
}

.invalid-feedback {
  color: red;
  font-size: 12px;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

     </style>
   </head>
<body>
  <div class="sidebar">
  <div class="logo-details">
      <i class='bx bx-album'></i>
      <span class="logo_name">Expenditure</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="home.php" >
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#" class="active">
            <i class='bx bx-box' ></i>
            <span class="links_name">Expenses</span>
          </a>
        </li>
        <li>
          <a href="manage-expenses.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Manage List</span>
          </a>
        </li>
        <li>
          <a href="lending.php" >
          <i class='bx bx-money'></i>
            <span class="links_name">Sales</span>
          </a>
        </li>
        <li>
        <a href="manage-lending.php" >
        <i class='bx bx-coin-stack'></i>
            <span class="links_name">Manage Sales</span>
          </a>
        </li>
        <li>
        <a href="analytics.php">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Analytics</span>
          </a>
        </li>
        <li>
          <a href="report.php">
          <i class="bx bx-file"></i>
            <span class="links_name">Report</span>
          </a>
        </li>
        <li>
        <a href="user_profile.php">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
        <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Expenditure</span>
      </div>
   
      <?php
$uid=$_SESSION['detsuid'];
$ret=mysqli_query($db,"select name  from users where id='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['name'];

?>

      <div class="profile-details">
  <img src="images/maex.png" alt="">
  <span class="admin_name"><?php echo $name; ?></span>
  <i class='bx bx-chevron-down' id='profile-options-toggle'></i>
  <ul class="profile-options" id='profile-options'>
  <li><a href="user_profile.php"><i class="fas fa-user-circle"></i> User Profile</a></li>
    <!-- <li><a href="#"><i class="fas fa-cog"></i> Account Settings</a></li> -->
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
  </ul>
</div>
<script>
  const toggleButton = document.getElementById('profile-options-toggle');
  const profileOptions = document.getElementById('profile-options');
  
  toggleButton.addEventListener('click', () => {
    profileOptions.classList.toggle('show');
  });
</script>

    </nav>


      <?php
$uid=$_SESSION['detsuid'];
$ret=mysqli_query($db,"select name  from users where id='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['name'];

?>

    <div class="home-content">
      <div class="overview-boxes">

     
    <div class="col-md-12">
        <br>
        
        <div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6">
        <h4 class="card-title">Add Expense</h4>
      </div>
      <div class="col-md-6 text-right">
  <div class="ml-auto">
    <!-- Add Category Button -->
    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#add-category-modal">
      <i class="fas fa-plus-circle"></i> Add New Stock
    </button>

    <!-- Delete Category Button -->
    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-category-modal">
      <i class="fas fa-trash-alt"></i> Delete Stock
    </button>
  </div>
  <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#view-category-modal">
  <i class="fas fa-eye"></i> View Stock Details
</button>

</div>

<!-- Add Category Modal -->
<div class="modal fade" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="add-category-modal-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="add-category-form" method="post" action="add_category.php">
        <div class="modal-header">
          <h5 class="modal-title" id="add-category-modal-title">Add New Stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="category-name">Stock Name</label>
            <select class="form-control" id="category-name" name="category-name" required>
            <option value="">Select Stock</option>
          <optgroup label="Staples & Dry Goods">
            <option value="Flour">Flour (2kg packets)</option>
            <option value="Rice">Rice (kg)</option>
            <option value="Sugar">Sugar (kg)</option>
            <option value="Salt">Salt (kg)</option>
            <option value="Cooking Oil">Cooking Oil (Litres)</option>
            <option value="Spices">Spices</option>
            <option value="Tea Leaves">Tea Leaves (grams)</option>
            <option value="Coffee/Nescafe">Coffee/Nescafe</option>
          </optgroup>
          <optgroup label="Dairy Products">
            <option value="Milk">Milk packets</option>
            <option value="Butter/Margarine">Butter/Margarine</option>
            <option value="Cheese">Cheese</option>
          </optgroup>
          <optgroup label="Proteins">
            <option value="Eggs">Eggs</option>
            <option value="Beef">Beef (kg)</option>
            <option value="Chicken">Chicken</option>
            <option value="Fish">Fish</option>
            <option value="Offals">Offals</option>
          </optgroup>
          <optgroup label="Vegetables">
            <option value="Onions">Onions (kg)</option>
            <option value="Tomatoes">Tomatoes</option>
            <option value="Greens">Greens (kg)</option>
            <option value="Garlic and Ginger">Garlic and Ginger</option>
            <option value="Capsicum">Capsicum</option>
          </optgroup>
          <optgroup label="Beverages">
            <option value="Sodas">Sodas</option>
            <option value="Bottled Water">Bottled Water</option>
          </optgroup>
          <optgroup label="Miscellaneous">
            <option value="Charcoal/Gas">Charcoal or Gas</option>
            <option value="Packaging Materials">Packaging Materials</option>
            <option value="Cleaning Supplies">Cleaning Supplies</option>
          </optgroup>
        </select>
          </div>
          <div class="form-group">
            <label for="category-quantity">Stock Amount</label>
            <input type="number" class="form-control" id="category-quantity" name="category-quantity" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="add-category-submit">Add New Stock</button>
        </div>
      </form>
    </div>
  </div>
  
</div>

<!-- Delete Category Modal -->
<div class="modal fade" id="delete-category-modal" tabindex="-1" role="dialog" aria-labelledby="delete-category-modal-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="delete-category-form" method="post" action="delete_category.php">
        <div class="modal-header">
          <h5 class="modal-title" id="delete-category-modal-title">Delete Stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="delete-category">Category</label>
            <select class="form-control" id="delete-category" name="category-id" required>
              <option value="" selected disabled>Choose Stock</option>
              <?php
              $userid = $_SESSION['detsuid'];
              $query = "SELECT * FROM tblcategory WHERE UserId = $userid";
              $result = mysqli_query($db, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['CategoryId'].'">'.$row['CategoryName'].'</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" name="delete-category-submit">Delete Stock</tbutton>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="view-category-modal" tabindex="-1" role="dialog" aria-labelledby="view-category-modal-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="view-category-modal-title">Stock Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="view-category-name">Stock Name</label>
          <input type="text" class="form-control" id="view-category-name" readonly>
        </div>
        <div class="form-group">
          <label for="view-remaining-quantity">Remaining Stock</label>
          <input type="text" class="form-control" id="view-remaining-quantity" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="card-body">
  <form id="expense-form" role="form" method="post" action="" class="needs-validation">
    <div class="form-group">
      <label for="dateexpense">Date of Expense</label>
      <input class="form-control" type="date" id="dateexpense" name="dateexpense" value="<?php echo date('Y-m-d'); ?>" required>
    </div>

    <div class="form-group">
      <label for="category">Category Stock</label>
      <select class="form-control" id="category" name="category" required>
        <option value="" selected disabled>Choose Stock</option>
        <?php
        $userid = $_SESSION['detsuid'];
        $query = "SELECT * FROM tblcategory WHERE UserId = $userid";
        $result = mysqli_query($db, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<option value="'.$row['CategoryId'].'">'.$row['CategoryName'].'</option>';
        }
        ?>
      </select>
    </div>

    <div class="form-group">
          <label for="view-remaining-quantity">Remaining Stock</label>
          <input type="text" class="form-control" id="view-remaining-quantity" readonly>
      </div>

    <div class="form-group">
      <label for="costitem">Cost Expense</label>
      <input class="form-control" type="number" id="costitem" name="costitem" required>
    </div>

    <div class="form-group">
      <label for="stock">No of stock Expense</label>
      <input class="form-control" type="number" id="stock" name="stock" required>
    </div>

    <div class="form-group">
      <label for="category-description">Description</label>
      <textarea class="form-control" id="category-description" name="category-description" required></textarea>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="submit">Add</button>
    </div>
  </form>
  <div id="success-message" class="alert alert-success" style="display:none;">
    Expense added successfully.
  </div>
</div>




<script>
  // JavaScript for toggling sidebar
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".sidebarBtn");
  sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if(sidebar.classList.contains("active")) {
      sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
    } else {
      sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  }

  // JavaScript for fetching and updating remaining quantity
  document.getElementById('category').addEventListener('change', function() {
    var categoryId = this.value;
    if (categoryId) {
      fetch('get_category_details.php?categoryId=' + categoryId)
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            console.error('Error fetching category details:', data.error);
          } else {
            document.getElementById('view-category-name').value = data.CategoryName;
            document.getElementById('view-remaining-quantity').value = data.Quantity;
          }
        })
        .catch(error => console.error('Error fetching category details:', error));
    } else {
      document.getElementById('view-category-name').value = '';
      document.getElementById('view-remaining-quantity').value = '';
    }
  });

  // JavaScript for showing category details in the modal
  document.querySelector('button[data-target="#view-category-modal"]').addEventListener('click', function() {
    var categoryId = document.getElementById('category').value;
    if (categoryId) {
      fetch('get_category_details.php?categoryId=' + categoryId)
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            console.error('Error fetching category details:', data.error);
          } else {
            document.getElementById('view-category-name').value = data.CategoryName;
            document.getElementById('view-remaining-quantity').value = data.Quantity;
          }
        })
        .catch(error => console.error('Error fetching category details:', error));
    } else {
      document.getElementById('view-category-name').value = '';
      document.getElementById('view-remaining-quantity').value = '';
    }
  });
</script>



 <?php }?>

 <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<!-- Bootstrap Validation Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
