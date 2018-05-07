<div id="sidebar">

<h1> KATEGORİLER</H1>

<?php

$rsKategori = mysql_query("SELECT * FROM kategori");

$row_rsKategori = mysql_fetch_object($rsKategori);

$total_row_rsKategori = mysql_num_rows($rsKategori);

if($total_row_rsKategori>0){
	
	echo "<ul>";
	do{
		
	echo'<li><a href=kategori.php?KategoriID='.$row_rsKategori->KategoriID.'>'.
	$row_rsKategori->Kategori.'</a></li>';
	
	}while($row_rsKategori=mysql_fetch_object($rsKategori));
	
	
	
	echo "</ul>";
		
}else{
	
}


?>


<h1>SON EKLENENLER</h1>
<?php
$rsPostSon = mysql_query("SELECT PostID,PostBaslik,PostTarihi FROM Post
 ORDER BY PostTarihi DESC LIMIT 5 ");
$row_rsPostSon = mysql_fetch_object($rsPostSon);

$total_rowPostSon = mysql_num_rows($rsPostSon);

if($total_rowPostSon>0){
	
	echo "<ul>";
	do{
		echo"<li>";
			

		echo $row_rsPostSon->PostBaslik;

			
		echo"</li>";		
			
	 }while($row_rsPostSon = mysql_fetch_object($rsPostSon));
	
	
	echo"</ul>";
		
}else{
	echo"yazı yok";
}
?>


<h1> EN ÇOK OKUNANALAR</H1>

<?php

$rsPostOkuma = mysql_query("SELECT PostID,PostBaslik,Goruntulenme FROM
post ORDER BY Goruntulenme DESC LIMIT 5");

$row_rsPostOkuma = mysql_fetch_object($rsPostOkuma);
$total_row_rsPostOkuma = mysql_num_rows($rsPostOkuma);
if($total_row_rsPostOkuma>0){
	echo"<ul>";
	
	do{
		echo"<li>";
			
echo '<a href="post.php?PostID='.$row_rsPostOkuma->PostID.'">'.$row_rsPostOkuma->PostBaslik.'
('.$row_rsPostOkuma->Goruntulenme.')</a>';
	
		echo"</li>";		
			
	 }while($row_rsPostOkuma = mysql_fetch_object($rsPostOkuma));
	
	echo"</ul>";
	
	}else{
		echo"Yazı Yok";
	
		}



?>




</div>