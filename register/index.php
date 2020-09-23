<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br>
    <br>
    <div class="container text-center">
        <h1>Forum XYZ</h1>
    </div>
    <div class="container">
        <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Register</h5>
                <form class="form-signin" action="register.php" method="post" onsubmit="return passwordValidation()">
                <div class="form-label-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
                </div>

                <div class="form-label-group">
                    <label for="pasword">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-label-group">
                    <label for="pasword_confirmation">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>

                <br>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</body>
<script>
    function passwordValidation(){
        var pass = document.getElementById("password").value;
        var pass2 = document.getElementById("password_confirmation").value;

        if (pass == pass2 ){
            return true;
        } else {
            alert('Password must match !');
            return false;
        }
    }
</script>
</html>