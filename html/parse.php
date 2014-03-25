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
 	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
 	<title>Georgia Tech Streaming</title>
<script type="text/javascript" src="flowplayer-3.2.13.min.js"></script>
 	<!-- Bootstrap -->
 	<link href="css/bootstrap.min.css" rel="stylesheet">
 	<link href="css/style.css" rel="stylesheet">
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
    			<li class="active"><a href="#home">Home</a></li>
    			<li class="dropdown">
    				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Streams <b class="caret"></b></a>
    				<ul class="dropdown-menu">
    					<li><a href="/live/crysanthos">Crysanthos</a></li>
    					<li><a href="/live/xumasta">XuMasta</a></li>
    					<li><a href="/live/sunar">Sunar</a></li>
    					<li><a href="/live/deadjo">Deadjo</a></li>
    					<li><a href="/live/shizoli">Shizoli</a></li>
    				</ul>
    			</li>	 
                <li><a href="#setup">Setup</a></li>     
    			<li><a href="#aboutus">About Us</a></li>   				
    		</ul>
    	</div>
    </div>
</nav>

<div id="home"></div>
	<h2>Stream List</h2>
</div>
<?php
	if ($data->bw_in == 0) {
		echo "<p>There are no streams online</p>";
	} else {

		foreach ($data->server->application->live->stream as $stream) {
			if ($stream->bw_in != 0) {
				$link_name = ucfirst($stream->name);
				echo "<a href=http://gtstreams.com/live/$stream->name>$link_name</a>";
			$viewers = $stream->nclients - 1;
			echo "Viewers: $viewers";
			}

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


