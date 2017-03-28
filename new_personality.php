<html>
	<body>
		
		<!-- Purpose of this page is to provide confirmation of data input -->
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
			$password = "XXXXXXX";
			$dbname = "Questions";
			
			/* Make connection to DB and test connection */
			$conn = new mysqli($servername, $username, $password, $dbname);
			if (mysqli_connect_errno()){
				echo "Connection failed";
			} else {
				echo "Successfully connected to database";
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
			echo "<p>If there are no error messages above, your entry was successful! The contents of your entry are found below</p>";
			echo "<p><b>Sports on TV:</b></p>";
			echoResult($sport);
			echo "<p><b>Activities in Last Year:</b></p>";
			echoResult($activity);
			echo "<p><b>You love: </b> $fillin1</p>";
			echo "<p><b>You hate: </b> $fillin2</p>";
			echo "<p><b>When asked to describe yourself, you said:</b></p>";
			echo "<p>$comments</p>";
			
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
		
							
		?>
	</body>
</html>

