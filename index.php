<!DOCTYPE html>

<html>
	<!-- The form below is sent to new_personality.php -->
	<!-- From there, the data is sent to three different databases -->
	
	<!-- Schemas are as follows:-->
	<!-- main (id(INT AUTO_INCREMENT),booktype, fillin1, fillin2, comments) -->
	<!-- activity (entryid(INT AUTO_INCREMENT), id(derived from main), activity) -->
	<!-- sport (entryid(INT AUTO_INCREMENT), id(derived from main), sport) -->
	
	
	<body>
		<h1>Personality Survey</h1>

		<form class="text-center" action="new_personality.php" method="post">
			
			<p><p><b>Please select the sports you most enjoy watching on TV:</b></p>
				<input type="checkbox" name="sport[]" value="Football"/>Football
				<input type="checkbox" name="sport[]" value="Tennis"/>Tennis
				<input type="checkbox" name="sport[]" value="Baseball"/>Baseball
				<input type="checkbox" name="sport[]" value="Golf"/>Golf
				<input type="checkbox" name="sport[]" value="Nascar"/>Nascar
			</p>			
			<p><p><b>Please select all activities you have done in the past year:</b></p>
				<input type="checkbox" name="activity[]" value="Hiking"/>Hiking
				<input type="checkbox" name="activity[]" value="Sunbathing"/>Sunbathing
				<input type="checkbox" name="activity[]" value="Read"/>Reading
				<input type="checkbox" name="activity[]" value="Partying"/>Partying
				<input type="checkbox" name="activity[]" value="Games"/>Board Games
			</p>
			<p><p><b>Which type of books do you like most?</b></p>
				<select id="booktype" name="booktype">
				<option value="Horror">Horror</option>
				<option value="Mystery">Mystery</option>
				<option value="SciFi">SciFi</option>
				<option value="Love">Love</option>
				</select>
			</p>
			<p><b>Fill in the sentence:</b>I love <input type="text" name="fillin1" size="15" maxlength="30"/> and I hate <input type="text" name="fillin2" size="15" maxlength="30"/></p>
			<p><p><b>Please provide a short description of yourself</b></p>
				<textarea name="comments" cols="40" rows="8" maxlength="200"></textarea>
			</p>

			<p><input type="submit" value="submit"></p>

		</form>
	</body>


</html>

