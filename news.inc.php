    <div class="rightside">
	<h2>Latest and Greatest</h2>

    <br>News from the Running Recipes World<br>

    <?php

    $connect = mysql_connect("localhost", "ijdbUser", "") or die('Could not connect to server');

    mysql_select_db("recipe", $connect) or die('Sorry, could not connect to the database');

    $query = "SELECT title, date, article FROM news ORDER BY date DESC LIMIT 0,2";

    $result = mysql_query($query) or die('Sorry, could not get news articles');

    while($row=mysql_fetch_array($result, MYSQL_ASSOC))

    {

        $date = $row['date'];

        $title = $row['title'];

        $article = $row['article'];

        echo "<br>$date - <b>$title</b><br /><br />$article<br /><br />";

    }

    ?>
</div>
