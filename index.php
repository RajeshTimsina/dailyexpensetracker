<?php
  include("session.php");
  $exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");

  $in_category_dc = mysqli_query($con, "SELECT incomecategory FROM income WHERE user_id = '$userid' GROUP BY incomecategory");
  $in_amt_dc = mysqli_query($con, "SELECT SUM(income) FROM income WHERE user_id = '$userid' GROUP BY incomecategory");

  $exp_date_line = mysqli_query($con, "SELECT expensedate FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  $exp_amt_line = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");

  $in_date_line = mysqli_query($con, "SELECT incomedate FROM income WHERE user_id = '$userid' GROUP BY incomedate");
  $in_amt_line = mysqli_query($con, "SELECT SUM(income) FROM income WHERE user_id = '$userid' GROUP BY incomedate");

  $total_income = mysqli_query($con, "SELECT SUM(income) FROM income");
  
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Income Expense Manager - Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Feather JS for Icons -->
  <script src="js/feather.min.js"></script>
  <style>
    .card a {
      color: #000;
      font-weight: 500;
    }

    .card a:hover {
      color: #28a745;
      text-decoration: dotted;
    }
  </style>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="border-right" id="sidebar-wrapper">
      <div class="user">
        <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
        <h5><?php echo $username ?></h5>
        <p><?php echo $useremail ?></p>
      </div>
      <div class="sidebar-heading">Management</div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="home"></span> Dashboard</a>
        <a href="add_income.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Income</a>
        <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expenses</a>
        <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="activity"></span> Manage Expenses</a>
        <a href="manage_income.php" class="list-group-item list-group-item-action "><span data-feather="activity"></span> Manage Income</a>
      </div>
      <div class="sidebar-heading">Settings </div>
      <div class="list-group list-group-flush">
        <a href="profile.php" class="list-group-item list-group-item-action "><span data-feather="user"></span> Profile</a>
        <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="power"></span> Logout</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


        <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
          <span data-feather="menu"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="profile.php">Your Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <h3 class="mt-4">Dashboard</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-body">
                <div class="row">
                <div class="col text-center">
                    <a href="add_income.php"><img src="icon/income.jpg" width="57px" />
                      <p>Add Income</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="add_expense.php"><img src="icon/addex.png" width="57px" />
                      <p>Add Expenses</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="manage_expense.php"><img src="icon/maex.png" width="57px" />
                      <p>Manage Expenses</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="manage_income.php"><img src="icon/maex.png" width="57px" />
                      <p>Manage Income</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="profile.php"><img src="icon/prof.png" width="57px" />
                      <p>User Profile</p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col text-center">
                    <?php 
                      $result = mysqli_query($con, "SELECT SUM(income) AS total_income FROM income");

                      // Check if the query was successful
                      if ($result) {
                        // Fetch the result as an associative array
                        $row = mysqli_fetch_assoc($result);

                        // Access the total_income column from the result
                        $totalIncome = $row['total_income'];
                        echo "<h2>Total Income: " . number_format($totalIncome, 2) . "</h2>"; // Format as currency if needed
                      } else {
                        // Display an error message if the query fails
                        echo "Error: " . mysqli_error($con);
                      }
                    
                    ?>
                  </div>
                  <div class="col text-center">
                  <?php 
                      $result = mysqli_query($con, "SELECT SUM(expense) AS total_expense FROM expenses");

                      // Check if the query was successful
                      if ($result) {
                        // Fetch the result as an associative array
                        $row = mysqli_fetch_assoc($result);

                        // Access the total_income column from the result
                        $totalExpense = $row['total_expense'];
                        echo "<h2>Total Expense: " . number_format($totalExpense, 2) . "</h2>"; // Format as currency if needed
                      } else {
                        // Display an error message if the query fails
                        echo "Error: " . mysqli_error($con);
                      }
                    
                    ?>
                  </div>
                  <div class="col text-center">
                  <?php 
                      $result1 = mysqli_query($con, "SELECT SUM(expense) AS total_expense FROM expenses");
                      $result2 = mysqli_query($con, "SELECT SUM(income) AS total_income FROM income");

                      // Check if the query was successful
                      if ($result or $result2) {
                        // Fetch the result as an associative array
                        $row1 = mysqli_fetch_assoc($result1);
                        $row2 = mysqli_fetch_assoc($result2);

                        // Access the total_income column from the result
                        $totalExpense = $row1['total_expense'];
                        $totalIncome = $row2['total_income'];
                        echo "<h2>Profit & Loss: " . number_format($totalIncome-$totalExpense, 2) . "</h2>"; // Format as currency if needed
                      } else {
                        // Display an error message if the query fails
                        echo "Error: " . mysqli_error($con);
                      }
                    
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Start Expense Chart-->
        <h3 class="mt-4">Full-Expense Report</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Yearly Expenses</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_line" height="100"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Expense Category</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_category_pie" height="100"></canvas>
              </div>
            </div>
          </div>
          <!-- <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Expense Category</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_category_pie_chart" height="100"></canvas>
              </div>
            </div>
          </div> -->
        </div>
        <!-- End Expense Chart-->

        <!-- Start Income Chart-->
        <h3 class="mt-4">Full-Income Report</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Yearly Income</h5>
              </div>
              <div class="card-body">
                <canvas id="income_line" height="100"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Income Category</h5>
              </div>
              <div class="card-body">
                <canvas id="income_category_pie" height="100"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- End Income Chart-->


      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.slim.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  <script>
    feather.replace()
  </script>
  <script>
    //Start Expense chart
    var ctx = document.getElementById('expense_category_pie').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php while ($a = mysqli_fetch_array($exp_category_dc)) {
                    echo '"' . $a['expensecategory'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Category',
          data: [<?php while ($b = mysqli_fetch_array($exp_amt_dc)) {
                    echo '"' . $b['SUM(expense)'] . '",';
                  } ?>],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          borderWidth: 1
        }]
      }
    });


    var line = document.getElementById('expense_line').getContext('2d');
    var myChart = new Chart(line, {
      type: 'line',
      data: {
        labels: [<?php while ($c = mysqli_fetch_array($exp_date_line)) {
                    echo '"' . $c['expensedate'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Month (Whole Year)',
          data: [<?php while ($d = mysqli_fetch_array($exp_amt_line)) {
                    echo '"' . $d['SUM(expense)'] . '",';
                  } ?>],
          borderColor: [
            '#adb5bd'
          ],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          fill: false,
          borderWidth: 2
        }]
      }
    });
    //End Expense chart

    //Start Income chart
    var ctx = document.getElementById('income_category_pie').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php while ($a = mysqli_fetch_array($in_category_dc)) {
                    echo '"' . $a['incomecategory'] . '",';
                  } ?>],
        datasets: [{
          label: 'Income by Category',
          data: [<?php while ($b = mysqli_fetch_array($in_amt_dc)) {
                    echo '"' . $b['SUM(income)'] . '",';
                  } ?>],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          borderWidth: 1
        }]
      }
    });

    var line = document.getElementById('income_line').getContext('2d');
    var myChart = new Chart(line, {
      type: 'line',
      data: {
        labels: [<?php while ($c = mysqli_fetch_array($in_date_line)) {
                    echo '"' . $c['incomedate'] . '",';
                  } ?>],
        datasets: [{
          label: 'Income by Month (Whole Year)',
          data: [<?php while ($d = mysqli_fetch_array($in_amt_line)) {
                    echo '"' . $d['SUM(income)'] . '",';
                  } ?>],
          borderColor: [
            '#adb5bd'
          ],
          backgroundColor: [
            '#6f42c1',
            '#dc3545',
            '#28a745',
            '#007bff',
            '#ffc107',
            '#20c997',
            '#17a2b8',
            '#fd7e14',
            '#e83e8c',
            '#6610f2'
          ],
          fill: false,
          borderWidth: 2
        }]
      }
    });
    //End Income chart

  </script>
</body>

</html>