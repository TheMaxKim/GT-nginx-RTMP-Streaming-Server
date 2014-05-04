<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
$functionName = $_POST['functionName'];
$streamName = $_POST['streamName'];
if ($functionName == "getViewerCount") {
	$functionName($streamName);
} else {
	echo 0;
}

function getViewerCount($streamNameParam) {
	$map_url = 'http://127.0.0.1/stats';
	if (($response_xml_data = file_get_contents($map_url))===false) {
		echo 0;
	} else {
		libxml_use_internal_errors(true);
		$data = simplexml_load_string($response_xml_data);
		if (!$data) {
			echo 0;
			foreach(libxml_get_errors() as $error) {
				//echo "\t", $error->message;
			}
		} else {
			#echo "Data fetched successfully";
			#print_r($data);
		}
	}

if ($data->bw_in == 0 || $data->server->application->live->nclients == 0) {
	echo 0;
	#echo "<p style=\"text-align:center;\">There are no streams online</p>";
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
		if (isset($stream_array)) {
			if (array_key_exists($streamNameParam, $stream_array)) {
				$streamViewers = $stream_array[$streamNameParam];
				echo $streamViewers;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
	}
}