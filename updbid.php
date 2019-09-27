<?php
  require_once "dbConn.php";
  if($_POST["c_bid"]<$_POST["up_bid"]){
    $sql="UPDATE items SET updatedBid='".$_POST["up_bid"]."' WHERE id='".$_POST["itm_id"]."'";
    mysqli_query($conn, $sql);
  }
  mysqli_close($conn);  
  header("Location: afterSignIn.php");
?>