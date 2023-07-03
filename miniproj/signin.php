<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="index.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Lora:ital,wght@1,400;1,500;1,600&family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    </head>
    <body>
        <h2 style="color:white;text-align:center;margin-bottom:20px;padding:20px; background-image: linear-gradient(#a849a5,#723cbc)
            ">SignIn and get registered to donate your Books!!</h2>
            <div id="login-sec">
            
                <?php
                    if (isset($_POST["submit"])) {
                    $fullName = $_POST["name"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
           
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    $errors = array();
           
                    if (empty($fullName) OR empty($email) OR empty($password)) {
                    array_push($errors,"All fields are required");
                    }
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                    }
                    if (strlen($password)<8) {
                    array_push($errors,"Password must be at least 8 charactes long");
                    }
           //if (($category !='1-5 ') OR ($category !='6-10 ') OR ($category!='11-12 ') OR ($category !='storybooks')) {
           // array_push($errors,"Please check the category in the home page");
           //}
                    require_once "connect.php";
                    $sql = "SELECT * FROM `login` WHERE `email-id` ='$email'";
                    $result = mysqli_query($conn, $sql);
                    if(!$result)
                    echo "Error executing query: " . mysqli_error($conn);
                    else{
                    $rowCount = mysqli_num_rows($result);
                    if ($rowCount>0) {
                    array_push($errors,"Email already exists!");
                    }
                    if (count($errors)>0) {
                    foreach ($errors as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                    }
                    }
                    else{
            
                    $sql = "INSERT INTO `login` (`username`, `email-id`, `password`) VALUES ( ?, ?, ? )";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.You can login with same credentials</div>";
                    }else{
                    echo "Error executing query: " . mysqli_error($conn);
                    die("Something went wrong");
                    }
                   }
                }
            }
        
            ?>
            <form action="http://localhost:8080/miniproj/signin.php" method="post">
               <p style="text-align:center;">SIGNIN</p>
               <Label>Name:<br>
                 <input type="text" name="name"  placeholder="Name" />
               </Label>
               <br><br>
               <Label>E-mail<br>
                   <input type="email" name="email"  placeholder="E-mail"/>
                </Label>
                <br><br>
                <Label>New Passsword:<br>
                    <input type="password" name="password"  placeholder="Password"/>
                </Label>
                <br><br>
                <p style="text-align:center;" >
                    <input style=" background-image: linear-gradient(#a849a8,#723cbc);border:none;color:white;padding:10px;" type="submit" value="Register" name="submit">
                    <input style=" background-image: linear-gradient(#a849a8,#723cbc);border:none;color:white;padding:10px;" type="reset" value="Clear">
                </p>
            </form>
        
            <p>Already Registered? <a style="font-size:20px;" href="login.php"><u>Login Here</u></a></p>
        </div>
        <br>
        <p style="text-align:center;">
        <button  style=" background-image: linear-gradient(#a849a8,#723cbc);border:none;color:white;padding:10px;" onclick="goBack()">Go Back</button>
        </p>
            <footer>
                <p>&copy;Donate2Elevate.All Rights Reserved
                <a><i style="color:blue" class='fa fa-twitter-square'></i></a>
               <a><i class="fa fa-facebook-square" style="color:blue"></i></a> 
               <a><i class="fa fa-instagram" style="color:rgb(255, 0, 174)"></i></a>
                </p>
            </footer>

            

            <script src="index.js">
               
            </script>
    </body>
    
</html>