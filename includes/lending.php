
<?php
session_start();
error_reporting(0);
include('database.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{
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
          <a href="add-expenses.php">
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
          <a href="#" class="active">
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
          <a href="#">
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

    <div class="home-content">
      <div class="overview-boxes">

     
    <div class="col-md-12">
        <br>
        
        <div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6">
        <h4 class="card-title">Add Sales</h4>
        
      </div>
   



    </div>
  </div>
  

  <?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $userid = $_SESSION['detsuid'];
  $name = $_POST['name'];
  $date_of_lending = $_POST['date'];
  $amount = $_POST['amount'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  // Connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "expenditure";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Insert the form data into the database
  $sql = "INSERT INTO lending (name,UserId, date_of_lending, amount, description, status) VALUES ('$name','$userid' ,'$date_of_lending', $amount, '$description', '$status')";
  if (mysqli_query($conn, $sql)) {
    echo '<script type="text/javascript">alert("New sales record created successfully");</script>';
    echo " <script type='text/javascript'>window.location.href = 'manage-lending.php';</script>";

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
}
?>

<div class="card-body">
  <form method="POST">
  <div class="form-group">
  <label for="name">Name:</label>
  <select class="form-control" id="name" name="name" required>
  <option value="">Select Item</option>
    <optgroup label="BREAKFAST">
      <option value="Special tea - 50">Special tea - 50</option>
      <option value="Milk tea - 20">Milk tea - 20</option>
      <option value="Strong tea - 20">Strong tea - 20</option>
      <option value="Nescafe - 30">Nescafe - 30</option>
      <option value="Andazi - 10">Andazi - 10</option>
      <option value="Chapati - 20">Chapati - 20</option>
      <option value="Milk plain 50/100">Milk plain - 50/100</option>
      <option value="Roll eggs plain - 120">Roll eggs plain - 120</option>
      <option value="Omelette plain - 120">Omelette plain - 120</option>
      <option value="Omelette chapati - 140">Omelette chapati - 140</option>
      <option value="Beans plain - 40">Beans plain - 40</option>
      <option value="Beans chapati - 60">Beans chapati - 60</option>
      <option value="Beans mandazi - 60">Beans mandazi - 60</option>
      <option value="Eggs plain - 100">Eggs plain - 100</option>
    </optgroup>
    <optgroup label="DRINKS">
      <option value="Soda 300ml - 50">Soda 300ml - 50</option>
      <option value="Soda 500ml - 70">Soda 500ml - 70</option>
      <option value="Water 500ml - 50">Water 500ml - 50</option>
      <option value="Water 1 litre - 100">Water 1 litre - 100</option>
    </optgroup>
    <optgroup label="LUNCH GREENS">
      <option value="Ugali manangu - 100">Ugali manangu - 100</option>
      <option value="Ugali sukuma - 50">Ugali sukuma - 50</option>
      <option value="Ugali matawi - 50">Ugali matawi - 50</option>
      <option value="Ugali seveve - 50">Ugali seveve - 50</option>
      <option value="Ugali cabbage - 50">Ugali cabbage - 50</option>
      <option value="Ugali kunde - 50">Ugali kunde - 50</option>
      <option value="Ugali mix - 100">Ugali mix - 100</option>
      <option value="Nyama fry - 200">Nyama fry - 200</option>
      <option value="Nyama stew - 200">Nyama stew - 200</option>
      <option value="Matumbo fry - 160">Matumbo fry - 160</option>
      <option value="Matumbo stew - 150">Matumbo stew - 150</option>
      <option value="Boil nusu - 150">Boil nusu - 150</option>
      <option value="Boil full - 200">Boil full - 200</option>
      <option value="Vifirigisi - 150">Vifirigisi - 150</option>
      <option value="Ugali kuku - 400">Ugali kuku - 400</option>
      <option value="Kuku plain - 370">Kuku plain - 370</option>
      <option value="Ugali mayai - 150">Ugali mayai - 150</option>
      <option value="Nyama plain - 170">Nyama plain - 170</option>
      <option value="Smoked/shiangoo nusu - 150">Smoked/shiangoo nusu - 150</option>
      <option value="Smoked full - 200">Smoked full - 200</option>
      <option value="Kuku fry - 400">Kuku fry - 400</option>
      <option value="Ugali Fish fried - 200">Ugali Fish fried - 200</option>
      <option value="Ugali Fish stew - 200">Ugali Fish stew - 200</option>
    </optgroup>
  </select>
</div>
  
    <div class="form-group">
      <label for="date">Date of Sales:</label>
      <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <div class="form-group">
      <label for="amount">Total Amount:</label>
      <input type="number" class="form-control" id="amount" name="amount" required>
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea class="form-control" id="description" name="description" maxlength="250" required></textarea>
      <small class="form-text text-muted">Maximum 250 characters.</small>
    </div>
    <div class="form-group">
      <label for="status">Status:</label>
      <select class="form-control" id="status" name="status" required>
        <option value="pending">Paid cash</option>
        <option value="received">Paid M-PESA</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
  </form>
</div>



  </section>




  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

  <?php }?>