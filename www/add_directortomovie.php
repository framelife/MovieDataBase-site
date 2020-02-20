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

<h1>Add a Direcotr to Movie </h1>

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
  <?php
           $hostname= "localhost";
            $dbname= "CS143";
            $username="cs143";
            $pw= "";
      mysql_connect($hostname, $username, $pw);
      mysql_select_db($dbname);

      $sql = "SELECT id,title,year FROM Movie";
      $result = mysql_query($sql);

      echo "<select name='title'>";
      while ($row = mysql_fetch_array($result)) {
          echo '<option value="' . $row[id] . '">' . $row[title] . ' (' . $row[year] . ')</option>';
      }
      echo "</select>";
  
  ?><br>  

 <label for="Direcotr Name" >Director Name:</label> 

 


    <?php
           $hostname= "localhost";
            $dbname= "CS143";
            $username="cs143";
            $pw= "";
      mysql_connect($hostname, $username, $pw);
      mysql_select_db($dbname);

      $sql = "SELECT id,first,last FROM Director";
      $result = mysql_query($sql);

      echo "<select name='Dname'>";
      while ($row = mysql_fetch_array($result)) {
        echo '<option value="' . $row[id] . '">' . $row[first] . " ".  $row[last] . '</option>';
      }
      echo "</select>";
  
   ?>
  
  <br>
  <input type="submit" value="Submit" name ="submitb" />
  <input type="reset"  value="Reset" />
</fieldset>
</form>
</body>
<?php
  $checker=$_GET['submitb'];
  $id = $_GET['title'];
  $name = $_GET['Dname'];
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
            echo "<h2>Your Input:</h2>";
            
            echo "$id<br>";
            echo "$name<br>";
          


            $query = "INSERT INTO MovieDirector(mid, did) VALUES('$id', $name)";
            $res = mysql_query($query, $conn);
            if(!$res){
                    die(mysql_error());
            }
            else
              echo " successfully updated!";

  }


?>
</html>