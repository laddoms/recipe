<?php
if($_SERVER['REQUEST_METHOD']=='GET')
	{
		 ?>
		<form enctype="multipart/form-data" method="post" action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>" >
		<input type="file" name="document" />
		<input type="submit" value="send a file" />
		</form>
		<?php 
	}
else
	{
		if(isset($_FILES['document']) && ($_FILES['document']['error']==UPLOAD_ERR_OK))
		{
			$newpath='/tmp/' . basename($_FILES['document']['name']);
			if(move_uploaded_file($_FILES['document']['tmp_name'], $newpath))
				{
					print'file saved in $newpath';
				}
			else
				{
					print'Could not move file to $newpath';
				}
		}
else	
	{
		print'No valid file uploaded.';
	}
}
?>