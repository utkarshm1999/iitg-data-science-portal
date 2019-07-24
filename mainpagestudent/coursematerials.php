<?php session_start();
//echo "sem  ".$_SESSION["semester"]."  course". $_SESSION["course"]."     ";

 ?>



 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">


     <!-- Custom fonts for this template -->
     <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

     <!-- Custom styles for this template -->
     <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="css/magnific-popup.css"/>
    <link rel="stylesheet" href="css/animate.css"/>




     <link href="css/resume.min.css" rel="stylesheet">

    <!-- Main Stylesheets -->
     <link rel="stylesheet" href="css/style.css"/>
     <title></title>
   </head>
   <body>
     <hr class="m-0">
     <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="notices">
       <div class="w-100">
         <h2 class="mb-5">Course Materials for <?php echo "Course ID: ".$_SESSION["course"] ?></h2>

     <?php
     $course=$_SESSION["course"];
     $db="ds-portal";
     $host="localhost";
     $dsn= "mysql:host=$host;dbname=$db";
     $conn=new mysqli();
     $conn=new mysqli($host,"root","",$db);
     if($conn->connect_error){
       die("Connection failed: " . $conn->connect_error);
       echo "failed";
     }
     $query="SELECT * FROM assignments WHERE course_id = '$course'";
     try{

       $result=$conn->query($query);
       if ($result->num_rows > 0) {
     // output data of each row
     $count_f=0;
         while($row = $result->fetch_assoc()) {
           $id=$row["id"];
           $count_f++;
           $name=$row["name"];
           ?>


               <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
                 <div class="resume-content">
                   <h3 class="mb-0"> <?php echo "File mumber ".$count_f; ?> </h3>
                   <div class="subheading mb-3">Description</div>
                   <p><a href="coursematerials.php?id=<?php echo urlencode($id); ?>"
                      ><?php echo urlencode($name); ?></a> <br></p>

                 </div>

               </div>

               <?php
         }
       }
       else {
           echo "0 results";
       }
     }
     catch(Exception $e){
       echo "an Exception";
     }

     ?>

   </div>


   <?php
   if (isset($_GET['id'])) {

     $host="localhost";
     $db="ds-portal";
     $dsn= "mysql:host=$host;dbname=$db";
     $conn=new mysqli();
     $conn=new mysqli($host,"root","",$db);
     if($conn->connect_error){
       die("Connection failed: " . $conn->connect_error);
       echo "failed";
     }


       $id = $_GET['id'];
       $query = "SELECT name, type, size, Attachment FROM assignments WHERE id = '$id'";
       $result = mysqli_query($conn,$query) or die('Error, query failed');
       list($name, $type, $size, $content) = mysqli_fetch_array($result);
       header("Content-length: $size");
       header("Content-type: $type");
       header("Content-Disposition: attachment; filename=$name");
       ob_clean();
       flush();
       echo $content;
       mysql_close();
       exit;
   }
   ?>






     </section>
   </body>
 </html>
