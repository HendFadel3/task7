<?php 
/// delete ...... 
require 'dbconection.php';
require 'checklogin.php';

require 'helper.php';

$id = $_GET['id'];


if(!validate($id,4)){
    $message =  'Invalid Number';
}else{

   $sql = "select * from todolist where id = $id";
   $op   = mysqli_query($con,$sql);

     if(mysqli_num_rows($op) == 1){
   
 $data = mysqli_fetch_assoc($op);

   $sql = "delete from todolist where id = $id ";
   $op  = mysqli_query($con,$sql);

   if($op){$message = 'raw deleted';}
   else{ $message = 'error Try Again !!!!!! '; }
    }
     else{$message = 'Error In User Id ';}

}

   $_SESSION['Message'] = $message;

   header("Location: tolist.php");


?>

