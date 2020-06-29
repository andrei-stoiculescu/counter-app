<?php
// Initialize the session
session_start();
 include_once ('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$currentuser=$_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Counter App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<!-- Navbar start -->
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand">Counter App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModalCenter">About<span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <p class="nav-link">Welcome, <?php echo htmlspecialchars($currentuser);?></p>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log out</a>
            </li>
        </ul>
    </div>
</nav>
<!-- Navbar end -->

<!-- Counter section start-->
<div class="container mt-5">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-6 shadow p-3 mb-5 bg-white rounded text-center">
            <h2>Counter</h2>
                <h1 class="display-1">
                    <?php
                        $sql = "SELECT * FROM users WHERE username='$currentuser'";
                            if($result = mysqli_query($link, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<div>" . $row['counter'] . "</div>";    
                                        }
                                    mysqli_free_result($result);
                                } else{
                                    echo "No records matching your query were found.";
                                    }   
                                } else{
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                    }
                                mysqli_close($link);
                    ?>
                </h1>
            <div>
                <form class="row" action='update.php' method='POST'>    
                    <input class="col mx-2 btn btn-light" type='submit' name='substract' value="-" />
                    <input class="col mx-2 btn btn-outline-danger" type='submit' name='reset' value="Reset" />
                    <input class="col mx-2 btn btn-light" type='submit' name='add' value="+" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Counter section end-->

<!-- About section start -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">About</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This is a simple counter app that I've created in order to improve my php skills. The interface is really straight forward, you just click the buttons to operate the counter, which is automatically saved into your account. Current version is 1.0
      </div>
     
    </div>
  </div>
</div>
<!-- About section end -->

<!-- Footer section start -->
<footer class="container-fluid text-center bg-light" style="position: fixed; left: 0; bottom: 0; width: 100%; text-align: center; font-size: 12px; color: #666">
    <p class="py-2">Developed by h4ck3r_m4n</p>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</footer>
<!-- Footer section end -->

</body>
</html>