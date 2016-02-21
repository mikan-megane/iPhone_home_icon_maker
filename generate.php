<!DOCTYPE html>
<html>
	<head>
		<?php
			$text = $_POST['text'];
			$image = $_POST['image'];

			$im = ImageCreateFromJPEG( "./image/${image}.jpg" );
			$color = imagecolorallocate( $im, 63, 63, 255 );
			$font = 'yasasisa.ttf';
			imagettftext( $im, 30, 0, 30,60, $color, $font, $text );
			ImagePNG( $im,"./image.png" );

			imagecolordeallocate( $im,$color );
			imagedestroy( $im );
		?>
		<meta http-equiv="content-language" content="ja">
		<meta charset="UTF-8">
		<title>メモ</title>
		<link rel="apple-touch-icon" href="./image.png" >
		<link rel="apple-touch-icon" sizes="180x180" href="./image.png">
	</head>
	<body>
		<img src="./image.png" alt="" />
		メニューから「ホーム画面に追加」を行ってください。
	</body>
</html>
