<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD']=="POST") {

    if (isset($_POST['submit'])) {
  
        function validate_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
      
        $book_id=validate_input($_POST['book_id']);
     
        
        $sql="SELECT * FROM book WHERE b_id='$book_id';";
        $result= mysqli_query($con, $sql);
        $result=mysqli_fetch_assoc($result);
        var_dump($result);
         $iss_id=$result['issued_id'];

         $sql="SELECT * FROM issue_book WHERE issue_id='$iss_id';";
         $result= mysqli_query($con, $sql);
         $result=mysqli_fetch_assoc($result);
         var_dump($result);

         if($result['status']==1)
         {
            echo "<script>alert('Renew Limit over'); window.location.href='renew_book.php';</script>";
         }
         else{
            $sql="UPDATE `issue_book` SET status=1 WHERE issue_id=$iss_id";
            if (mysqli_query($con, $sql)) {
    
                echo "<script>alert('Book Renewed'); window.location.href='renew_book.php';</script>";
    
             
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
         }
       


      
    }
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Renew book</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
  <div class="nav">
           <div style="padding-left:10px">
           <a href="admin_home.php">

<h2>LMS</h2>
</a>
           </div>
           <div >
     <a class="nav-item" href="add_book.php">Add Books</a>
        <a class="nav-item" href="search_book.php">Search Books</a>
        <a class="nav-item" href="issue_book.php">Issue Books</a>
    
        <a class="nav-item" href="return_book.php">Return Books</a>
     </div>

       </div>
    <div class="container">
      <h3>Renew Book</h3>
      <form action="renew_book.php" method="post" class="form">
     
        <input
          type="text"
          required
          class="ip-item"
          name="book_id"
        
          id=""
          placeholder="Book ID"
        />
     
        <button class="btn" type="submit" name="submit">Renew Book</button>
      </form>



    

    </div>
  </body>
