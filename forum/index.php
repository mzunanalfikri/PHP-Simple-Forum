<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum XYZ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        // mengaktifkan session
        session_start();
        
        // cek apakah user telah login, jika belum login maka di alihkan ke halaman login
        if($_SESSION['status'] !="login"){
            header("location:../index.php");
        }

    ?>

    <div class="container">
        <br><br>
        <h1 class="text-center">Welcome to XYZ Forums</h1>
        <div class="text-center">
            <a href="logout.php" class="btn btn-danger ">Logout</a>
        </div>
        <br>
        <h3>Add post :</h3>
        <div class="text-center">
            <form action="add_post.php" class="form-group" id="post" method="POST" onsubmit="return validasiPost()">
                <textarea name="message" class="form-control" id="message" cols="30" rows="7"></textarea>
                <br>
                <input class="col-md-8 btn btn-lg btn-primary " type="submit" form="post" value="Add">
            </form>
        </div>
    </div>

    <div>
        <?php
            include '../config.php';

            $query = "select * from post where id=id_parent order by time desc";
            $posts = mysqli_query($db, $query);
            $num_row = mysqli_num_rows($posts);
            if ( $num_row === 0){
                echo"
                <br>
                <div class=\"container text-center\">
                    <h3>No Posts Available</h3>
                </div>
                ";
            } else {
                foreach($posts as $post){
                    $id = (int)$post["id"];
                    $username = $post["username"];
                    $message = $post["message"];
                    $time = $post["time"];
                    $fc = $username[0];

                    echo "
                    <div class=\"container\">
                        <div class=\"container-fluid mt-100\">
                            <div class=\"row\">
                                <div class=\"col-md-12\">
                                    <div class=\"card mb-4\">
                                        <div class=\"card-header\">
                                            <div class=\"media flex-wrap w-100 align-items-center\"> 
                                                <div data-letters=\"$fc\" class=\"\"></div>
                                                <div class=\"media-body ml-3\"> <a href=\"javascript:void(0)\" data-abc=\"true\">$username</a>
                                                    <div class=\"text-muted small\">$time</div>
                                                </div>
                                                <!-- <div class=\"text-muted small ml-3\">
                                                    <div>Member since <strong>01/1/2019</strong></div>
                                                    <div><strong>134</strong> posts</div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class=\"card-body\">
                                            <p> 
                                                $message
                                            </p>
                                        </div>
                                        <div class=\"card-footer actionBox\">
                    ";

                    // for
                    $reply_query = "select * from post where id_parent<>id and id_parent=$id";
                    $replys = mysqli_query($db, $reply_query);

                    foreach ($replys as $reply) {
                        $username = $reply["username"];
                        $message = $reply["message"];
                        $time = $reply["time"];
                        $fc = $username[0];

                        echo "
                            <!-- <h6>Comments :</h6> -->
                            <ul class=\"commentList\">
                                <li>
                                    <div class=\"commenterImage\">
                                        <p data-letters=\"$fc\"></p>
                                    </div>
                                    <div class=\"commentText\">
                                        <p><b>$username</b></p>
                                        <p class=\"\">$message</p> <span class=\"date sub-text\">$time</span>
                    
                                    </div>
                                </li>
                            </ul>
                        ";
                    }

                    echo "
                                            <form action=\"add_reply.php?id=$id\" class=\"form-inline\" role=\"form\" id=\"reply$id\" method=\"POST\">
                                                <div class=\"form-group\">
                                                    <input class=\"form-control\" name=\"reply\" type=\"text\" placeholder=\"Your comments\" required/>
                                                </div>
                                                <div class=\"form-group\">
                                                    <button class=\"btn btn-primary\" for=\"reply$id\">Add</button>
                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                }
            }
        ?>
    </div>

    <?php
        if (array_key_exists("success", $_GET)){
            $success = $_GET["success"];
        } else {
            $success = "";
        }
        if ($success === "post_success"){
            echo "<script>alert('Post berhasil di post')</script>";
        } else if ($success === "post_fail"){
            echo "<script>alert('Post gagal di post')</script>";
        } else if ($success === "reply_success"){
            echo "<script>alert('Reply berhasil')</script>";
        } else if ($success === "reply_fail"){
            echo "<script>alert('Reply gagal')</script>";
        }
    ?>
</body>

<script type = "text/javascript">
    function validasiPost(){
        var message = document.getElementById("message").value;
        if (message != "" ){
            return true;
        } else {
            alert('Pesan tidak boleh kosong !');
            return false;
        }
    }
</script>
</html>