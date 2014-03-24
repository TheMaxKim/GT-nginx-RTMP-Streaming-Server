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
	echo "Data fetched successfully";
      //print_r($data);
   }

	//Check for streams
	if ($data->bytes_in == 0) {
		echo "No streams online";
	} else {
		echo "Bytes in: $data->bytes_in";
	}

	//List Streams and viewer count
	foreach ($data->server->application->live->stream as $stream) {
		echo $stream->name;
		$viewers = $stream->nclients - 1;
		echo "Viewers: $viewers";
	}
	
}
?>
