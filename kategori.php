<?php
require_once('inc/config.php');

//kategori id varsa alınacak

$kategoriID = mysql_real_escape_string($_GET['KategoriID']);
$rsKategoriAdi = mysql_query("SELECT Kategori FROM kategori Where KategoriID=".$kategoriID."");

$row_rsKategoriAdi = mysql_fetch_object($rsKategoriAdi);
$total_num_rsKategoriAdi = mysql_num_rows($rsKategoriAdi);

if($total_num_rsKategoriAdi ==0){
	
	header("location:index.php?secim=hatalikategori");
}


//empty  boş mu kontrol ediyor
if(isset($_GET['page']) && !empty($_GET['page'])){
//SAYFALAMA İŞLEMİ
//$page_no hangi sayfanın gösterileceğini belirler.
$page_no = mysql_real_escape_string($_GET['page']);
}else{
	$page_no =1;
}
//$total_num_pos kaç post olduğunu tutacak
$total_num_post = mysql_num_rows(mysql_query("SELECT PostID from post where KategoriID=".$kategoriID.""));	

// bir sayfa için kaç kayır gösterilecek bu değişkende tutulacak.
$post_per_page = 3;

//$page_num ceil fonkisyonu ile yuvarlanmış sayfa sayısını tutar. Bir üst sayıya yuvarlıyor.
$page_num = ceil($total_num_post / $post_per_page);

//LIMIT 0,3 ise sıfırdan başlayarak ilk 3 kaydı gösteriyor
//LIMIT 3,3 ise 3 den başlayarak 3 kayıt gösterir
//LIMIT SIFIR İLK SAYFAYI GÖSTERMEK İÇİN OLUR. limitin nereden başlayacagıı gösterir
$limit_start = ($page_no-1)*$post_per_page;


?>

<!doctype html>
<html>
<head>
		<meta charset="utf-8">
		<title> Blog site çalışması </title>
		<link href="styles/style.css" rel="stylesheet" />
	
</head>

<body>
<div id="wrapper">
<!-- blog header -->
<?php include 'views/header.php'; ?>
	
<div id="container">

		<div id="content">
			
			<?php
			echo "<div class='kategoriAdi'>".$row_rsKategoriAdi->Kategori."</div>";
			
			
			$rsPost = mysql_query(
			"SELECT * FROM post where KategoriID=".$kategoriID." LIMIT ".$limit_start.",".$post_per_page."");
			$row_rsPost = mysql_fetch_object($rsPost);
			$total_row_rsPost = mysql_num_rows($rsPost);
			
			//echo"gösterilecek toplam post adedi : ".$total_row_rsPost."<br/>";
			
			if ($total_row_rsPost > 0){
				
				//echo "Postlar burada yer alacak <br/>";
				
				
				
				
				do{ ?>
					<div class="post">
					<?php
					echo "<h1>".$row_rsPost->PostBaslik."</h1>"; ?>
					
					<div class="postTarih">
					<?php
					
					$timestamp = strtotime($row_rsPost->PostTarihi);
					$postTarih = date("d/m/Y",$timestamp);
					
					echo "<span>" . $postTarih . " </span>";
					if($row_rsPost->Goruntulenme !=0){
					echo " - <span>" . $row_rsPost->Goruntulenme . " Okuma </span>";
					}
					
					
					?>
					</div> <!--posttarih div sonu-->
					
					<?php
					echo "<p>" . substr($row_rsPost->Post,0,150) . "... 
					<a href=post.php?PostID=" .$row_rsPost->PostID.">Devamı<a/></p>";
					
					?>
					</div> <!--post div sonu -->
				<?php }while($row_rsPost = mysql_fetch_object($rsPost));
				
				
			}else{
				
				echo "<h1> Kayıt Bulunamadı </h1>";
				
			}
	
			?>
			<div class="pagination">
			<ul class="paginationMenu">
			<?php
			
			for($i=1;$i<=$page_num;$i++){
				
				if($i==$page_no){
					
				echo "<li class='selected'>&nbsp;".$i."&nbsp;</li>" ;	
					
				}else{
				echo '<li><a href="kategori.php?KategoriID='.$kategoriID.'&page='.$i.'">'.$i.'</a></li>';
				
				}
			
				
			}
			
			?>
			</ul>
			</div>
			
		</div>
		
		
		
		<?php include 'views/sidebar.php'; ?>
		
		
</div>


<?php include 'views/footer.php'; ?>
<---- ders 40 devam -->
</div>

</body>
</html>