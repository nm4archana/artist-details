"<html>
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
       <li><a href="#">Archana Neelipalayam Masilamani</a></li>
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
  
  $sql = "select aw.msrp as msrp,aw.artistid as artistid,art.FirstName as FirstName,aw.originalhome as home,aw.width as width, aw.height 
  as height, aw.medium as medium, aw.yearofwork as yearofwork,art.LastName as LastName,aw.title as title,
  aw.description as description,aw.imagefilename as imagefilename from artworks aw inner join artists art on 
  aw.ArtistID=art.ArtistID where artworkid='$id'";

  $result = $conn->query($sql);


  if ($result->num_rows > 0) 
  {
       while($row = $result->fetch_assoc()) 
       {
        $artistid = $row['artistid'];
        $name = $row['FirstName']." ".$row['LastName'];
        $title = $row['title'];
        $description = $row['description'];
        $imagefilename = $row['imagefilename'];
        $url = "http://localhost/project3/images/art/works/medium/{$imagefilename}.jpg";
        $msrp = $row['msrp'];
        $yearofwork = $row['yearofwork'];
        $medium = $row['medium'];
        $width = $row['width'];
        $height = $row['height'];
        $originalhome = $row['home'];
      ?>
      <div class="container">
       <h3><?= $title ?></h3> 
       <p>By <a href="Part02_SingleArtist.php?id=<?=$artistid?>"><?= $name ?></a></p></br>
          <div class="row">
              <div class="col-md-4">
                  <img class="img-thumbnail" data-toggle="modal" data-target="#imgmodal" src=<?= $url ?> alt="img">
                  <div class="modal fade" id="imgmodal" role="dialog">
                  <div class="modal-dialog">
    
                  <div class="modal-content">
                 <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title"><?= $title ?> (<?= $yearofwork ?>) by <?= $name ?></h4>
                  </div>
                 <div class="modal-body">
                  <img class="img-thumbnail" src=<?= $url ?> alt="img" style="width: 100%; height: 100%;">
                 </div>
                  <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
              </div>

              <div class="col-md-6">
                  <p><?= $description ?></p>   
                  <h4>$<?php echo number_format($msrp,2);?></h4>           
                  <button id="plain"  type="button" class="btn btn-primary">
                  <span class="glyphicon glyphicon-gift"></span>     
                  Add to Wish List
                  </button>
                  <button id="plain" type="button" class="btn btn-primary">
                  <span class="glyphicon glyphicon-shopping-cart"></span>     
                  Add to Shopping Cart
                  </button>
                  </br></br></br>
                  <table id="productdetails">
                  <thead>
                  <tr><td colspan=2>Product Details</td></tr>
                  </thead>
                  <tbody>
                  <tr><td><strong>Date:</strong></td><td><?= $yearofwork ?></td></tr>
                  <tr><td><strong>Medium:</strong></td><td><?= $medium ?></td></tr>
                  <tr><td><strong>Dimensions:</strong></td><td><?= $width ?>cm x <?= $height ?>cm</td></tr>
                  <tr><td><strong>Home:</strong></td><td><?= $originalhome ?></td></tr>
  <?php 
   $sqlgenre = "SELECT genreid FROM `artworkgenres` WHERE artworkid='$id'";

  $resultgenre = $conn->query($sqlgenre);

  $genreidarray = array();
  $genrenamearray = array();
  if($resultgenre->num_rows > 0)
  {
    while($row = $resultgenre->fetch_assoc()) 
         {
          $genreidarray[] = $row['genreid'];
         }
  }

  foreach ($genreidarray as &$value) 
  { 

   $sqlgenrename = "SELECT genrename FROM `genres` WHERE genreid='$value'";
   $resultgenrename = $conn->query($sqlgenrename);
  
   if($resultgenrename->num_rows > 0)
    {
       while($rowname = $resultgenrename->fetch_assoc()) 
       {
        $genrenamearray[] = $rowname['genrename'];

       }
    }
    }
    ?>
<tr><td><strong>Genres:</strong></td><td>
<?php
foreach ($genrenamearray as &$value) 
{
  echo "<a>$value</a></br>";
}

?></td></tr>

<?php 
  $sqlsub = "SELECT subjectid FROM `artworksubjects` WHERE artworkid='$id'";

  $resultsub = $conn->query($sqlsub);

  $subidarray = array();
  $subamearray = array();
  if($resultsub->num_rows > 0)
  {
    while($row = $resultsub->fetch_assoc()) 
         {
          $subidarray[] = $row['subjectid'];
         }
  }
  foreach ($subidarray as &$value) 
  { 

   $sqlsubname = "SELECT subjectname FROM subjects where subjectid='$value'";
   $resultsubname = $conn->query($sqlsubname);
  
   if($resultsubname->num_rows > 0)
    {
       while($rowname = $resultsubname->fetch_assoc()) 
       {
        $subnamearray[] = $rowname['subjectname'];

       }
    }
    }
    ?>
<tr><td><strong>Subjects:</strong></td><td>
<?php
foreach ($subnamearray as &$value) 
{
  echo "<a>$value</a></br>";
}

?></td></tr>
                  </tbody>  
                  </table>
                </div>

              <div class="col-md-2">
                <?php 

                    $sqlorderarray = array();
                    $sqlorder = "SELECT DATE_FORMAT(datecreated,'%m/%d/%Y') as datecreated FROM orders WHERE orderid in(select orderid from orderdetails where artworkid='$id')";
                    $resultorder = $conn->query($sqlorder);
  
                    if($resultorder->num_rows > 0)
                    {
                     while($rowname = $resultorder->fetch_assoc()) 
                      {
                        $sqlorderarray[] = $rowname['datecreated'];

                      }
                    }
                ?>
              <table id="sales">
                <thead>
                   <tr><th>Sales</th></tr>
                </thead>
                <tbody>       
                    <?php
                  foreach ($sqlorderarray as &$value) 
                  {?>
                 <tr><td><a>
                  <?php
                   echo "$value"."</br></br>";
                   ?>
                    </a></td> </tr>
                    <?php
                  }?>                 
                </tbody>
              </table>
              </div>
              </div></br>
              </div>
 <?php     
  } }
  else 
  { 
        header("Location:Error.php");
        exit;
  }
$conn->close(); 
?>
</body>
</html>