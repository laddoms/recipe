<?php
//include('mysqli_connect.php');
//include('header.inc.php');
include('newforumheader.inc.php');
$first='posts.postedon';
$last='posts.postedon';
$query="SELECT threads.threadid, threads.subject, users.firstname, posts.postid, 
        posts.postedon FROM threads INNER JOIN posts USING(threadid) 
        INNER JOIN users ON threads.userid=users.userid GROUP BY (posts.threadid) DESC";
$result=mysqli_query($dbc, $query);
echo'<div class="forumpage">';
if(mysqli_num_rows($result)>0)
	{
		//include('mysqli_connect.php');
		//$query="SELECT * FROM words";
		echo'<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
				<tr>
					<td align="left"><em>' . $words['subject'] . '</em></td>
					<td align="left"><em>' . $words['postedby'] . '</em></td>
					<td align="center"><em>' . $words['postedon'] . '</em></td>
				</tr>';
		while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				echo'<tr>
						<td align="left"><a href="index.php?content=read&threadid=' . $row['threadid'] . '">' 
						. $row['subject'] . '</a></td>
						<td align="left">' . $row['firstname'] . '</td>
						<td align="center">' . $row['postedon'] . '</td>
					 </tr>';
			}
		echo'</table>';
	}
else
	{
		echo'<p>There are currently no messages in this forum.</p>';
	}
echo'</div>';
?>		
	   