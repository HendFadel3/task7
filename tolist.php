<?php 

require 'dbconection.php';
//require 'checklogin.php';



$name = $_GET['name'];
$password =$_GET['password'];

$sql = "select * from todolist where username='$name' and password='$password' ";

$op  = mysqli_query($con,$sql);



?>



<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }

    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>ToList </h1>
            <br>

        </div>



        <a href="register.php">+ Account</a> || <a href="logout.php">LogOut</a>  <br>


        <?php 
           
            if(isset($_SESSION['Message'])){
                echo $_SESSION['Message'];
                
                unset($_SESSION['Message']);


            }
        
        
        ?>





        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>

                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>StartDate</th>
                <th>EndDate</th>
            </tr>

<?php 

while($data = mysqli_fetch_assoc($op)){

?>
    <tr>
       <td><?php echo $data['id'];?></td>
       <td><?php echo $data['title'];?></td>
       <td><?php echo $data['description'];?></td>
       <td><?php echo $data['startdate'];?></td>
       <td><?php echo $data['enddate'];?></td>
       <td>
                    <a href='del.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>

                </td>
            </tr>

<?php 
}
?>
                    <a href='https://localhost/week2/to.php' class='btn btn-danger m-r-1em'>ADDMore</a>

            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
