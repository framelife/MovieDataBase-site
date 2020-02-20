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

<h1>Search for Movie information </h1>

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
    <label for="Movie Name" >Movie Name:</label>
    <input type="text" name="name1" required>
    <br>
    <input type="submit" value="Submit" name =" submitb"/>
    <input type="reset"  value="Reset" />
  </fieldset>
</form>

<?php
  $checker2=$_GET['idm'];
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
            $query= "SELECT title, company, rating FROM Movie WHERE Movie.title = '$checker1'";
            $res = mysql_query($query, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res);
            if(!$res){
                die(mysql_error());
            }
            else
                echo "Successful Query";
            echo "<h2>Your Input:</h2>";
            print_r($_GET ['name1']);
            echo "<br>";
            echo "<h2>Movie Information: </h2>";
            
            while($row=mysql_fetch_row($res)){
              echo "<center>Title: $row[0]<br/></center>";
              echo "<center>Producer: $row[1]<br/></center>";
              echo "<center>Rating: $row[2]<br/></center>";
   
            }

            $querya = "SELECT CONCAT(Director.first, ' ',Director.last) AS 'Director' FROM MovieDirector, Director,Movie WHERE MovieDirector.did = Director.id AND MovieDirector.mid = Movie.id AND Movie.title = '$checker1' ";
              $resa = mysql_query($querya, $conn);
              $rows=mysql_affected_rows($conn);
              while($rowa=mysql_fetch_row($resa)){
              echo "<center>Director: $rowa[0] <br/></center>";

   
            }

            $queryb = "SELECT genre from MovieGenre,Movie where MovieGenre.mid = Movie.id and Movie.title = '$checker1' ";
             $resb = mysql_query($queryb, $conn);
              $rows=mysql_affected_rows($conn);
              $rowb=mysql_fetch_row($resb);

              echo "<center>Genre: $rowb[0]";
              while($rowb=mysql_fetch_row($resb)){
              echo ", $rowb[0]";
            }
            echo"</center>";



            $query1 =  "SELECT a.id, CONCAT(a.first, ' ', a.last) AS 'ActorName', b.role FROM Actor as a, MovieActor as b, Movie as c where c.title = '$checker1' AND c.id = b.mid AND a.id = b.aid";
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
                    echo "<a href=actor_info.php?ida=",urlencode($row[0]),">$row[0]</a>";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "<a href=actor_info.php?ida=",urlencode($row[0]),">$row[1]</a>";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "$row[2]";
                    echo "</td>";
                    echo "</tr>";
               }
               echo "</table>";
//////////////////
       echo "<h2>Movie Review: </h2>";
          $query2 ="SELECT COUNT(rating), ROUND(AVG(rating)) from Review where mid in (SELECT id from Movie WHERE title = '$checker1')";
          $res2 = mysql_query($query2, $conn);
          $rows=mysql_affected_rows($conn);
           $colums2=mysql_num_fields($res2);
          if(!$res2){
            die(mysql_error());
          }
          while($row2=mysql_fetch_row($res2)){
              if(!$row2[1]){
                $row2[0]=0;
                $row2[1]=0;
              }
              echo "<center>Average Score for this Movie is $row2[1] based on review of $row2[0] people <br/></center><br/>";
   
    }
          $query3="SELECT name, time, rating, comment FROM Review WHERE mid in(SELECT id from Movie WHERE title = '$checker1')";
            $res3 = mysql_query($query3, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res3);
            if(!$res1){
                die(mysql_error());
            }
            echo "<table align=center border=1><tr>";

            for($i=0; $i < $colums; $i++){
                $field_name=mysql_field_name($res3,$i);
                echo "<th>$field_name</th>";
            }
            echo "</tr>";
            while($row=mysql_fetch_row($res3)){
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
               echo "</table></br></br>";

        echo '<h2><a href="add_comment.php?idm='.$idm.'">Add Comment!</a></h2>';


  }
  else{
    if(!is_null($checker2)){
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
            $query= "SELECT title, company, rating FROM Movie WHERE Movie.id = $checker2";
            echo "$checker2<br><br>";
            $res = mysql_query($query, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res);

            if(!$res){
                echo " wttf?";
                die(mysql_error());
            }
            else
                echo "Successful Query";
            echo "<h2>Your Input:</h2>";
            print_r($_GET ['name1']);
            echo "<br>";
            echo "<h2>Movie Information: </h2>";
            
            while($row=mysql_fetch_row($res)){
              echo "<center>Title: $row[0]<br/></center>";
              echo "<center>Producer: $row[1]<br/></center>";
              echo "<center>Rating: $row[2]<br/></center>";
   
            }

            $querya = "SELECT CONCAT(Director.first, ' ',Director.last) AS 'Director Name' FROM MovieDirector, Director WHERE MovieDirector.mid = $checker2 AND MovieDirector.did = Director.id ";
              $resa = mysql_query($querya, $conn);
              $rows=mysql_affected_rows($conn);
              while($rowa=mysql_fetch_row($resa)){
              echo "<center>Director: $rowa[0] <br/></center>";

   
            }

            $queryb = "SELECT genre FROM MovieGenre WHERE MovieGenre.mid = $checker2 ";
             $resb = mysql_query($queryb, $conn);
              $rows=mysql_affected_rows($conn);
              $rowb=mysql_fetch_row($resb);

              echo "<center>Genre: $rowb[0]";
              while($rowb=mysql_fetch_row($resb)){
              echo ", $rowb[0]";
            }
            echo"</center>";



            ///////////
            $query1 = "SELECT id, CONCAT(first, ' ',last) AS 'Actor Name', role as 'Role' FROM MovieActor, Actor WHERE mid = $checker2 AND aid = id";
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
                    echo "<a href=actor_info.php?ida=",urlencode($row[0]),">$row[0]</a>";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "<a href=actor_info.php?ida=",urlencode($row[0]),">$row[1]</a>";
                    echo "</td>";
                    echo "<td align='center'>";
                    echo "$row[2]";
                    echo "</td>";
                    echo "</tr>";
               }
               echo "</table>";

       echo "<h2>Movie Review: </h2>";
          $query2 ="SELECT COUNT(rating),AVG(rating) from Review where mid =$checker2";
          $res2 = mysql_query($query2, $conn);
          $rows=mysql_affected_rows($conn);
           $colums2=mysql_num_fields($res2);
          if(!$res2){
            die(mysql_error());
          }
          while($row2=mysql_fetch_row($res2)){
              if(!$row2[1]){
                $row2[0]=0;
                $row2[1]=0;
              }
              echo "<center>Average Score for this Movie is $row2[1]<br>
              It is based on review of $row2[0] people <br/></center><br/>";
   
    }
          $query3="SELECT name, time, rating, comment FROM Review WHERE mid = $checker2";
            $res3 = mysql_query($query3, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res3);
            if(!$res1){
                die(mysql_error());
            }
            echo "<table align=center border=1><tr>";

            for($i=0; $i < $colums; $i++){
                $field_name=mysql_field_name($res3,$i);
                echo "<th>$field_name</th>";
            }
            echo "</tr>";
            while($row=mysql_fetch_row($res3)){
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
               echo "</table></br></br>";

        echo '<h2><a href="add_comment.php?idm='.$idm.'">Add Comment!</a></h2>';











            
    }
  }


?>

</body>

</html>