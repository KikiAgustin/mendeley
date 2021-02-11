<?php
include("../../../../../setingan/global.inc.php");
include("../../../../../setingan/web.config.inc.php");

session_start();
header('Content-Type: application/json');
if(!$_SESSION['cms_userid']) { exit(); }

if(isset($_FILES['upload']))
{
  $filen = $_FILES['upload']['tmp_name']; 
  
  if(@is_array(getimagesize($filen)))
  {

	  $con_images = "$lokasimedia/".$_FILES['upload']['name'];
	  move_uploaded_file($filen, $con_images );
	  $url = "$fulldomain/medias/".$_FILES['upload']['name'];
	  
	  $funcNum = $_GET['CKEditorFuncNum'] ;
	  $CKEditor = $_GET['CKEditor'] ;
	  $langCode = $_GET['langCode'] ;
		
	  $data['uploaded'] = 1;
	  $data['fileName'] = "$filen";
	  $data['url'] = $url;
	  echo json_encode($data);
  }
  else
  {
	  $data['uploaded'] = 0;
	  $data['error']['message'] = "File yang diupload harus file gambar JPG, GIF atau PNG";
	  echo json_encode($data);
  }

}
else
{
	 $data['uploaded'] = 0;
	  $data['error']['message'] = "File yang diupload harus file gambar JPG, GIF atau PNG";
	  echo json_encode($data);
}
?>