<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
}

li a {
  display: block;
  color: black;
  padding: 8px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #555;
  color: white;
}
li a:active{
  color: green;
}
  #contact_form {
    position: relative;
    left : 400px;
    bottom: 300px ;
}
input[type=text] {
  width: 50%;
  padding: 5px 10px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid black;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=date] {
  width: 50%;
  padding: 5px 10px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid black;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=number] {
  width: 50%;
  padding: 5px 10px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid black;
  border-radius: 4px;
  box-sizing: border-box;
}
 fieldset{
  background-color: #f1f1f1;
  border: none;
  border-radius: 2px;
  margin-bottom: 12px;
  overflow: hidden;
  padding: 0 .625em;
  } 
 label{
  cursor: pointer;
  display: inline-block;
  padding: 3px 6px;
  text-align: left;
  width: 150px;
  vertical-align: middle;
  } 
  input{
  font-size: inherit;
  }
</style>
</head>
<body>

<h1>Add Movie Information</h1>

<ul>
    <li><a href="index.php">home</a></li>    
    <li><a href="add_actorordirector.php">add actor/director</a></li>
    <li><a href="add_movie.php">add movie info</a></li>
    <li><a href="add_actortomovie.php">add movie/actor relation</a></li>
    <li><a href="add_directortomovie.php">add movie/director relation</a></li>
    <li><a href="add_Search.php">search</a></li>
    <li><a href="add_comment.php">add comment</a></li>
    <li><a href="actor_info.php">show actor info</a></li>
    <li><a href="movie_info.php">show movie info</a></li>
</ul>
<form id="contact_form" action="" method="GET" >
  <fieldset>
  <label for="Title" >Title:</label>
  <input type="text" name="title" required>
  <br>
  <label for="Year" >Year:</label>
  <input id="text" name="year" placeholder="YYYY" required min="1900" max="2019" type="number"/>
  <br>
  <label for="Director" >Director:</label> 
  <input type="text" name="director" required>
  <br>
   <label for="Rating" >Rating:</label>
   <select name=rating id=rating >
   <option value=G>G</option>
   <option value=PG>PG</option>
   <option value=PG-13>PG-13</option>
   <option value=R>R</option>
   <option value=NC-17>NC-17</option>
 </select><br>

  <label for="Company" >Company:</label>
  <input type="text" name="company" required>
  <br>
  <label for="Genre" >Genre:</label>
    <input type="checkbox" name="genre[]" value="Action">Action
    <input type="checkbox" name="genre[]" value="Adult">Adult
    <input type="checkbox" name="genre[]" value="Adventure">Adventure
    <input type="checkbox" name="genre[]" value="Animation">Animation
    <input type="checkbox" name="genre[]" value="Comedy">Comedy
    <input type="checkbox" name="genre[]" value="Crime">Crime
    <input type="checkbox" name="genre[]" value="Documentary">Documentary
    <input type="checkbox" name="genre[]" value="Drama">Drama<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    <input type="checkbox" name="genre[]" value="Family">Family
    <input type="checkbox" name="genre[]" value="Fantasy">Fantasy
    <input type="checkbox" name="genre[]" value="Horror">Horror
    <input type="checkbox" name="genre[]" value="Musical">Musical
    <input type="checkbox" name="genre[]" value="Mystery">Mystery
    <input type="checkbox" name="genre[]" value="Romance">Romance
    <input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi
    <input type="checkbox" name="genre[]" value="Short">Short
    <input type="checkbox" name="genre[]" value="Thriller">Thriller<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    <input type="checkbox" name="genre[]" value="War">War
    <input type="checkbox" name="genre[]" value="Western">Western
  <br>
  <input type="submit" value="Submit" name="submitb"/>
  <input type="reset"  value="Reset" />
  </fieldset>
</form>

<?php

 $checker=$_GET['submitb'];
 $title = $_GET['title'];
 $year = $_GET['year'];
 $director=$_GET['director'];
 $rating = $_GET['rating'];
 $company = $_GET['company'];
 $genre = array();
 foreach($_GET['genre'] as $element) {
        array_push($genre, $element);
      }

if(!is_null($checker)){
            $hostname= "localhost";
            $dbname= "CS143";
            $username="cs143";
            $pw= "";
            $conn= mysql_connect($hostname,$username,$pw);
            if (!$conn)
            {
             die(mysql_error());
            }
            if(mysql_select_db($dbname,$conn))
            {
                echo "Connection to database successfully<br>";
            }
            else 
                echo "error" . mysql_error();
            //$name = $_GET['name'];
            $query = "SELECT id FROM MaxMovieID";
            $res = mysql_query($query, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res);
            if(!$res){
                die(mysql_error());
            }
            while($row=mysql_fetch_row($res)){
                $max = $row[0];
   
            }
            $Newmax = $max +1 ;
            $query1 = "UPDATE MaxMovieID SET id=$Newmax";
            $res1 = mysql_query($query1, $conn);
            if(!$res1){
                die(mysql_error());
            }
            $query2=  "INSERT INTO Movie(id, title, year, rating, company) VALUES('$Newmax','$title','$year','$rating','$company')";
            $res2 = mysql_query($query2, $conn);
            if(!$res2){
                die(mysql_error());
            }

            foreach($genre as $e){
               $query3 ="INSERT INTO MovieGenre(mid,genre) VALUES('$Newmax','$e')";
               $res3 = mysql_query($query3, $conn);
                if(!$res3){
                die(mysql_error());
              }
            }

            echo "<h2>Your Input:</h2>";
            echo "$title<br>";
            echo "$year<br>";
            echo "$director<br>";
            echo "$rating<br>"; 
            echo "$company<br>"; 
            echo "$Newmax<br>";        
            foreach($genre as $e){
              echo "$e  ";

            }

   }


?>

</body>

</html>
