<?php
	header("Access-Control-Allow-Origin: *");
    $username = "hpraja2"; 
    $password = "ilovedick";   
    $host = "cs424group8.mysql.uic.edu";
    $database="cs424group8";
    
	// Create connection
    $con = mysqli_connect($host, $username, $password, $database);
	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

	
	$sql = "\n"
	. "SELECT count(`from_station_id`) as outflow, count(`to_station_id`) as inflow \n"
    . " FROM `divvy_trips_distances`";

		
    $query = mysqli_query($con, $sql);
    
    if ( ! $query ) {
        echo mysqli_error($con);
        die;
    }
    
    $data = array();
    
    for ($x = 0; $x < mysqli_num_rows($query); $x++) {
        $data[] = mysqli_fetch_assoc($query);
    }
	
	while($row = mysqli_fetch_array($query)){
	 echo $row['outflow'] . " ". $row['inflow'];
	 echo "<br>";
	}
    
    echo json_encode($data);     
     
    mysqli_close($con);
?>