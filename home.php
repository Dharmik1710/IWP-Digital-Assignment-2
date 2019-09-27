<html>
<head>
     <title>Auctions-signUp</title>  
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
  <nav class="navbar navbar-expand-sm bg-light justify-content-center">

      <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link mx-5" href="home.php">Sign Up</a>
          </li>
          <li class="nav-item h2">Auctions</li>
          <li class="nav-item">
            <a class="nav-link mx-5" href="login.php">Log In</a>
          </li>
        </ul>

  </nav><br>
  <form action="" method="post" class="container justify-content-center" style="width: 400px;">
    <div class="form-group justify-content-center text-center">
      <legend class="mb-5">Sign Up</legend>
      <input class="form-control" type="email" placeholder="Email ID" name="email"><br><br>
      <input class="form-control" type="password" placeholder="Password" name="pswd"><br><br>
      <input class="form-control" type="text" placeholder="Mobile Number" name="mob"><br><br>
      <input type="submit" value="Submit" class="btn btn-primary"><br><br>      
    </div>
  </form>
  <?php
    require_once "dbConn.php";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      $sql = "INSERT INTO registration (Email, Password, MobNo) VALUES ('".$_POST["email"]."', '".$_POST["pswd"]."', '".$_POST["mob"]."')";
      
      if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["userEmail"] = $_POST["email"];
        header("Location: afterSignIn.php");
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }

    mysqli_close($conn);
  ?>
</body>
</html>