<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Dashboard - Book Donation Website</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Lora:ital,wght@1,400;1,500;1,600&family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<div align=center>
            
			<h2 >Welcome to your home page ,dear user!</h2>
			<a style="background-color:#bc85be; margin-left:70%; margin-top:20%;" href="logout.php">Logout</a>
            <br>
	
		</div>
	</header>
	<!--<h3 align=center> No of your donations:</h3>-->
    <h2>Please fill these details so that we could collect from your destination!</p>
	<p id="count"></p>
	<div id="login-sec" align=center>
		<form action="donationpage.php" method="POST">
            <Label>Name<br>
            <input type="text" name="name" placeholder="Name" />
        	</Label>
            <br><br>
			<Label>Address<br>
            <input type="text" name="addr" placeholder="address" />
        	</Label>
			<br><br>
			<Label>Phone<br>
            <input type="varint" name="phone" placeholder="Phone" />
    		</Label>
			<br><br>	
			<Label>Name of the book<br>
            <input type="text" name="bookname" placeholder="Bookname" />
        	</Label>
			<br><br>
            <Label>Book Category:<br>
                   <input type="text" name="category"  placeholder="Book Category"/><br>
                   (Please check the different categories (1-5)/(6-10)/(11-12)/(storybooks) )
            </Label>
               <br>
			<input type="submit" value="Finish" name="donate"/>
    	</form>
        
	</div>
    <?php
    if(isset($_POST["donate"])){
        $nam= $_POST["name"];
     echo "Recieved ur details! ".$nam."<br>";
    }
    ?>
    <div align=center>
      <h2>Would you like to deliver to our location??</h2>
       <p id="login-sec">Contact us :9876543456<br><br>
       Address:Marathalli second stage,Bangalore-560037
       </p>   
    </div>

	<div align=center>
      <h2>What we do with the books??</h2>
	  <img src="bookimages/cycle.png" width="700px" />
    </div>

    <div align=center>
      <h2>Your last donation tracking details:</h2>
       <section id="login-sec">
           
            <?php
              $arr=array();
              $c=0;
               if (isset($_POST["donate"])) {
                $name= $_POST["name"];
                $add=$_POST["addr"];
                $bname=$_POST["bookname"];
                $bcat=$_POST["category"];
                $phone=$_POST["phone"];
                require_once "connect.php" ;
                $re=mysqli_query($conn,"SELECT *  FROM `book` WHERE `name`='$name'") ;
                 $b=mysqli_fetch_row($re);
                 if(!$b) {
                $res=mysqli_query($conn,"INSERT INTO `book`  VALUES ( '$name','$add','$bname',' ',' ',' ' ,'$phone' ,' $bcat')");
                
                if(! $res) mysqli_error($conn);
                echo "Recieved ur details! ".$name."<br>";
                array_push($arr, $name);
                 }
                 else{
                    array_push($arr, $name);
                 }
              }
              echo "Collected:";
              
              $s=sizeof($arr);
              $as=$s-1;
              if($s!= 0){
              require_once "connect.php" ;
              $r=mysqli_query($conn,"SELECT *  FROM `book` WHERE `name`='$arr[$as]'  and `Collected`='Yes'");
              $a=mysqli_fetch_row($r);
              if(!$a) {echo("no");
              }
              else{
             
              if($a[3]=='Yes')
                echo "yes <br>";
                else
                echo "No <br>";
              }
              }
              echo "Dispatched: ";
              if($s!= 0){
                require_once "connect.php" ;
                $r=mysqli_query($conn,"SELECT *  FROM `book` WHERE `name`='$arr[$as]'  and `Dispatched`='Yes'");
                $a=mysqli_fetch_row($r);
                if(!$a) {echo("no");
                }
                else{
               
                if($a[3]=='Yes')
                  echo "yes <br>";
                  else
                  echo "No <br>";
                }
                }
               echo "Distributed to: " ;
               if($s!= 0){
                require_once "connect.php" ;
                $r=mysqli_query($conn,"SELECT *  FROM `book` WHERE `name`='$arr[$as]'  and `Distributed`!=' '");
                $a=mysqli_fetch_row($r);
                if(!$a) {echo("no");
                }
                else{
               
                if($a[5]!=' ')
                  echo " ".$a[5]."<br>";
                  else
                  echo "No <br>";
                }
                }
            ?>
        

       </section>   
    </div>

	</div>
	<h2>Categories of Books we take!</h2>
		<div  id="category-sec" class="category">
                     
		<section class="book-img">
                     <a href="p.html" ><img src=" ./bookimages/1-5books.jpg" class="main-img"alt="book" width="200px" height="300px"/>
                     <p>Primary Ncert books </p>
                      <p> Class: 1-5</p></a>
					  
                     </section>
                     <section class="book-img">
                     <a href="s.html" ><img src=" ./bookimages/6-10books.jpg" class="main-img"alt="book" width="200px" height="300px"/>
                     <p>Secondary Ncert books  </p>
                        <p>Class: 6-10</p>
                      </a>  
                     </section>
                     <section class="book-img">
                     <a href="ss.html"><img src=" ./bookimages/12phy.jpg" class="main-img" alt="book" width="200px" height="300px"/>
                     <p>Senior-Secondary books</p>
                     <p>  Class: 11-12</p>
                     </a>
                     </section>
                     <section class="book-img">
                     <a href="#gal"><img src=" ./bookimages/storybooks.jpg" class="main-img"alt="book" width="200px" height="300px"/>
                     <p>Story books</p>
                     </a>
            </section>
            
          </div>
	
	
		  <footer>
                <p>&copy;Donate2Elevate.All Rights Reserved
                <a><i style="color:blue" class='fa fa-twitter-square'></i></a>
               <a><i class="fa fa-facebook-square" style="color:blue"></i></a> 
               <a><i class="fa fa-instagram" style="color:rgb(255, 0, 174)"></i></a>
                </p>
            </footer>
        </body>
        </html>
