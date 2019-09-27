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
     
     
     <title>Auctions-home</title>  
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
           <div class="container" style="width:1000px;">
                <br>  
                <br>  
                <table class="table table-bordered">  
                     <tr>  
                          <th class="text-center h5" colspan="2">Auctioned Items</th>  
                     </tr>  
                <?php  
                require_once "dbConn.php";
                $query = "SELECT * FROM items WHERE Owner_Name != '".$_SESSION["userEmail"]."'";  
                $result = mysqli_query($conn, $query);  
                while($row = mysqli_fetch_assoc($result))
                {  
                  $in=$row['Item_Name'];
                     echo '  
                          <tr class="bg-light">  
                               <td style="width: 150px;">  
                                  <img src="data:image/jpeg;base64,'.base64_encode($row['Img_File'] ).'" height="150" width="150" class="img-thumnail" />
                               </td>
                               <td>
                               <ul>
                                  <li class="d-inline" style="font-size: 30px;">'.$row['Item_Name'].'</li>
                                  <li class="float-right d-inline display-4 px-3"> $'.$row['updatedBid'].'</li>
                                  <li class="my-3"><strong>Owner : </strong>'.$row['Owner_Name'].'</li>
                                  <li class="d-inline"><strong>Closing Date :</strong> '.$row['Closing_Date'].'</li>
                                  
                                  <li class="d-inline float-right"><form action="updbid.php" method="post">
                                    <div class="input-group ml-5">
                                      <input type="number" class="form-control form-control-sm col-6" name="up_bid">
                                      <input type="text" class="d-none" name="itm_id" value="'.$row['id'].'">
                                      <input type="number" class="d-none" name="c_bid" value="'.$row['updatedBid'].'">
                                      <span class="input-group-btn">
                                            <input class="btn-sm btn-primary ml-4 px-4" type="submit" value="Bid">
                                       </span>
                                    </div>
                                  </form>
                                  </li>
                                  
                                </ul>
                              </td>
                          </tr>  
                     ';  
                } 
                
                  mysqli_close($conn);
                ?>  
                </table>  
           </div>
      </body>  
 </html>  