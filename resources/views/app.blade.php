<html>
	<head>
		<title>XIV Sigs</title>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans" media="screen" charset="utf-8">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					@yield("content")
				</div>
			</div>

			<footer class="row">
				<div class="col-lg-12">
					<p>Copyright © 2015 Christopher König</p>
				</div>
			</footer>
		</div>

		<script src="http://code.jquery.com/jquery-2.1.4.min.js" charset="utf-8"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.2/handlebars.min.js"></script>
		@yield("scripts")
	</body>
</html>
