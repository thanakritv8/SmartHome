<?php
	include "../connect.php";
	if (isset($_GET['id'])){
		$id = $_GET['id'];
		if($id != ""){
			$device1 = 0;
			$device2 = 0;
			$device3 = 0;
			$sql = "SELECT 	statusDevice1, 	statusDevice2, 	statusDevice3 FROM Box WHERE idBox = '" . $id . "'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
		    	// output data of each row
		    	while($row = $result->fetch_assoc()) {
		    		$device1 = $row["statusDevice1"];
					$device2 = $row["statusDevice2"];
					$device3 = $row["statusDevice3"];
		    	}
		    	$sql = "UPDATE box SET ";
				$sql .="statusOnline = '1' ";
				$sql .="WHERE idBox = '" . $id . "' ";
				$objQuery = mysqli_query($conn, $sql);
			} else {
		    	echo "0 results";
			}
			$conn->close();
			echo $device1 . "," . $device2 . "," . $device3;
		}else{
			echo "No Id";
		}
	}else{
		echo "No Id & Ip";
	}
?>