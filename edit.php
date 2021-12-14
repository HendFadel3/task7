<?php
require 'helper.php';
require 'dbconection.php';


   $id = $_GET['id'];

   $sql = "select * from todolist where id = $id";
   $op   = mysqli_query($con,$sql);

     if(mysqli_num_rows($op) == 1){

        $data = mysqli_fetch_assoc($op);
     }else{

        $_SESSION['Message'] = "Access Denied";
        //header("Location: to.php");
     }


     if($_SERVER['REQUEST_METHOD'] == "POST"){
        $title=clean($_POST['title']);
        $description=clean($_POST['description']);
        $startdate=$_POST['start'];
        $enddate=$_POST['end'];
        $errors=[];
        if(!Validate($title,1))
        {$errors['title']="req";}
         elseif(!Validate($title,3))
        {$errors['title']="Length";}
         if(!Validate($description,1))
        {$errors['descrption']="req";}
        elseif(!Validate($description,3))
        {$errors['descrption']="Length";}
        if(!Validate($startdate,1))
        {$errors['startdate']="req";}
        if(!Validate($enddate,1))
        {$errors['enddate']="req";}
        if(!validate($_FILES['image']['name'],1)){
            $errors['Image'] = "Field Required";
        }else{
            
        $tmpPath    =  $_FILES['image']['tmp_name'];
        $imageName  =  $_FILES['image']['name'];
        $imageSize  =  $_FILES['image']['size'];
        $imageType  =  $_FILES['image']['type'];
        $exArray   = explode('.',$imageName);
        $extension = end($exArray);
        $FinalName = rand().time().'.'.$extension;
        $allowedExtension = ["png",'jpg'];
           if(!validate($extension,5)){
             $errors['Image'] = "Error In Extension";}
           if(count($errors) > 0){
            foreach ($errors as $key => $value) {
                echo '* '.$key.' : '.$value.'<br>'; }
        }
        else{
         $OldImage = $data['image'];
         if(validate($_FILES['image']['name'],1)){
           $desPath = './upload/'.$FinalName;
               if(move_uploaded_file($tmpPath,$desPath)){
               unlink('./upload/'.$OldImage); }
         }
         else{$FinalName = $OldImage; }
          $sql = "update todolist set title = '$title' , description = '$description', startdate='$startdate' ,enddate='$enddate',image = '$FinalName' where id = $id";
          $op  = mysqli_query($con,$sql);
          if($op){ $message =  'Data Updated';}
          else{ $message =  'Error Try Again'.mysqli_error($con); }
        }
     
             $_SESSION['Message'] = $message;
     
     
     }
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>Edit</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
 <h2>Edit ToList</h2>


 <form  action="edit.php?id=<?php echo $data['id'];?>"   method="post" enctype="multipart/form-data">

 

 <div class="form-group">
   <label for="exampleInputName">Title</label>
   <input type="text" class="form-control" id="exampleInputName"  name="title"  value="<?php //echo $data['title'];?>" aria-describedby="" placeholder="Enter title">
 </div>


 <div class="form-group">
   <label for="exampleInputEmail">Descreption</label>
   <input type="text"   class="form-control" id="exampleInputEmail1" name="description" value="<?php echo $data['description'];?>"  aria-describedby="emailHelp" placeholder="Enter desc">
 </div>

 <label for="start">Start date:</label>

<input type="date" id="start" name="start" value="<?php echo $data['startdate'];?>" min="2021-01-01" max="2030-12-31">


       <label for="start">end date:</label>

<input type="date" id="end" name="end" value="<?php echo $data['enddate'];?>" min=" 2021-07-22" max="2030-12-31">

 
 <div class="form-group">
  <label for="exampleInputPassword">Image</label>
  <input type="file"   name="image" >
</div>

<img src="./upload/<?php echo $data['image'];?>" height="80" width="80"><br>
 
 <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>

</body>
</html>


