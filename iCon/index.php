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
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-72260865-2', 'auto');
	  ga('send', 'pageview');

	</script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<?php
	session_start();//セッションの開始
	//削除
	date_default_timezone_set('Asia/Tokyo');
	$delexpire = strtotime("1 hours ago");
	$deldir = dirname(__FILE__) . '/generate/';
	$dellist = scandir($deldir);
	foreach($dellist as $delvalue){
	    $delfile = $deldir . $delvalue;
	    if(!is_file($delfile)) continue;
	    $delmod = filemtime( $delfile );
	    if($delmod < $delexpire){
			if (pathinfo($delfile,PATHINFO_EXTENSION) == "png") {
				unlink($delfile);
			}
	    }
	}
	$deldir = dirname(__FILE__) . '/create/';
	$dellist = scandir($deldir);
	foreach($dellist as $delvalue){
		$delfile = $deldir . $delvalue;
		if(!is_file($delfile)) continue;
		$delmod = filemtime( $delfile );
		if($delmod < $delexpire){
			unlink($delfile);
		}
	}
	///削除
		function image_generater($image,$genmode = 0){//画像生成
			if (@$_POST["submit"]) {//２回め以降
				$im = ImageCreateFromJPEG( "./image/${image}.jpg" );
				switch ($_POST["color"]) {//色指定
					case 'white':
						$color = imagecolorallocate( $im, 249, 249, 249 );
						break;
					case 'black':
						$color = imagecolorallocate( $im, 51, 51, 51 );
						break;
					case 'red':
						$color = imagecolorallocate( $im, 244, 67, 54 );
						break;
					case 'blue':
						$color = imagecolorallocate( $im, 33, 150, 244 );
						break;
					default:
						$color = imagecolorallocate( $im, 63, 63, 255 );
						break;
				}
				$font = 'yasasisa.ttf';
				imagettftext( $im, 30, 0, 30,60, $color, $font, $_POST['text'] );
				$mysession = $_COOKIE["PHPSESSID"];
				if ($genmode == 0) {
					ImagePNG( $im,"./generate/${mysession}${image}.png" );
					echo "generate/${mysession}${image}.png";
				} else {
					ImagePNG( $im,"./create/${mysession}.png" );
					echo "create/${mysession}.png";
				}
				imagecolordeallocate( $im,$color );
				imagedestroy( $im );
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
				if ($color == "black") {//デフォはblack
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
		if (@$_POST["submit"] == "create") {
			$selectimage = $_POST["image"];
	?>
			<title>memo</title>
			<link rel="apple-touch-icon" href="<?php image_generater("$selectimage",1);?>" >
			<link rel="apple-touch-icon" sizes="180x180" href="<?php image_generater("$selectimage",1);?>">
	</head>
	<body>
		<header>
			<div class="container">
				<h3>メモジェネレータ</h3>
			</div>
		</header>
		<div class="container">
			<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" style="margin-right:15px;"></span><strong>作成しました</strong><p style="margin-left:31px;">共有ボタンからホームに追加してください。<br>分からない方は<a target="_blank" href="http://www.ipodwave.com/iphone/howto/website_home.html#a" class="alert-link">こちら</a>を御覧ください</p></div>
			<img class="iphone-radius center-block" src="<?php image_generater("$selectimage");?>" alt="apple-touch-icon" />
			<div class="row">
				<form class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3" style="margin-top:22px;" action="./" method="post"><!--復元用-->
					<input type="hidden" name="text" value="<?php echo $text; ?>">
					<input type="hidden" name="color" value="<?php echo $_POST["color"]; ?>">
					<input type="hidden" name="image" value="<?php echo $_POST["image"]; ?>">
					<button class="btn btn-default btn-lg btn-block" type="submit" name="submit" value="preview"><span class="glyphicon glyphicon-chevron-left" style="margin-right:15px;"></span>戻る</button>
				</form>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<p class="text-muted">Copyright © 2016 mikan-megane</p>
			</div>
		</footer>
	</body>
	<?php
		} else {
	?>
		<title>メモジェネレータ</title>
	</head>
	<body>
		<header>
			<div class="container">
				<h3>メモジェネレータ</h3>
			</div>
		</header>
		<div class="container">
			<form action="./" method="post">
				<div class="form-group panel panel-default">
					<div class="panel-heading">
						<label class="control-label">メモ</label>
					</div>
					<div class="panel-body">
						<textarea class="form-control" name="text" rows="3" placeholder="Text input"><?php echo $text; ?></textarea>
						<span class="help-block">個人情報の入力はお控えください。</span>
					</div>
				</div>
				<div class="form-group panel panel-default">
					<div class="panel-heading">
						<label class="control-label">文字色</label>
					</div>
					<div class="radio panel-body">
						<label>
							<input class=”form-control hidden” type="radio" name="color" value="black" <?php color_restore("black");?>>
							<div class="point-circle" style="background:rgb(51, 51, 51);"></div>
						</label>
						<label>
							<input class=”form-control hidden” type="radio" name="color" value="white" <?php color_restore("white");?>>
							<div class="point-circle white_visible" style="background:rgb(249, 249, 249);"></div>
						</label>
						<label>
							<input class=”form-control hidden” type="radio" name="color" value="red" <?php color_restore("red");?>>
							<div class="point-circle" style="background:rgb(244, 67, 54);"></div>
						</label>
						<label>
							<input class=”form-control hidden” type="radio" name="color" value="blue" <?php color_restore("blue");?>>
							<div class="point-circle" style="background:rgb(33, 150, 244);"></div>
						</label>
					</div>
				</div>
				<div class="form-group panel panel-default">
					<div class="panel-heading">
						<label class="control-label">背景</label>
					</div>
					<div class="row radio panel-body">
						<?php
						$imgdir = "./image/" ;
						if( is_dir( $imgdir ) && $handle = opendir( $imgdir ) ) {
							while( ($file = readdir($handle)) !== false ) {
								if( filetype( $path = $imgdir . $file ) == "file" ) {
									$file = basename($path,".jpg");
									?>
									<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
										<label>
											<input class=”form-control hidden” type="radio" name="image" value="<?php echo $file; ?>" <?php image_restore($file);?>>
											<img class="iphone-radius img-responsive <?php if($file == "white"){echo white_visible;} ?>" src="<?php image_generater($file);?>" alt="<?php echo $file; ?>" />
										</label>
									</div>
									<?php
								}
							}
						}
						 ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin-bottom:15px;">
						<button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="preview"><span class="glyphicon glyphicon-search" style="margin-right:15px;"></span>プレビュー</button>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<button class="btn btn-success btn-lg btn-block" type="submit" name="submit" value="create"><span class="glyphicon glyphicon-send" style="margin-right:15px;"></span>作成</button>
					</div>
				</div>
			</form>
		</div>
		<br>
		<footer class="footer">
			<div class="container">
				<p class="text-muted">Copyright © 2016 mikan-megane</p>
			</div>
		</footer>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<?php } ?>