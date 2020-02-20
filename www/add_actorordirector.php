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

<h1>Add Actor or Director </h1>

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
  <label for="Actor Type" >Actor Type:</label>
  <input type="radio" name="type" value="Actor" id="actor" required > Actor
  <input type="radio" name="type" value="Director" id="director" required > Director
  <br>
  <label for="First Name" >First Name:</label>
  <input type="text" name="first" required>
  <br>
  <label for="Last Name" >Last Name:</label>
  <input type="text" name="last" required>
  <br>
  <label for="Date or Birth" >Date or Birth:</label>
  <input id="date" name="dob" required min="1900-01-01" max="2019-01-31" type="date"/>
  <br>
  <label for="Date or Death" >Date or Death:</label>
  <input type="date" name="dod" >
  <br>
  <label for="Gender" >Gender:</label>
  <input type="radio" name="gender" value="Male" id="male" required> Male
  <input type="radio" name="gender" value="Female" id="female" required> Female
  <br>

<input type="submit" value="Submit" name ="submitb" />
<input type="reset"  value="Reset" />
</fieldset>
</form>

<?php
 $checker=$_GET['submitb'];
 $type = $_GET['type'];
 $first = $_GET['first'];
 $last = $_GET['last'];
 $dob = $_GET['dob'];
 $dod = $_GET['dod'];
 $gender = $_GET['gender'];
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
            $query = "SELECT id FROM MaxPersonID";
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
            if($type == 'Director'){
              $query1= "INSERT INTO Director(id, last, first, dob, dod) VALUES('$Newmax', '$last', '$first',  '$dob', '$dod')";
              $res1 = mysql_query($query1, $conn);
                if(!$res1){
                  die(mysql_error());
               }
              $query2= "UPDATE MaxPersonID SET id=$Newmax WHERE id=$max";
              $res2 = mysql_query($query2, $conn);
                 if(!$res2){
                    die(mysql_error());
                  }
              $query3 = "UPDATE Director SET dod = NULL WHERE dod = '0000-00-00'";
              $res3 = mysql_query($query3, $conn);
                 if(!$res3){
                    die(mysql_error());
              }

            
          }
            else if($type == 'Actor')
            {
               
               $query4= "INSERT INTO Actor(id, last, first,sex,dob, dod) VALUES('$Newmax', '$last', '$first', '$gender',  '$dob', '$dod')";
              $res4 = mysql_query($query4, $conn);
                if(!$res4){
                  die(mysql_error());
               }
              $query5= "UPDATE MaxPersonID SET id=$Newmax WHERE id=$max";
              $res5 = mysql_query($query5, $conn);
                 if(!$res5){
                    die(mysql_error());

            }
              $query6 = "UPDATE Actor SET dod = NULL WHERE dod = '0000-00-00'";
              $res6 = mysql_query($query6, $conn);
                 if(!$res6){
                    die(mysql_error());
              }

          }

            echo "<h2>Your Input:</h2>";
            echo "$type<br>";
            echo "$first<br>";
            echo "$last<br>";
            echo "$dob<br>"; 
            echo "$dod<br>";
            echo "$gender<br>"; 
            echo "$Newmax<br>";  

    
    }

?>

</body>

</html>
