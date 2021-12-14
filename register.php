<?php 

 require 'helper.php';
 require 'dbconection.php';






if($_SERVER['REQUEST_METHOD'] == "POST"){

 // CODE ...... 
 $name     = Clean($_POST['name']);
 $email    = Clean($_POST['email']);
 $password = Clean($_POST['password']);


 # Validation ...... 
 $errors = [];

 # Validate Name 
 if(!validate($name,1)){
     $errors['Name'] = "Field Required";
 }


 # Validate Email 
 if(!validate($email,1)){
     $errors['Email'] = "Field Required";
 }elseif(!validate($email,2)){
    $errors['Email'] = "Invalid Email Format";
 }


  # Validate Password 
  if(!validate($password,1)){
     $errors['password'] = "Field Required";
 }elseif(!validate($password,3)){
    $errors['password'] = "Length Must >= 6 chs";
 }

 if(count($errors) > 0){
    foreach ($errors as $key => $value) {
       
        echo '* '.$key.' : '.$value.'<br>';
    }
}else{

 

 $password = md5($password);   

 $sql = "insert into todolist (username,email,password) values ('$name','$email','$password')";
 $op  = mysqli_query($con,$sql);

  if($op){
      echo 'Data Inserted';
      header("Location: to.php");

  }else{
      echo 'Error Try Again'.mysqli_error($con); 
                         
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
  <h2>Register</h2>
 
 
  <form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post"  enctype="multipart/form-data" >

  

  <div class="form-group">
    <label for="exampleInputName">Name</label>
    <input type="text" class="form-control" id="exampleInputName"  name="name" aria-describedby="" placeholder="Enter Name">
  </div>


  <div class="form-group">
    <label for="exampleInputEmail">Email address</label>
    <input type="email"   class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword">New Password</label>
    <input type="password"   class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
  </div>




  

 
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>