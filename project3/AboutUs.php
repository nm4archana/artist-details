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

<div class="container">
  <h1>Welcome to Assignment #3</h1>
  <p>This is third assignment for <strong>Neelipalayam Masilamani, Archana</strong> for COMP 5335, Due Date: 20-Nov-2016</p> 
</div>

</body>

</html>