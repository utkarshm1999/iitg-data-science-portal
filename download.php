<html>
    <head>
        <title>Download File From MySQL Database</title>
        <meta http-equiv="Content-Type" content="text/html;
              charset=iso-8859-1">
    </head>
    <body>
        <?php

        $host="localhost";
        $db="ds-portal";
        $dsn= "mysql:host=$host;dbname=$db";
        $conn=new mysqli();
        $conn=new mysqli($host,"root","",$db);
        if($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
          echo "failed";
        }


        $query = "SELECT id, name FROM assignments";
        $result = mysqli_query($conn,$query) or die('Error, query failed');
        if (mysqli_num_rows($result) == 0) {
            echo "Database is empty <br>";
        } else {
            while (list($id, $name) = mysqli_fetch_array($result)) {
                ?>
                <a href="download.php?id=<?php echo urlencode($id); ?>"
                   ><?php echo urlencode($name); ?></a> <br>
                <?php
            }
        }
        $conn->close();
        ?>
    </body>
</html>
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
