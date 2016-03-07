<?php
function is_current( $uri = "" ) {
	$uri = trim( $uri, "/" );
	$request_uri = $_SERVER['REQUEST_URI'];

	if( $uri && strpos($request_uri."/", "/".$uri."/", 0) !== FALSE ) {
		return true;
	}
	$request_uri = trim(str_replace( "/index.php", "", $request_uri ), '/');
	if( !$uri && !$request_uri ) {
		return true;
	}
	return false;
}

function echo_current( $uri = "" ) {
	if(is_current( $uri )) {
		echo 'active';
	};
}
?>
<header>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">みかんのPHP</a>
			</div>

			<div class="collapse navbar-collapse" id="navbarEexample1">
				<ul class="nav navbar-nav">
					<li class="<?php is_current("iCon"); ?>"><a href="/iCon">メモジェネレータ</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>
