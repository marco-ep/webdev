<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search Kevin Bacon</title>
   
    <link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png" rel="shortcut icon" />

    <!-- Link to your CSS file that you should edit -->
    <link href="bacon.css" type="text/css" rel="stylesheet" />
</head>

<body>

<div id="frame">
    <!-- header -->
    <div id="banner">
        <a href="mymdb.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png" alt="banner logo" /></a>
        My Movie Database
    </div>

    <div id="main">
        <h1>Results for <?php echo $_GET['firstname'] . " " . $_GET['lastname'] ?></h1> <br/><br/>

        <div id="text">Films with <?php echo $_GET['firstname'] . " " . $_GET['lastname'] ?> and Kevin Bacon</div><br/>
        <table>
            <tr>
                <td class="index"><strong>#</strong></td>
                <td class="title"><strong>Title</strong></td>
                <td class="year"><strong>Year</strong></td>
            </tr>
            <?php
            include("common.php");
            //Gets Kevin Bacon's id
            $baconSql = "SELECT id FROM actors WHERE first_name = 'Kevin' AND last_name = 'Bacon'";
            foreach($dbh->query($baconSql) as $row){
                $baconId = $row['id'];
            }
            //$baconId = mysql_result($result,0, 'id');
            /*
                Joins actors, movies, and roles tables, then Selects movie name and year
                for every movie that Kevin Bacon and the searched actor appear together in.
            */
            $sql2 = "SELECT m.name, m.year ";
            $sql2.= "FROM movies m ";
            $sql2.= "JOIN roles r1 ON r1.movie_id = m.id ";
            $sql2.= "JOIN actors a1 ON r1.actor_id = a1.id ";
            $sql2.= "JOIN roles r2 ON r2.movie_id = m.id ";
            $sql2.= "JOIN actors a2 ON r2.actor_id = a2.id ";
            $sql2.= "WHERE ((r1.actor_id='".$baconId."') AND (r2.actor_id='".$id."') AND (r1.movie_id = r2.movie_id))";
            $sql2.= "ORDER BY m.year DESC, m.name ASC";
            $i = 0;
			//Prints every movie result
            foreach($dbh->query($sql2) as $row){
                echo "<tr><td class=\"index\">";
                echo $i+1;
                echo "</td><td class=\"title\">";
                echo $row['name'];
                echo "</td><td class=\"year\">";
                echo $row['year'];
                echo "</td></tr>";
                $i++;
            }
			//close the connection
            $dbh = null;
            ?>
        </table>
        <!-- form to search for every movie by a given actor -->
        <form action="search-all.php" method="get">
            <fieldset>
                <legend>All movies</legend>
                <div>
                    <input name="firstname" type="text" size="12" placeholder="first name" autofocus />
                    <input name="lastname" type="text" size="12" placeholder="last name" />
                    <input type="submit" value="go" />
                </div>
            </fieldset>
        </form>

        <!-- form to search for movies where a given actor was with Kevin Bacon -->
        <form action="search-kevin.php" method="get">
            <fieldset>
                <legend>Movies with Kevin Bacon</legend>
                <div>
                    <input name="firstname" type="text" size="12" placeholder="first name" />
                    <input name="lastname" type="text" size="12" placeholder="last name" />
                    <input type="submit" value="go" />
                </div>
            </fieldset>
        </form>
    </div>
</div>



</body>
</html>