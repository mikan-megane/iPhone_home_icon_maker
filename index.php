<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>メモジェネレータ</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php
		$myurl = "http://mikan-php.pe.hu/"
		function image_generater($image){
			global $myurl;
			if (@$_POST["submit"]) {
				$im = ImageCreateFromJPEG( "./image/${image}.jpg" );
				$color = imagecolorallocate( $im, 63, 63, 255 );
				$font = 'yasasisa.ttf';
				imagettftext( $im, 30, 0, 30,60, $color, $font, $text );
				ImagePNG( $im,"generate/${image}.png" );

				imagecolordeallocate( $im,$color );
				imagedestroy( $im );
				return "${myurl}generate/${image}.png";
			} else {
				return "${myurl}image/${image}.png";
			}
		}
		if ($submit == "作成") {
			$text = @$_POST['text'];
	?>
			<link rel="apple-touch-icon" href="generate/apple-touch-icon.png" >
			<link rel="apple-touch-icon" sizes="180x180" href="generate/apple-touch-icon.png">
	<?php
		} else {
	?>
  </head>
  <body>
	  <div class="container">
		  <form action="index.php" method="post">
			  <div class="form-group">
				  <label class="control-label">メモ</label>
				  <textarea class="form-control" name="text" rows="5" placeholder="Text input"></textarea>
			  </div>
			  <div class="form-group">
				  <label class="control-label">背景</label>
				  <div class="radio">
					  <label>
						  <input class=”form-control” type="radio" name="image" value="white" checked>
						  <img class="iphone-radius" src="<?php image_generater("white");?>" alt="white" />
					  </label>
					  <label>
						  <input class=”form-control” type="radio" name="image" value="black">
						  <img class="iphone-radius" src="<?php image_generater("black");?>" alt="black" />
					  </label>
				  </div>
			  </div>
			  <div class="raw">
				  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					  <input class="btn btn-primary form-control" type="submit" name="submit" value="プレビュー">
				  </div>
				  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					  <input class="btn btn-primary col-xs-6 col-sm-6 col-md-6 col-lg-6 form-control" type="submit" name="submit" value="作成">
				  </div>
			  </div>
		  </form>
	  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php } ?>
