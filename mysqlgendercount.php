<?php
    $username = "csc424group8-ro"; 
    $password = "ilovedick2";   
    $host = "cs424group8@mysql.uic.edu";
    $database="cs424group8";
    
	// Create connection
    $con = mysqli_connect($host, $username, $password, $database);
	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

	// url will be sqlquery?id=3 	
	 $id = $_GET['id'];
	
	$sql = "\n"
    . "SELECT max(`from_station_id`) as id,\n"
    . " count(case when `gender`='male' then 1 end) as male_cnt,\n"
    . " count(case when `gender`='female' then 1 end) as female_cnt,\n"
    . " count(*) as total_cnt\n"
    . " FROM `divvy_trips_distances`\n"
    . " where `from_station_id` =" . $id
    . " group by `from_station_id`";
		
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