<?php
include("session.php");
$update = false;
$del = false;
$expenseamount = "";
$expensedate = date("Y-m-d");
$expensecategory = "Entertainment";
$successMessage = "";
// if (isset($_POST['add'])) {
//     $expenseamount = $_POST['expenseamount'];
//     $expensedate = $_POST['expensedate'];
//     $expensecategory = $_POST['expensecategory'];

//     $expenses = "INSERT INTO income (user_id, income,incomedate,incomecategory) VALUES ('$userid', '$expenseamount','$expensedate','$expensecategory')";
//     $result = mysqli_query($con, $expenses) or die("Something Went Wrong!");

//     // Set the success message
//     $successMessage = "Your income added successfully";
// }
if (isset($_POST['add'])) {
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    if ($expensecategory == 'Other') {
        // If "Other" category is selected, retrieve the value from the otherCategory input field
        $otherCategory = $_POST['otherCategory'];
        $expenses = "INSERT INTO income (user_id, income,incomedate,incomecategory) VALUES ('$userid', '$expenseamount', '$expensedate', '$otherCategory')";
    } else {
        $expenses = "INSERT INTO income (user_id, income,incomedate,incomecategory) VALUES ('$userid', '$expenseamount', '$expensedate', '$expensecategory')";
    }

    $result = mysqli_query($con, $expenses) or die("Something Went Wrong!");

    // Set the success message
    $successMessage = "Your income added successfully";
}


if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "UPDATE income SET income='$expenseamount', incomedate='$expensedate', incomecategory='$expensecategory' WHERE user_id='$userid' AND income_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_income.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "UPDATE income SET income='$expenseamount', incomedate='$expensedate', incomecategory='$expensecategory' WHERE user_id='$userid' AND income_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_income.php');
}

if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

    $sql = "DELETE FROM income WHERE user_id='$userid' AND income_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_income.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM income WHERE user_id='$userid' AND income_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['income'];
        $expensedate = $n['incomedate'];
        $expensecategory = $n['incomecategory'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = true;
    $record = mysqli_query($con, "SELECT * FROM income WHERE user_id='$userid' AND income_id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['income'];
        $expensedate = $n['incomedate'];
        $expensecategory = $n['incomecategory'];
    } else {
        echo ("WARNING: AUTHORIZATION ERROR: Trying to Access Unauthorized data");
    }
}
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
                <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> Dashboard</a>
                <a href="add_income.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="plus-square"></span> Add Income</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="plus-square"></span> Add Expenses</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="activity"></span> Manage Expenses</a>
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
                                <a class="dropdown-item" href="profile.phcol-mdp">Your Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container">
                <h3 class="mt-4 text-center">Add Your Daily Income</h3>
                <hr>
                <div class="row ">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="expenseamount" class="col-sm-6 col-form-label"><b>Enter Amount</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $expenseamount; ?>" id="expenseamount" name="expenseamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expensedate" class="col-sm-6 col-form-label"><b>Date</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $expensedate; ?>" name="expensedate" id="expensedate" required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Category</b></legend>
                                    <div class="col-md">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory4" value="Operating Income" <?php echo ($expensecategory == 'Operating Income') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory4">
                                                Operating Income
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory3" value="Non-Operating Income" <?php echo ($expensecategory == 'Non-Operating Income') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory3">
                                                Non-Operating Income
                                            </label>
                                        </div>
                                        <!-- Add an "Other" radio button with an onclick event -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategoryOther" value="Other" <?php echo ($expensecategory == 'Other') ? 'checked' : '' ?> onclick="toggleOtherCategory()">
                                            <label class="form-check-label" for="expensecategoryOther">Other</label>
                                        </div>
                                        <!-- Add a hidden input field for the "Other" category -->
                                        <div class="form-group" id="otherCategoryField" style="display: none">
                                            <label for="otherCategory">Other Category:</label>
                                            <input type="text" class="form-control" id="otherCategory" name="otherCategory" value="<?php echo $otherCategory ?? ''; ?>">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <button class="btn btn-lg btn-block btn-warning" style="border-radius: 0%;" type="submit" name="update">Update</button>
                                    <?php elseif ($del == true) : ?>
                                        <button class="btn btn-lg btn-block btn-danger" style="border-radius: 0%;" type="submit" name="delete">Delete</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-lg btn-block btn-success" style="border-radius: 0%;">Add Income</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12 text-center">
                            <?php if (!empty($successMessage)) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $successMessage; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-3"></div>
                    
                </div>
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
        feather.replace();
    </script>
    <script>
        function toggleOtherCategory() {
        var otherCategoryField = document.getElementById('otherCategoryField');
        var otherCategoryInput = document.getElementById('otherCategory');

        if (document.getElementById('expensecategoryOther').checked) {
            otherCategoryField.style.display = 'block';
            otherCategoryInput.setAttribute('required', 'required'); // Optionally make the field required
        } else {
            otherCategoryField.style.display = 'none';
            otherCategoryInput.removeAttribute('required');
        }
        }
    </script>
</body>
</html>