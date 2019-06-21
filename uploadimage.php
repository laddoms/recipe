<html>
<body>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_FILES['upload']))
			{
				$allowed=array('image/jpeg', 'image/JPG', 'image/PNG', 'image/png');
				if(in_array($_FILES['upload']['type'], $allowed))  //validates file type
					{
						if(move_uploaded_file($_FILES['upload']['tmp_name'], "../uploads/{$_FILES['upload']['name']}"))
							{
								echo'<p><em>The files has been uploaded</em></p>';
							}  //end of move_uploaded_file
					}
				else
					{
						echo'<p>Please upload a JPEG or PNG type image.</p>';
					}
			}
		if($_FILES['upload']['error']>0)
			{
				echo'<p>The file could not be uploaded.';
			}
		if(file_exists($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']))
			{
				uplink($_FILES['upload']['tmp_name']);
			}
	}
?>

<form enctype="multipart/form-data" action="uploadimage.php" method="post">
<input type="hidden" name="maxfilesize" value="524288" />
file:<input type="file" name="upload" />
<input type="submit" name="submit" value="submit" />
</form>
</body>
</html>
