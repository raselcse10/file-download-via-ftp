<?php
        
    # initialization
    /*
   
    $directoryPath 	= "Directory path";
    $localFile 		= "mycsv.csv";
    $serverFile 	= "mycsv.csv";

    */

    # Connection Settings
    
    $ftpServer 		= "17.121.25.19"; 	# FTP server address
    $ftpUsername 	= "myuser"; 		# FTP Username
    $ftpPassword 	= "12345"; 		# FTP Password

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
