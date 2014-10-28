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

	// url will be sqlquery?id=3 	
	 $id = $_GET['id'];
	
	$sql = "\n"
	. "Select Sum( Case When `from_station_id` =" . $id
	. " Then 1 Else 0 End ) As InFlow,\n"
    . "Sum( Case When`to_station_id` =" . $id
	. " Then 1 Else 0 End ) As OutFlow\n"
    . "From divvy_trips_distances\n"
    . "\n"
    . "";
		
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
	 echo $row['from_station_id'] . " ". $row['male_cnt'] . " ". $row['female_cnt'];
	 echo "<br>";
	}
    
    echo json_encode($data);     
     
    mysqli_close($con);
?>