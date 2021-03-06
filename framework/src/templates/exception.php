<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Error 404</title>
		<style type="text/css">
		
		::selection{ background-color: #E13300; color: white; }
		::moz-selection{ background-color: #E13300; color: white; }
		::webkit-selection{ background-color: #E13300; color: white; }
		
		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}
		
		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}
		
		h1 {
			/*color: #444;
			background-color: transparent;*/
			color: #fff;
			background-color: #607D8B;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}
		
		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}
		
		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
		
		p {
			margin: 12px 15px 12px 15px;
		}
		a {
			margin-left: 2rem;
			display: inline-block;
			height: 22px;
			line-height: 22px;
			background: #cd5c5c;
			color: #fff;
			padding: 0.2rem 0.5rem;
			border-radius: 2px;
			text-decoration: none;
		}
		</style>
	</head>

	<body>
		<div id="container">
			<h1>Whoops!! Exception</h1>
			<p><b>File:</b> <?=$file?></p>
			<p><b>Line:</b> <?=$line?></p>
			<p><b>Message:</b> <?=$mssg?></p>
			<p><b>Trace:</b> <pre style="padding-left:20px"><?=$trace?></pre></p>
		</div>
	</body>
</html>