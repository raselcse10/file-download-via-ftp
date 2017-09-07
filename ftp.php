<?php
        
    # initialization
    /*
   
    $directoryPath 	= "Directory path";
    $localFile 		= "GAKKCSV.csv";
    $serverFile 	= "GAKKCSV.csv";

    */

    # Connection Settings
    
    $ftpServer 		= "27.131.15.19"; 	# FTP server address
    $ftpUsername 	= "gpcsv"; 			# FTP Username
    $ftpPassword 	= "123@gk"; 		# FTP Password

    # FTP Basic Connection
    $connectionId = ftp_connect($ftpServer);

    # FTP Login
    $ftpLoginResult = ftp_login($connectionId, $ftpUsername, $ftpPassword);


	# Get all content of current directory
	
	$contents = ftp_nlist($connectionId, ".");

	foreach ($contents as $filename) {

		$extention = pathinfo($filename, PATHINFO_EXTENSION);

		if ($extention == "csv") {
			 
			# Download file 
			ftp_get($connectionId, $filename, $filename, FTP_BINARY);

			# get csv data
			$data = [];
			$csvContent = fopen($filename, "r");

			if($csvContent !== FALSE) {

				while(! feof($csvContent)) {

					$data[] = fgetcsv($csvContent, 1000, ",");
				}
			}

			fclose($csvContent);
		}

		/*
		    if ($filename == $serverFile ) { 
		        ftp_get($connectionId, $filename, $filename, FTP_BINARY);
			}
		*/
	}
	
    # close the connection
    ftp_close($connectionId);

    echo '<pre>';
	print_r($data);
	die();
?>