<?php
	$map_url = 'http://www.gtstreams.com/stats';
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

if ($data->bw_in == 0 || $data->server->application->live->nclients == 0) {
	#echo "<p style=\"text-align:center;\">There are no streams online</p>";
	} else {

		foreach ($data->server->application->live->stream as $stream) {
			if ($stream->bw_in != 0) {
				
				$viewers = $stream->nclients - 1;
				$stream_array["$stream->name"] = "$viewers";
			}

		}
		arsort($stream_array);
		reset($stream_array);
	}
?>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
	<title>Georgia Tech Streaming</title>
	<script type="text/javascript" src="../js/jquery-2.1.0.min.js"></script>

	<script type="text/javascript" src="/flowplayer/flowplayer-3.2.13.min.js"></script>
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
				<a class="navbar-brand" href="#">GT Streaming</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav pull-right" id="section-links">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="/streams">Streams</a></li>  	 
					<li><a href="/setup">Setup</a></li>  
					<li><a href="/aboutus">About Us</a></li>    				
				</ul>
			</div>
		</div>
	</nav>

	<div id="home"></div>
	<h2 id="streamName">Featured Stream</h2>

	<div id="playerContainer">
		<div class="wrapper">
			<div class="sixteen-by-nine-aspect-ratio"></div>
			<div id="player"></div>
		</div>

	<p id="viewerCount" style="text-align:right; color:white;">Viewers: 0</p>

	</div>



<p id="streaminfo"></p>

<script type="text/javascript">

m = location.href.match(/^http:\/\/([a-zA-Z0-9._-]+)\/(.*)$/);

host = m[1];
name = "<?php echo each($stream_array)[key];?>";

getViewers();
function capitaliseFirstLetter(string)
{
	return string.charAt(0).toUpperCase() + string.slice(1);
}

if (name != "") {
	document.getElementById('streamName').innerHTML = "Featured Stream: " + capitaliseFirstLetter(name);
}

flowplayer("player", "/flowplayer/flowplayer-3.2.18.swf", {
	clip: {
		url: name,
		live: true,
		scaling: "fit",
		provider: "rtmp",
		bufferLength: 0
	},
	canvas: {
		backgroundGradient: 'none',
		backgroundColor: '#000000'
	},

	plugins: {
	controls: {
			url: '/flowplayer/flowplayer.controls-3.2.16.swf',
			height: 25,
		time: false,
		backgroundGradient: 'none',
		backgroundColor: '#000000',
		opacity: 0.6,
		scrubber: false,
		volumeColor: '#248AFF'
		},

	rtmp: {
			url: "/flowplayer/flowplayer.rtmp-3.2.13.swf",
			netConnectionUrl: "rtmp://" + host + ":10200/live"
		}
	}
});

setInterval(getViewers, 5000);

function getViewers() {
	$.ajax({
		url:'../php/viewercount.php',
		type: 'post',
		data: {functionName: 'getViewerCount', streamName: name},
		success: function(result) {
			document.getElementById('viewerCount').innerHTML = "Viewers: " + parseInt(result,10);
		},
		error: function(result) {
			document.getElementById('viewerCount').innerHTML = "Viewers: " + 0;
		}
	});
	return false;
}
</script>

<div id="aboutus"></div>
	<h4>Welcome to the bare bones tech demo of the GT streaming project.</h4>



<!--JavaScript-->
<script src="js/jquery-2.1.0.min.js"></script>
<script src="js/bootstrap.js"></script>


</body>

</html>
