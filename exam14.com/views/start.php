<!DOCTYPE >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Exam: Login</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

  <link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>	         
 <form class="form-signin" method="post" id="login-form">

  <h2 class="form-signin-heading">Log In in my exam</h2><hr />

 <div class="form-group">
  <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or Email ID" required />
  <span id="check-e"></span>
</div>
<div class="form-group">
  <input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
</div>

<hr />

<div class="form-group">
  <button type="submit" name="btn-login" class="btn btn-default">
   SIGN IN
 </button>
</div>  
<br />
<label>Don't have account yet ! <a href="sign-up">Sign Up</a></label>
</form>
</body>
</html>