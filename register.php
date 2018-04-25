<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Lab3">
  <meta name="author" content="Krishna Kafley">
  <title>Lab3 Registration</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src='https://www.google.com/recaptcha/api.js'> </script>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="php/registration.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input class="form-control" name="FirstName" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input class="form-control" name="LastName" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" name= "Email" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="Password1">Password</label>
                <input class="form-control" name="Password1" id="Password1" type="password" placeholder="Password" onkeyup="checkPasswordStrength()">
              </div>
              <div class="col-md-6">
                <label for="Password2">Confirm password</label>
                <input class="form-control" name="Password2" id="Password2" type="password" placeholder="Confirm password">
              </div>
			  
			 
            </div>
          </div>
		  
		  <div class = "g-recaptcha" data-sitekey="6LedN0wUAAAAADBKfjLgv33q35hZr84sscjTaU1N"></div>
		  <input type="submit" class="btn btn-primary btn-block" value = "Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  
  <script type ="text/javascript">
	function checkPasswordStrength(){
		var pass1 = document.getElementById("Password1").value;
		var pass2 = document.getElementById("Password2").value;
		var specialCharacters = "!@#$%^&*_?";
		var message = "";
		for(var i=0; i<pass1.length; i++){
			if(specialCharacters.indexOf(pass1.charAt(i)) < 0) {
				var message = "Please use atleast one of these !@#$%^&*_? characters in your password:";
			}
		}
		if(/[a-z]/.test(pass1)){
			
		}
		if(/[A-Z]/.test(pass1)){
			
		}
		if(/[\d]/.test(pass1)){
			
		}
		if(pass1.length <=8){
			message += "Password must be minumum 8 characters.";
		}
		
		document.getElementById("PSmessage").innerHTML = message;
		
	}
	
	
</body>


</script>

</html>