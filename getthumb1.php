<?php
function getThumb($image)
{
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_FILES['image']))
			{
				$allowed=array('image/jpeg', 'image/JPG', 'image/PNG', 'image/png', 'image/jpeg', 'image/gif');
				if(in_array($_FILES['image']['type'], $allowed))  //validates file type
					{
						if(move_uploaded_file($_FILES['image']['tmp_name'], "../newrecipe/{$_FILES['image']['name']}"))  //../ brings file into current directory
							{
								echo'<p><em>The files has been uploaded</em></p>';
							}  //end of move_uploaded_file
					}
				else
					{
						echo'<p>Please upload a JPEG or PNG type image.</p>';
					}
			}
		if($_FILES['image']['error']>0)
			{
				echo'<p>The file could not be uploaded.';
			}
		if(file_exists($_FILES['image']['tmp_name']) && is_file($_FILES['image']['tmp_name']))
			{
				unlink($_FILES['image']['tmp_name']);   //deletes the temp file
			}
	}

	// $image="../uploads/{$_GET['image']}";
    //$image="../tmp/{$_FILES['image']}";
    $image=$_FILES['image']['name'];  //store the uploaded image in a variable
	$image=strtolower($image);  //converts the file name to lower case
	$ext=substr($image, -4);	//Returns last 4 characters from image name	
    if (!$image)  //if the image wasnt uploaded. Use a temporary image. 
	    {
		  //no image supplied, use default
		  $TempName = "noimage.jpg";
		  $TempFile = fopen($TempName, "r");
		  $thumbnail = fread($TempFile, fileSize($TempName));
	    } 
	else
	    {
	      //get image
                  // $ext=substr($image, -4);	//Returns last 4 characters from image name	
                  // $ext=strtolower($image);
				
		    if(($ext=='.jpg') or ($ext=='jpeg'))
				{
					// $image="../uploads/{$_GET['image']}";
                    //  $image="../tmp/{$_FILES['image']}";
			        if(file_exists($image) && (is_file($image)))
				       {
				         // $image=$_GET['image'];
					     $SourceImage = imagecreatefromjpeg($image);
						echo$image;
					   }
				}
			elseif($ext=='.png')
			   {
				   //$image="../uploads/{$_GET['image']}";
				   //$image="../tmp/{$_FILES['image']}";
				   if(file_exists($image) && (is_file($image)))
						{
							//$image=$_GET['image'];
							$SourceImage = imagecreatefrompng($image);
							echo$image;
						}  		 
				}   

			elseif($ext=='.gif')
			    {
				   //$image="../uploads/{$_GET['image']}";
				   //$image="../tmp/{$_FILES['image']}";
				   if(file_exists($image) && (is_file($image)))
						{
							//$image=$_GET['image'];
							$SourceImage = imagecreatefromgif($image);
							echo$image;
						}  		 
				}   

		  //create image		
		  //$SourceImage = imagecreatefromjpeg($image);
		  echo$image;

    if (!$SourceImage)    //not a valid image
	    {
		 	echo "Not a valid image\n";
			$TempName = "noimage.jpg";
			$TempFile = fopen($TempName, "r");
			$thumbnail = fread($TempFile, fileSize($TempName));
	    }
	else                 //create thumbnail 
        {
			 $width = imageSX($SourceImage);
			 $height = imageSY($SourceImage);
			 $newThumb = imagecreatetruecolor(290, 180);

			 $result = imagecopyresampled($newThumb, $SourceImage, 
										  0, 0, 0, 0,
										  290, 180, $width, $height);      //resize image to 80 x 60 

			 //move image to variable
			 ob_start();
			 imageJPEG($newThumb);
			 $thumbnail = ob_get_contents();
			 ob_end_clean();
        }
        }
   return $thumbnail;
}
?>