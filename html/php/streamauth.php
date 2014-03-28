<?php
	// Example stream authentication
	 
	if ( !empty($_POST) ) {
			switch ( $_POST['call'] ) {
					case "publish":
							$publisher_ip = $_POST['addr'];
	 
							if ( isset($_POST['passphrase']) && $_POST['passphrase'] != NULL ) {
									// Check to see if this is a correct passphrase
									if ($_POST['passphrase'] = "password from SQL") {
											header("HTTP/1.1 202 Accepted"); // 2xx responses will keep session going
									} else {
											header("HTTP/1.1 403 Forbidden"); // Drop the session - incorrect passphrase
									}
							} else {
									header("HTTP/1.1 403 Forbidden"); // Drop the session - no passphrase
							}
					break;
					case "play":
							// The same parameters - name, addr, etc. also work for playing streams over RTMP
							// You could use the on_play parameter to authorize plays against this same file
							// and perhaps limit plays to an IP address in a database, etc.
							// to enforce a paywall or to track visits
					break;
			}
	}
?>

