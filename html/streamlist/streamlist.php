<?php
$map_url = 'http://127.0.0.1/stats';
if (($response_xml_data = file_get_contents($map_url))===false){
		echo "Error fetching XML\n";
} else {
	 libxml_use_internal_errors(true);
	 $data = simplexml_load_string($response_xml_data);
	 if (!$data) {
			 echo "Error loading data\n";
			 foreach(libxml_get_errors() as $error) {
					 echo "\t", $error->message;
			 }
	 } else {
	#echo "Data fetched successfully";
				#print_r($data);
	 }


	
}
?>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
	<title>Georgia Tech Streaming</title>
	<script src="js/holder.js"></script>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="theme.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
		<style>

		</style>
</head>

<body>
	<!-- Navbar -->
<nav class="navbar navbar-custom" role="navigation">
		<div class="container">
			<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="http://www.gtstreams.com">GT Streaming</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav pull-right" id="section-links">
					<li><a href="http://www.gtstreams.com">Home</a></li>
					<li class="active"><a href="#">Streams</a></li>	 
					<li><a href="http://www.gtstreams.com/setup">Setup</a></li>     
					<li><a href="http://www.gtstreams.com/aboutus">About Us</a></li>   				
				</ul>
			</div>
		</div>
</nav>

<div id="home"></div>
	<h2>Stream List</h2>


<?php
	if ($data->bw_in == 0 || $data->server->application->live->nclients == 0) {
		echo "<p style=\"text-align:center;\">There are no streams online</p>";
	} else {

		foreach ($data->server->application->live->stream as $stream) {
			if ($stream->bw_in != 0) {
				
				$viewers = -1;
				foreach ($stream->client as $client) {
					if ($client->address != "127.0.0.1") {
						$viewers++;
					}
				}
				$stream_array["$stream->name"] = "$viewers";
			}

		}
		arsort($stream_array);
		foreach ($stream_array as $name=>$viewer_count) {
		
			$link_name = ucfirst($name);

			$thumbnail_name = $name . ".png";

			$link = "http://www.gtstreams.com/live/$name";
			echo "<div style=\"height:250px;width:300px;float:left;margin:5px;\">";
			echo "<p style=\"text-align:center;\">$link_name</p>";
			echo "<a href=$link><img src=\"thumbnails/$thumbnail_name\" alt=\"Image not found\"></a>";
			#echo "<a href=$link><img data-src=\"holder.js/300x200/#000:#fff/text:$link_name\" alt=\"...\"></a>";
			echo "<div class=\"caption\"><p style=\"text-align:center;\">Viewers: $viewer_count</p> </div>";
			echo "</div>";
		
		}
	}
?>

<p id="streaminfo"></p>

<script type="text/javascript">
</script>



<div id="aboutus"></div>



<!--JavaScript-->
<script src="js/jquery-2.1.0.min.js"></script>
<script src="js/bootstrap.js"></script>


</body>

</html>


