

<!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <meta name="description" content="">
     <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
     <meta name="generator" content="Jekyll v3.8.5">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

     <title>IITG DATA SCIENCE</title>

     <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

     <!-- Bootstrap core CSS -->



     <style>
       .bd-placeholder-img {
         font-size: 1.125rem;
         text-anchor: middle;
         -webkit-user-select: none;
         -moz-user-select: none;
         -ms-user-select: none;
         user-select: none;
       }

       @media (min-width: 768px) {
         .bd-placeholder-img-lg {
           font-size: 3.5rem;
         }
       }
     </style>
     <!-- Custom styles for this template -->
     <link href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" rel="stylesheet">
   </head>
   <body class="text-center">

     <form class="form-signin" action="index.php"  method="POST">
   <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
   <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
   <label for="inputEmail" class="sr-only">Email address</label>
   <input  id="inputEmail"  name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
   <label for="inputPassword" class="sr-only">Password</label>
   <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
   <?php
   $pwd="";
   $username="";
   $_SESSION["logon"]=false;

     if($_SERVER["REQUEST_METHOD"]=="POST"){
       $pwd="";
       $username="";

       $username = $_POST['inputEmail'];
       $pwd=$_POST["inputPassword"];
       $host="localhost";
       $db="ds-portal";
       $dsn= "mysql:host=$host;dbname=$db";
       $conn=new mysqli();
       $conn=new mysqli($host,"root","",$db);
       if($conn->connect_error){
         die("Connection failed: " . $conn->connect_error);
         echo "failed";
       }
     //  echo $username."  ".$pwd;
     //  echo $conn;
       $query="SELECT password,usertype,semester,userid FROM users WHERE userid='$username'";



       try{

         $result=$conn->query($query);
         $res_pwd=mysqli_fetch_assoc($result);
        // echo "student".md5("student");

         $pwd=md5($pwd);
         //echo "  yea  $hashed_input";
       //  echo "res pwd is ".$res_pwd["password"]." and pwd is ".$pwd;
         if($res_pwd["password"]==$pwd){


           if($res_pwd["usertype"]=="staff"){
             header("Location:mainpagestaff");
             session_start();

             $_SESSION["userid"]=$res_pwd["userid"];
             $_SESSION["logon"]=true;


             exit();
           }
           else if($res_pwd["usertype"]=="faculty"){
             header("Location:mainpagefaculty");
             session_start();

             $_SESSION["userid"]=$res_pwd["userid"];
             $_SESSION["logon"]=true;


             exit();
           }
           else if($res_pwd["usertype"]=="student"){
            session_start();

             $_SESSION["semester"]=$res_pwd["semester"];
             $_SESSION["userid"]=$res_pwd["userid"];
             $_SESSION["logon"]=true;


            // echo $res_pwd["semester"];
             header("Location:mainpagestudent");

             exit();

           }


         }
         else{
           $error_val="**Invalid password or Username";

           ?>

           <label > <?php echo $error_val; ?> </label>
         <?php

         }
       }
       catch(Exception $e){
         echo "error is".$e;
       }

       $conn->close();


     }
     /*  try{
         $conn = new PDO($dsn, "root", "");
         try{
           $id=$conn->exec($query);
           echo $id;
         }
         catch(Exception $e){
           echo "error in fetching ".$e->getMessage();
         }




       }
       catch(PDOException $e){
           echo "error in login ".$e->getMessage();
       }*/


     //  echo "hey, $username" ;






    ?>

   <br><br>

   <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
 </form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </body>
 </html>
