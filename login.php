<?php
require 'dbconection.php';
require 'helper.php';




if($_SERVER['REQUEST_METHOD'] == "POST"){


$name   = Clean($_POST['name']);
$password = Clean($_POST['password']);

# Validate Email 
if(!validate($name,1)){
  $errors['name'] = "Field Required";
}


# Validate Password 
if(!validate($password,1)){
  $errors['password'] = "Field Required";
}elseif(!validate($password,3)){
 $errors['password'] = "Length Must >= 6 chs";
}

# Validation ...... 
$errors = [];
if(count($errors) > 0){
  foreach ($errors as $key => $value) {
      # code...
      echo '* '.$key.' : '.$value.'<br>';
  }
}else{

  $password = md5($password);
  $sql = "select title,description,startdate,enddate,image from todolist where username = '$name' and password = '$password' ";
  $op = mysqli_query($con,$sql);

    if(mysqli_num_rows($op) == 1){
        
      $data = mysqli_fetch_assoc($op);
    
      $_SESSION['user'] = $data;
      header("Location: tolist.php");


    }else{
        echo 'Error in Email || Password Try Again !!!';
    }


   }


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Login</h2>
 
 
  <form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post"  enctype="multipart/form-data" >

  
  <div class="form-group">
    <label for="exampleInputName">UserName</label>
    <input type="text" class="form-control" id="exampleInputName"  name="name" aria-describedby="" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword">Password</label>
    <input type="password"   class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>

