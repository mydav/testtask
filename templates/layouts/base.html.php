<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="/">
    <!--Здесь meta,link**** head.html.php -->
    <?=$head?>
    <?=@"<title>$title</title>" ?>
</head>
<body>
<?= $nav ?>
	<div class="container">

		<div class="row">
			<div class="col-xs-12  col-md-8">
			 <!--Здесь отображение Tasks -->
			<?=$subTemplate ?>
			</div>
        </div>    
	</div>
	<!--Здесь футер вместе с копирайтом footer.html.php -->
	<?=$footer?>
	<script src="js/main.js"></script> 
</body>
</html>