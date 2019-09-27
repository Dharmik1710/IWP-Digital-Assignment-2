<?php
session_start();
?>  

<!DOCTYPE html>  
 <html>  
      <head>
        <style>
          li{
            list-style-type: none;
          }
        </style>
     
        <title>Auction-Add_Item</title>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
      </head> 
      <body>  
           <nav class="navbar fixed-top pl-5 navbar-expand-sm bg-light justify-content-center">

            <!-- Links -->
            <ul class="navbar-nav ml-5">
              <li class="nav-item ml-5">
                <a class="nav-link" href="afterSignIn.php"><button class="btn btn-sm btn-outline-primary">Home</button></a>
              </li>
              <li class="nav-item mx-5">
                <a class="nav-link" href="itm_reg.php"><button class="btn btn-sm btn-outline-primary">Add Item</button></a>
              </li>
            </ul>
            <span class="cm mx-5 h3">Auctions</span>
            <ul class="navbar-nav">
              <span class="navbar-text mx-5"><?php echo $_SESSION["userEmail"];?></span>
              <li class="nav-item mr-5">
                <a class="nav-link float-right" href="logout.php"><button class="btn btn-sm btn-outline-primary">Logout</button></a>
              </li>
            </ul>

          </nav>
           <br><br><br>
        
           <div class="container" style="width:1200px;"> 
             <br>
                <h5 class="text-center mr-5">Add item for auction</h5>  
                <br><br>
                <form method="post" enctype="multipart/form-data" class="container text-center" style="width: 400px;" action="">  
                  <input type="text" name="itmName" placeholder="Item Name" class="form-control"><br>
                  <input type="number" name="bidAmt" placeholder="Bid Amount" class="form-control"><br>
                  <input type="date" name="closeDate" class="form-control"><br>
                  <input type="file" name="image" class="float-left"><br><br><br>
                  <input type="submit" value="Add Item" class="btn btn-primary"><br><br> 
                </form>  
                <br>  
                <br>  
                <table class="table table-bordered">  
                     <tr>  
                          <th class="text-center" colspan="2">Your Auctioned Items</th>  
                          <th class="text-center">Current bidding</th>  
                     </tr>  
                <?php  
                  
                  require_once "dbConn.php";
                  
                  if($_SERVER["REQUEST_METHOD"]=="POST")  
                  {  
                      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
                    
                      $query1 = "INSERT INTO items VALUES ('"."','".$_POST["itmName"]."', '".$_SESSION["userEmail"]."', '".$_POST["closeDate"]."', '".$_POST["bidAmt"]."', '".$file."', '".$_POST["bidAmt"]."')";  
                      if(mysqli_query($conn, $query1))  
                      {  
                        echo '<div class="alert alert-success">
                                <strong>Success!</strong>  Item send for Auction !!
                              </div>';   
                      }  
                  }  

                  $query2 = "SELECT * FROM items WHERE Owner_Name='".$_SESSION["userEmail"]."'";  
                  $result1 = mysqli_query($conn, $query2);  
                  while($row = mysqli_fetch_assoc($result1))
                  {  
                       echo '  
                            <tr class="bg-light">  
                               <td style="width: 150px;">  
                                  <img src="data:image/jpeg;base64,'.base64_encode($row['Img_File'] ).'" height="150" width="150" class="img-thumnail" />
                               </td>
                               <td>
                                <ul>
                                  <li class="d-inline" style="font-size: 30px;">'.$row['Item_Name'].'</li>
                                  <li class="float-right d-inline display-4 px-3"> $'.$row['Bid_Amount'].'</li>
                                  <li class="my-3"><strong>Owner : </strong>'.$_SESSION["userEmail"].'</li>
                                  <li class="my-3"><strong>Closing Date :</strong> '.$row['Closing_Date'].'</li>
                                  
                                </ul>
                              </td>
                              <td style="width: 50px;">
                                <ul>
                                  <li class="float-right d-inline display-4 px-3"> $'.$row['updatedBid'].'</li>
                                </ul>
                              </td>
                          </tr>  
                       ';  
                  } 

                  mysqli_close($conn);
                ?>  
                </table> <br><br> 
           </div>  
      </body>  
 </html>