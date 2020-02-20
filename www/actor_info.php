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

<h1>Search for Actor information </h1>

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
  <label for="Actor Name" >Actor Name:</label>
  <input type="text" name="name1" required>
  <br>
<input type="submit" value="Submit" name =" submitb"/>
<input type="reset"  value="Reset" />
</fieldset>
</form>

<?php
  $checker=$_GET['ida'];
  $checker1= $_GET['name1'];
  if(!is_null($checker1)){
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
            $query= "SELECT id, CONCAT(first,' ', last) AS 'ActorName', dob, dod FROM Actor WHERE CONCAT(first,' ',last) = '$checker1'";
            $res = mysql_query($query, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res);
            if(!$res){
                echo " wtf?";
                die(mysql_error());
            }
            else
                echo "Successful Query";
            echo "<h2>Your Input:</h2>";
            print_r($_GET ['name1']);
            echo "<br>";
            echo "<h2>Actor Information: </h2>";
            echo "<table align=center border=1><tr>";

            for($i=0; $i < $colums; $i++){
                $field_name=mysql_field_name($res,$i);
                echo "<th>$field_name</th>";
            }
            echo "</tr>";
            while($row=mysql_fetch_row($res)){
                    echo "<tr>";
                    echo "<td align='center'>";
                    echo "$row[0]";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "$row[1]";
                    echo "<td align='center'>";
                    echo "$row[2]";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "$row[3]";
                    echo "</td>";
                    echo "</tr>";
            }

            echo "</table>";

            $query1 = "SELECT c.id, c.title, b.role FROM Actor as a, MovieActor as b ,Movie as c where a.id=b.aid and b.mid = c.id and CONCAT(a.first,' ',a.last)= '$checker1'";
            $res1 = mysql_query($query1, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res1);
            if(!$res1){
                die(mysql_error());
            }
            echo "<h2>Actor Attended Moive: </h2>";
            echo "<table align=center border=1><tr>";

            for($i=0; $i < $colums; $i++){
                $field_name=mysql_field_name($res1,$i);
                echo "<th>$field_name</th>";
            }
            echo "</tr>";
            while($row=mysql_fetch_row($res1)){
                    echo "<tr>";
                    echo "<td align='center'>";
                    echo "<a href=movie_info.php?idm=",urlencode($row[0]),">$row[0]</a>";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "<a href=movie_info.php?idm=",urlencode($row[0]),">$row[1]</a>";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "$row[2]";
                    echo "</td>";
                    echo "</tr>";
               }
               echo "</table>";


  }
  else{
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
            $name = $_GET['name'];
            echo "$idex";
            $query= "SELECT id, CONCAT(first, ' ', last) AS 'ActorName', dob, dod FROM Actor where id = $checker";
            echo "$checker<br><br>";
            $res = mysql_query($query, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res);
            if(!$res){
                echo " wtf?";
                die(mysql_error());
            }
            else
                echo "Successful Query";
            echo "<h2>Your Input:</h2>";
            print_r($_GET ['name']);
            echo "<br>";
            echo "<h2>Actor Information: </h2>";
            echo "<table align=center border=1><tr>";

            for($i=0; $i < $colums; $i++){
                $field_name=mysql_field_name($res,$i);
                echo "<th>$field_name</th>";
            }
            echo "</tr>";
            while($row=mysql_fetch_row($res)){
                    echo "<tr>";
                    echo "<td align='center'>";
                    echo "$row[0]";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "$row[1]";
                    echo "<td align='center'>";
                    echo "$row[2]";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "$row[3]";
                    echo "</td>";
                    echo "</tr>";
            }

            echo "</table>";
            $query1 = "SELECT mid,title AS 'Title', role AS 'Role' FROM MovieActor, Movie WHERE aid = $checker AND mid = id";
            $res1 = mysql_query($query1, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res1);
            if(!$res1){
                die(mysql_error());
            }
            echo "<h2>Actor Attended Moive: </h2>";
            echo "<table align=center border=1><tr>";

            for($i=0; $i < $colums; $i++){
                $field_name=mysql_field_name($res1,$i);
                echo "<th>$field_name</th>";
            }
            echo "</tr>";
            while($row=mysql_fetch_row($res1)){
                    echo "<tr>";
                    echo "<td align='center'>";
                    echo "<a href=movie_info.php?idm=",urlencode($row[0]),">$row[0]</a>";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "<a href=movie_info.php?idm=",urlencode($row[0]),">$row[1]</a>";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "$row[2]";
                    echo "</td>";
                    echo "</tr>";
               }
               echo "</table>";
    }
  }


?>

</body>

</html>