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
  vertical-align: top;
  } 
  input{
  font-size: inherit;
  }

</style>
</head>
<body>

<h1>Add Comment to Movie </h1>

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
 <label for="UserName"  >UserName:</label>
 <input type="text" name="first" required><br>
 <label for="Movie Name" >Movie Name:</label> 
  <?php
           $hostname= "localhost";
            $dbname= "CS143";
            $username="cs143";
            $pw= "";
      mysql_connect($hostname, $username, $pw);
      mysql_select_db($dbname);

      $sql = "SELECT title FROM Movie";
      $result = mysql_query($sql);

      echo "<select name='title'>";
      while ($row = mysql_fetch_array($result)) {
          echo "<option value='" . $row['title'] ."'>" . $row['title'] ."</option>";
      }
      echo "</select>";
 
  ?><br>   
 <label for="Rating" >Rating:</label>
 <select name=rating id=point>
  <option value=5>5</option>
 <option value=4>4</option>
 <option value=3>3</option>
 <option value=2>2</option>
 <option value=1>1</option>
 </select><br>

 <label for="Comment"> Comment:</label> 
 <textarea type="text" name="comment" cols="40" rows="5" align="left"></textarea> 

  <br>
  <input type="submit" value="Submit" name="submitb">
  <input type="reset"  value="Reset" /><br>
</fieldset>
</form>

<?php
 $checker=$_GET['submitb'];
 $first = $_GET['first'];
 $comment = $_GET['comment'];
 $rating = $_GET['rating'];
 $time = date('Y-m-d G:i:s');
 $title = $_GET['title'];
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
            $query= "INSERT INTO Review(name, time, mid, rating, comment) VALUES('$first','$time',(select id from Movie where title = '$title'),'$rating','$comment')";
            $res = mysql_query($query, $conn);
            $rows=mysql_affected_rows($conn);
            $colums=mysql_num_fields($res);
            if(!$res){
                die(mysql_error());
            }
            
            echo "Successful Update";
            echo "<h2>Your Input:</h2>";
            echo "$first<br>";
            echo "$time<br>";
            echo "$title<br>";
            echo "$comment<br>";
            echo "$rating<br>";         
            echo "<br>";

   }


?>

</body>

</html>