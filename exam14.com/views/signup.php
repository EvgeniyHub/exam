<!DOCTYPE >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Exam : Sign up</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
    <form method="post" class="form-signin">
        <h2 class="form-signin-heading">Sign up.</h2><hr />
        <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
        </div>
        <div class="clearfix"></div><hr />
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btn-signup">
            </i>SIGN UP
        </button>
    </div>
    <br />
    <label>have an account ! <a href="start">Sign In</a></label>
</form>
</div>

</body>
</html>