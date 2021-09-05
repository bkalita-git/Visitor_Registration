<?php
date_default_timezone_set("Asia/Kolkata");
$servername = "localhost";
$username = "XXXX";
$password = "XXXXXXXX";
$dbname = "registration";
$conn = new mysqli($servername, $username, $password, $dbname);
$ext="png";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$Name = ucwords($_POST['Name']);
	$Addr = ucwords($_POST['Addr']);
	$Ph = $_POST['Ph'];
	$whomToMeet = ucwords($_POST['whomToMeet']);
  $target_dir = "../images/";
  $file_name = $Name.'_'.$Addr.'_'.$Ph;
  //$file_name = basename( $_FILES["img_file"]["name"]);
  $target_dir = $target_dir . $file_name;
  $uploadOk=1;

  if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $target_dir)) {
		  
	  if (empty($Name) && empty($Ph) ) {
	    echo "Name is empty";
	    
	  } else {
		if ($conn->connect_error) {
	  		die("Connection failed: " . $conn->connect_error);
	  	}
		//select count(Name) as total from visitor 
		//alter table visitor add sl_no int NOT NULL AUTO_INCREMENT primary key;
		//alter table visitor add Date varchar(11);
		//alter table visitor add Time varchar(30);
		//select COUNT(Name) as DailyTotal from visitor where Date='$Date';
		$Date = date("d-m-Y");
		$Time = date("h:i:sa");
		$sql = "INSERT INTO visitor (Name,Addr,Ph,whomToMeet,Date,Time) VALUES('$Name','$Addr','$Ph','$whomToMeet','$Date','$Time')";
		$get_daily_total = "select COUNT(Name) as DailyTotal from visitor where Date='$Date'";
		$get_total = "select count(Name) as Total from visitor";
		if ($conn->query($sql) === TRUE) {

			$q1 = $conn->query($get_daily_total);
			$q2 = $conn->query($get_total);
			$r1 = $q1->fetch_array();
			$r2 = $q2->fetch_array();
			$DailyTotal = $r1['DailyTotal'] ;
			$Total= $r2['Total'];

			$SL_NO = str_pad($Total, 5, "0", STR_PAD_LEFT).str_pad($DailyTotal, 4, "0", STR_PAD_LEFT); 
	  		//echo "New record created successfully";
			//echo json_encode($response);
			echo "
			
			
			<html>
			<style>
				body{
					margin:auto;
				}
				@page {
					size: auto;  
					margin:0;  
				}
		
		}
			</style>
			<body>
				<div id='back'>
					<img style='width:1187px; position: absolute; margin: auto;' src='full_visitor_back_A4.png'>
					<div style=' font-weight:bold; font-size:25px; left:150px; top:201px; position: absolute;' id='date1'>
                		".$SL_NO."
            		</div>
		
					<div style='font-weight:bold; left:970px; top:206px; position: absolute;' id='date1'>
						".$Date."
					</div>
					<div  style='font-weight:bold; left:970px; top:261px; position: absolute;' id='time1'>
						".$Time."
					</div>
					<div style='left:866px; top:370px; position: absolute;'id='pro1'>
						<img style='width:200px;' src='images/".$file_name."'>
					</div>
					<div style=' font-weight: bold; font-size:25px; left:350px; top:375px; position: absolute; font-size: 22px;'id='name1'>
						".$Name." 
					</div>
					<div style='font-weight: bold; font-size:25px; left:350px; top:433px; position: absolute;'id='phone1'>
						".$Ph."
					</div>
					<div style='font-weight: bold; font-size:25px; left:350px; top:491px; position: absolute;' id='addr1'>
						".$Addr."
					</div>
					<div style='font-weight: bold; font-size:25px; left:350px; top:610px; position: absolute;' id='whom1'>
						".$whomToMeet."
					</div>

					<div style=' font-weight:bold; font-size:25px; left:150px; top:1041px; position: absolute;' id='date1'>
						".$SL_NO."
					</div>
					<div style='font-weight:bold; left:970px; top:1049px; position: absolute;' id='date1'>
						".$Date."
					</div>
					<div  style='font-weight:bold; left:970px; top:1104px; position: absolute;' id='time1'>
						".$Time."
					</div>
					<div style='left:866px; top:1204px; position: absolute;'id='pro1'>
						<img style='width:200px;' src='images/".$file_name."'>
					</div>
					<div style='font-weight: bold; font-size:25px; left:350px; top:1218px; position: absolute; font-size: 22px;'id='name1'>
						".$Name."
					</div>
					<div style='font-weight: bold; font-size:25px; left:350px; top:1276px; position: absolute;'id='phone1'>
						".$Ph."
					</div>
					<div style='font-weight: bold; font-size:25px; left:350px; top:1334px; position: absolute;' id='addr1'>
						".$Addr."
					</div>
					<div style='font-weight: bold; font-size:25px; left:350px; top:1448px; position: absolute;' id='whom1'>
						".$whomToMeet."
					</div>
		
		
				</div>
			</body>
		</html>
				
				";
		} else {
	  		//echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	  
	  }
    
  } else {
    echo "Sorry, there was an error uploading your file.";
  }

}
?>
