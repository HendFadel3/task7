


<?php

require 'helper.php';
//require 'checklogin.php';
require 'dbconection.php';


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
     $errors['Image'] = "Error In Extension";
   }

}

   if(count($errors) > 0){
       foreach ($errors as $key => $value) {
           echo '* '.$key.' : '.$value.'<br>';
       }
   }else{

    

    $desPath = './uploads/'.$FinalName;

   if(move_uploaded_file($tmpPath,$desPath)){

    $sql = "insert into todolist (title,description,startdate,enddate,image) values ('$title','$description','$startdate','$enddate','$FinalName')";
    $op  = mysqli_query($con,$sql);

     if($op){
         echo 'Data Inserted';
         $data = mysqli_fetch_assoc($op);
      $_SESSION['user'] = $data;
         header("Location: tolist.php");

     }else{
         echo 'Error Try Again'.mysqli_error($con);                      
     }
   }else{
   echo 'Error In Uploading file';
   }

   }


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>ToDoList</h2>
 
 
  <form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post"  enctype="multipart/form-data" >

  

  <div class="form-group">
    <label for="exampleInputName">Title</label>
    <input type="text" class="form-control" id="exampleInputName"  name="title" aria-describedby="" placeholder="Enter Name">
  </div>


  <div class="form-group">
    <label for="exampleInputName">Desc</label>
    <input type="text" class="form-control" id="exampleInputName"  name="description" aria-describedby="" placeholder="Enter Name">
  </div>


  <label for="start">Start date:</label>

<input type="date" id="start" name="start"
       value=" "
       min="2021-01-01" max="2030-12-31">


       <label for="start">end date:</label>

<input type="date" id="end" name="end"
       value=" "
       min=" 2021-07-22" max="2030-12-31">








  <div class="form-group">
    <label for="exampleInputPassword">Image</label>
    <input type="file"   name="image" >
  </div>

 
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>