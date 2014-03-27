<?php

$validFunction = "getViewerCount";

$functionName = $_REQUEST['f'];
$streamName = $_POST['streamName'];
if ($functionName == $validFunction) {
	$$functionName();
} else {
	echo "That is not a valid function."
	exit();
}

function getViewerCount() {

}