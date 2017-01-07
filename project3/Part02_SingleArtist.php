  <!-- 
Student Name: Neelipalayam Masilamani, Archana
Student ID: 1001415817 
Project Name: Database-Driven Web pages
Project No: 3
Due Date: 20-Nov-2016

For database connection,
User Name: "root"    
Password: "";
-->

  <html>
  <head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
 <nav class="navbar navbar-inverse">
     <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Assign1</a>
      </div>  
       <div class="collapse navbar-collapse" id="myNavbar">
       <ul class="nav navbar-nav">
        <li class="active"><a href="default.php">Home</a></li>
        <li><a href="AboutUs.php">About Us</a></li>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages<span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="Part01_ArtistsDataList.php">Artists Data List (Part 1)</a></li>
              <li><a href="Part02_SingleArtist.php?id=19">Single Artist (Part 2)</a></li>
              <li><a href="Part03_ArtistDetails.php?id=394">Single Work (Part 3)</a></li>
              <li><a href="Part04_Search.php">Search (Part 4)</a></li>
            </ul>
        </li>
       </ul>
        <ul class="nav navbar-nav navbar-right">
     <li><a href="#">Neelipalayam Masilamani, Archana</a></li>
      <li><form class="navbar-form navbar-left" role="search">
      <div class="form-group">
       <input name="str1"  id="textbox1" type="text" placeholder="Search Paintings"/> 
        <br>
      </div></li>
       <li>
        <p class="navbar-btn">
        <button name="submit" type="submit" value="submit" class="btn btn-primary">Search</button> 
        </p>
          <?php
          if(isset($_GET['submit']))
          {
            $searcstr1 = $_GET['str1'];
            header("Location:Part04_Search.php?search=title&str1=$searcstr1&str2=&submit=submit");
             exit;
          }
          ?>
         </li>
      </form>
       </ul>
    </div>
  </div>
  </nav>
   <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysql";
    $id=$_GET['id'];
    $url = "http://localhost/project3/images/art/artists/medium/{$id}.jpg";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");

  if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT firstname,lastname,yearofbirth,yearofdeath,nationality,artistlink,details FROM artists where artistid='$id'";


  $result = $conn->query($sql);


  if ($result->num_rows > 0) 
  {
       while($row = $result->fetch_assoc()) 
       {
        $name = $row['firstname']." ".$row['lastname'];
        $details = $row['details'];
        $year = $row['yearofbirth']." - ".$row['yearofdeath'];
        $nationality = $row['nationality'];
        $moreinfo = $row['artistlink'];
       }
      ?>
      <div class="container">
       <h3><?= $name ?></h3></br> 
       <div class="row">
              <div class="col-md-4">
                  <img class="img-thumbnail" src=<?= $url ?> alt="img">
              </div>

              <div class="col-md-6">
                  <p><?= $details ?></p>             
                  <button id="plain" type="button" class="btn btn-primary">
                  <span class="glyphicon glyphicon-heart"></span>     
                  Add to Favourites List
                  </button></br></br></br>
                  <table id="artistdetails">
                  <thead>
                  <tr><td colspan=2>Artist Details</td></tr>
                  </thead>
                  <tbody>
                  <tr><td><strong>Date:</strong></td><td><?= $year ?></td></tr>
                  <tr><td><strong>Nationality:</strong></td><td><?= $nationality ?></td></tr>
                  <tr><td><strong>More Info:</strong></td><td><a href="<?php echo $moreinfo;?>"> <?php echo $moreinfo;?></a></td></tr>
                  </tbody>  
                  </table>
              </div>
  </div></br>
  <h4>Art by <?= $name ?></h4>
 <?php     
  } 
  else 
  {
        header("Location:Error.php");
        exit;
  }
?> 

<?php
  $sqlwork = "SELECT artworkid,imagefilename,title,yearofwork FROM artworks where artistid='$id'";
  $resultsqlwork = $conn->query($sqlwork);
?>

<?php
  if ($resultsqlwork->num_rows > 0) 
  {
?>
<div class = "row">
    <?php while($row = $resultsqlwork->fetch_assoc()) 
       {
        $imagefilename = $row['imagefilename'];
        $title = $row['title'];
        $yearofwork = $row['yearofwork']; 
        $url = "http://localhost/project3/images/art/works/square-medium/{$imagefilename}.jpg";
        $artworkid = $row['artworkid']; 
     ?>

   <div class="col-md-3">
        <div class="thumbnail">
        <a href = "Part03_ArtistDetails.php?id=<?=$artworkid?>"> 
          <img src=<?= $url ?> alt = "SingleWork"> 
          <div class="caption"> 
            <p><?= $title ?></p>
            <a href="Part03_ArtistDetails.php?id=<?=$artworkid?>" class="btn btn-primary" role="button" ><span class="glyphicon glyphicon-info-sign"></span> View</a> 
            <a href="#" class="btn btn-success" role="button"><span class="glyphicon glyphicon-th-large"></span>Wish</a>
            <a href="#" class="btn btn-info" role="button"><span class="glyphicon gglyphicon glyphicon-shopping-cart"></span>  Cart</a>

          </div>
        </div>
      </div>
       <?php 
       }
  } 
  else 
  {
        header("Location:Error.php");
        exit;
  }
  $conn->close(); 
  ?>
    </div>
  </body>
  </html>