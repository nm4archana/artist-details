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
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

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
       <input name="strn"  id="textbox" type="text" placeholder="Search Paintings"/> 
        <br>
      </div></li>
       <li>
        <p class="navbar-btn">
        <button name="submittop" type="submit" class="btn btn-primary">Search</button> 
        </p>
         </li>
    </form>
     </ul>
  </div>
</div>
</nav>
<div class="container">
<h3>Search Results</h3><hr>

<div class="jumbotron">

<form method="get"> 
<input type="radio" name="search" value="title" onclick="titleFunction()"> Filter By Title<br>  
<input size="150" name="str1" id="textbox1"  style="display: none" type="text"/> <br>
<input type="radio" name="search" value="description" onclick="descFunction()"> Filter By Description<br>
<input size="150" name="str2" id="textbox2" style="display: none" type="text" /> <br>
<input type="radio" name="search" value="nofilter" onclick="nofilterFunction()"> No Filter (show all art works)<br><br>
<button name="submit" type="submit" value="submit" class="btn btn-primary">Filter</button> 
</form>
<script type="text/javascript">

$(function() {
    $('input[name="search"]').on('click', function() {
        if ($(this).val() == 'title') {
            $('#textbox1').show();
            $('#textbox2').hide();
        } });
});

$(function() {
    $('input[name="search"]').on('click', function() {
        if ($(this).val() == 'description') {
            $('#textbox1').hide();
            $('#textbox2').show();
        }
    });
});
</script>
</div>
</div>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysql";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");

  if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
  } 

   if(!empty($_GET['search'])&&(isset($_GET['submit'])&&$_GET['search']=="title"&&!empty($_GET['str1']))||(isset($_GET['submittop'])&&!empty($_GET['strn'])))
   {
    if(isset($_GET['submit']))
    {
    $searchstr1 = $_GET['str1'];
    }
    if(isset($_GET['submittop']))
    {
       $searchstr1 = $_GET['strn']; 
    }
    $sqltitle = "select imageFileName,title,description,artworkid from `artworks` WHERE upper(title) like upper('%{$searchstr1}%')";
    $resulttitle = $conn->query($sqltitle);

    if ($resulttitle->num_rows > 0) 
    {
     while($row = $resulttitle->fetch_assoc()) 
         {
          $imageFileName = $row['imageFileName'];
          $title = $row['title'];
          $description = $row['description'];
          $url = "http://localhost/project3/images/art/works/square-medium/{$imageFileName}.jpg";
          $artworkid = $row['artworkid'];
   ?>
   <div class="container">
     <div class="col-md-2">
     <img class="img-thumbnail"src=<?= $url ?> alt="img">
    </div>
     <div class="col-md-10">
     <p><a href="Part03_ArtistDetails.php?id=<?=$artworkid?>"><?= $title ?></a></p>
      <p><?= $description ?></p>
       </div>
   </div></br>
   <?php
       }
   } 
 }  
    if(!empty($_GET['search'])&&isset($_GET['submit'])&&$_GET['search']=="description"&&!empty($_GET['str2']))
    {


    function highlightTerms($searchString, $descr){

      $descriptions = array($descr, $descr);

    foreach ($descriptions as $desc)
    {
            $desc = preg_quote($desc);
            $searchString = preg_replace("/\b($desc)\b/i", '<span class="highlight">\1</span>', $searchString);
    }
          return  $searchString;
    }


    $searchstr2 = $_GET['str2'];
    $sqltitle = "select imageFileName,title,description,artworkid from `artworks` WHERE upper(description) like upper('%{$searchstr2}%')";
    $resulttitle = $conn->query($sqltitle);

  if ($resulttitle->num_rows > 0) 
  {
     while($row = $resulttitle->fetch_assoc()) 
         {
          $imageFileName = $row['imageFileName'];
          $title = $row['title'];
          if(!empty($searchstr2))
          $description = highlightTerms($row['description'],$searchstr2);
        else
          $description = "";
          $url = "http://localhost/project3/images/art/works/square-medium/{$imageFileName}.jpg";
          $artworkid = $row['artworkid'];
   ?>
   <div class="container">
     <div class="col-md-2">
     <img class="img-thumbnail"src=<?= $url ?> alt="img">
    </div>
     <div class="col-md-10">
     <p><a href="Part03_ArtistDetails.php?id=<?=$artworkid?>"><?= $title ?></a></p>
      <p><?= $description ?></p>
       </div>
   </div></br>
   <?php
       }
   } 
 }
   else if(!empty($_GET['search'])&&isset($_GET['submit'])&&$_GET['search']=="nofilter"){ 
    $sqltitle = "select imageFileName,title,description,artworkid from `artworks` WHERE 1";
    $resulttitle = $conn->query($sqltitle);

  if ($resulttitle->num_rows > 0) 
  {
     while($row = $resulttitle->fetch_assoc()) 
         {
          $imageFileName = $row['imageFileName'];
          $title = $row['title'];
          $description = $row['description'];
          $url = "http://localhost/project3/images/art/works/square-medium/{$imageFileName}.jpg";
          $artworkid = $row['artworkid'];
   ?>
   <div class="container">
     <div class="col-md-2">
     <img class="img-thumbnail"src=<?= $url ?> alt="img">
    </div>
     <div class="col-md-10">
     <p><a href="Part03_ArtistDetails.php?id=<?=$artworkid?>"><?= $title ?></a></p>
      <p><?= $description ?></p>
       </div>
   </div></br>
   <?php
       }
   } 
    } 
  $conn->close(); 
    ?>
</body>
</html>