<!DOCTYPE html>

<html>
	<head>
		<style type="text/css">
			.red {
				color: red;
			}
		</style>
	</head>
	<body>
		
		<!-- Purpose of this page is to provide confirmation of data input -->
		<!-- Data that was input on the previous page is sent to the database -->
		<!-- The database is then queried to insure that the entry was logged -->
		<?php
		
		mainContainer();
		
		/* Main container function */
		/* Houses all function calls within this script */
		function mainContainer(){
			
			/* Variables to capture user post values */
			/* Sport and Booktype are arrays of values */
			$booktype = $_POST['booktype'];
			$sport = $_POST['sport'];
			$activity= $_POST['activity'];
			$fillin1 = $_POST['fillin1'];
			$fillin2 = $_POST['fillin2'];
			$comments = $_POST['comments'];
			
			/* Variables to store table names */
			$maintable = "main";
			$sporttable = "sport";
			$activitytable = "activity";
			
			/* Sport and activity tables each contain unique one unique field which must be identified */
			$sportfield = "selectsport";
			$activityfield = "selectactivity";
			
			
			/* Generic database variables: servername, username, pw, db */
			$servername = "localhost";
			$username = "root";
			$password = "inagotada";
			$dbname = "Questions";
			
			/* Make connection to DB and test connection */
			$conn = new mysqli($servername, $username, $password, $dbname);
			if (mysqli_connect_errno()){
				echo "Connection failed";
			}
			
			/* Main Table SQL */
			/* Update this table first in order to create key for use in other tables*/
			/* ID is then used for key in Sports and Activity Tables */
			$mainsql = "INSERT INTO $maintable (booktype, fillin1, fillin2, comments) VALUES ('$booktype','$fillin1','$fillin2','$comments')";

			/* These function calls will begin inserting data into database */
			/* The sport and activity arrays must first be iterated */
			$last_id = postStatic($conn, $mainsql);
			generateDynamic($conn, $last_id, $sport, $sporttable, $sportfield);
			generateDynamic($conn, $last_id, $activity, $activitytable, $activityfield);
			
			/* Provide summary back to user */
			echo "<p>Your entry will be in red font in the list below.  If you can find it, you know your entry was successful!</p>";
			
			/* Now we are going to query the database and produce ALL results */
			queryMain($last_id, $conn, $sportfield, $activityfield, $sporttable, $activitytable);
			
		}		

		
		/* Posts the main table.  Considered static because no array iteration required */
		/* Function returns ID to be used in sport and activity inserts */
		function postStatic($conn, $sql){
			if($conn->query($sql) === TRUE){
				$last_id = $conn->insert_id;
				return $last_id;
			} else {
				echo "Error:" . $sql . "<br" . $conn->error;
				return 0;
			}
		}
		
		/* Generate SQL for sports and activity. */
		/* This is necessary because users may select multiple sports or activities */
		function generateDynamic($conn, $myID, $myarray, $mytable, $myfield){
			foreach($myarray as $entry){
				$sql = "INSERT INTO $mytable (id, $myfield) VALUES ('$myID', '$entry')";
				postDynamic($conn, $sql);
			}
		}
		
		/* Posts to either sport or activity table.  Considered dynamic because ID derived from main table */
		function postDynamic($conn, $sql){
			if($conn->query($sql) !== TRUE){
				echo "Error:" . $sql . "<br>" . $conn->error;
			}
		}
		
		/* Echo the entries back to the user */
		/*Sport and activity arrays require loop  to show data*/
		function echoResult($myarray){
			$ctr = 1;
			foreach($myarray as $entry){
				echo "<p>$ctr : $entry</p>";
				$ctr += 1;
			}
		}
		
		/* Function to Query database and post full results */
		function queryMain($last_id, $conn, $sportfield, $activityfield, $sporttable, $activitytable){
			$mainquery = "SELECT * FROM main";
			$result = $conn->query($mainquery);
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()){
					if ($row["id"] == $last_id){
						echo "<div class='red'>";
						echo "<p>id: " . $row["id"] . " - Booktype: " . $row["booktype"] . " - Loves: " . $row["fillin1"] . " - Hates: " . $row["fillin2"] . " - Comments: " . $row["comments"] . "</p>";
						queryOther($conn, $row["id"], $sporttable, $sportfield);
						queryOther($conn, $row["id"], $activitytable, $activityfield);
						echo "</div>";						
					} else {
						echo "<p>id: " . $row["id"] . " - Booktype: " . $row["booktype"] . " - Loves: " . $row["fillin1"] . " - Hates: " . $row["fillin2"] . " - Comments: " . $row["comments"] . "</p>";
						queryOther($conn, $row["id"], $sporttable, $sportfield);
						queryOther($conn, $row["id"], $activitytable, $activityfield);
					}
				}
			}
		}
		
		/* Function to query tables that contain multiple entries per user */
		function queryOther($conn, $currentid, $currenttable, $currentfield){
			$otherquery = "SELECT $currentfield FROM $currenttable WHERE id='$currentid'";
			$result = $conn->query($otherquery);
			echo "Selected $currenttable: ";
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()){
					echo $row["$currentfield"] . " ";
				}
			}
			echo "</br>";
		}
		
							
		?>
	</body>
</html>

