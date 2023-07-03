<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: donationpage.php");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="index.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Lora:ital,wght@1,400;1,500;1,600&family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">

    </head>
    <body>
        <h2 style="color:white;text-align:center;margin-bottom:20px;padding:20px; background-image: linear-gradient(#a849a5,#723cbc)
        ">Login to make your donations bravo!!</h2>
            <div id="login-sec" >
                <?php
                    if (isset($_POST["login"])) {
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    require_once "connect.php";
                    $sql = "SELECT * FROM `login` WHERE `email-id`='$email'";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        // Fetch results
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        if ($user) {
                            if (password_verify($password, $user["password"])) {
                                session_start();
                                $_SESSION["user"] = "yes";
                                $_SESSION["var"]=$email;
                                header("Location: donationpage.php");
                                die();
                        }
                        else{
                                    echo "<div class='alert alert-danger'>Password does not match</div>";
                                    }
                                    }else{
                                        echo "<div class='alert alert-danger'>Email does not match</div>";
                                    }
                        }
                        else {
                            echo "Error executing query: " . mysqli_error($conn);
                        }
                    } 
                   
                    ?>
                  
                <form action="login.php" method="post">
                        <p style="text-align:center;">LOGIN</p>
                        <Label>E-mail<br>
                        <input type="email" name="email" placeholder="E-mail" />
                        </Label>
                        <br><br>
                        <Label>Password<br>
                            <input type="password" name="password" placeholder="Password (atleast 8 chars)" />
                         </Label>
                        <br><br>
                        <p>Not registerd?
                        <a style="font-size:15px;" href="signin.php" >SIGNIN</a>
                    </p>
                    <p>OR</p>
                        <a href="#" class="google-btn">
                            <i class="fa fa-google fa-fw"></i> Login with Google
                      </a>
                    <br>
                    <p style="text-align:center;" >
                    <input style=" background-image: linear-gradient(#a849a8,#723cbc);border:none;color:white;" type="submit" name="login" value="Submit"/>
                   </p>
                </form>
            </div>
            <br>
            <footer>
                <p>&copy;Donate2Elevate.All Rights Reserved
                <a><i style="color:blue" class='fa fa-twitter-square'></i></a>
               <a><i class="fa fa-facebook-square" style="color:blue"></i></a> 
               <a><i class="fa fa-instagram" style="color:rgb(255, 0, 174)"></i></a>
                </p>
            </footer>
    </body>
</html>