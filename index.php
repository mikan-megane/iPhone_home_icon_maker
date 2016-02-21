<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

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
		function image_generater($image){//画像生成
			if (@$_POST["submit"]) {//２回め以降
				$im = ImageCreateFromJPEG( "./image/${image}.jpg" );
				$color = imagecolorallocate( $im, 63, 63, 255 );
				$font = 'yasasisa.ttf';
				imagettftext( $im, 30, 0, 30,60, $color, $font, $_POST['text'] );
				ImagePNG( $im,"./generate/${image}.png" );

				imagecolordeallocate( $im,$color );
				imagedestroy( $im );
				echo "generate/${image}.png";
			} else {//初回
				echo "image/${image}.jpg";
			}
		}
		function color_restore($color){//カラー選択復元
			if (@$_POST["color"]) {
				if ($_POST["color"] == $color) {
					echo "checked";
				}
			} else {
				if ($color == "white") {//デフォはwhite
					echo "checked";
				}
			}
		}
		function image_restore($image){//画像選択復元
			if (@$_POST["image"]) {
				if ($_POST["image"] == $image) {
					echo "checked";
				}
			} else {
				if ($image == "white") {//デフォはwhite
					echo "checked";
				}
			}
		}
		if (@$_POST["text"]) {//$text 復元
			$text = $_POST["text"];
		} else {
			$text = "";
		}
		if (@$_POST["submit"] == "作成") {
			$selectimage = $_POST["image"];
	?>
			<link rel="apple-touch-icon" href="<?php image_generater("$selectimage");?>" >
			<link rel="apple-touch-icon" sizes="180x180" href="<?php image_generater("$selectimage");?>">
			<title>memo</title>
	</head>
	<body>
		<div class="container">
			<img class="iphone-radius" src="<?php image_generater("$selectimage");?>" alt="apple-touch-icon" />
		</div>
	</body>
	<?php
		} else {
	?>
		<title>メモジェネレータ</title>
  </head>
  <body>
	  <div class="container">
		  <form action="./" method="post">
			  <div class="form-group">
				  <label class="control-label">メモ</label>
				  <textarea class="form-control" name="text" rows="5" placeholder="Text input"><?php echo $text; ?></textarea>
			  </div>
			  <div class="form-group">
				  <label class="control-label">文字色</label>
				  <div class="radio">
					  <label>
						  <input class=”form-control” type="radio" name="color" value="white" <?php color_restore("white");?>>
						  <div class="point-circle" style="background:rgb(249, 249, 249);"></div>
					  </label>
					  <label>
						  <input class=”form-control” type="radio" name="color" value="black" <?php color_restore("black");?>>
						  <div class="point-circle" style="background:rgb(51, 51, 51);"></div>
					  </label>
					  <label>
						  <input class=”form-control” type="radio" name="color" value="red" <?php color_restore("red");?>>
						  <div class="point-circle" style="background:rgb(244, 67, 54);"></div>
					  </label>
					  <label>
						  <input class=”form-control” type="radio" name="color" value="blue" <?php color_restore("blue");?>>
						  <div class="point-circle" style="background:rgb(33, 150, 244);"></div>
					  </label>
				  </div>
			  </div>
			  <div class="form-group">
				  <label class="control-label">背景</label>
				  <div class="radio">
					  <label>
						  <input class=”form-control” type="radio" name="image" value="white" <?php image_restore("white");?>>
						  <img class="iphone-radius" src="<?php image_generater("white");?>" alt="white" />
					  </label>
					  <label>
						  <input class=”form-control” type="radio" name="image" value="black" <?php image_restore("black");?>>
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
