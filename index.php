<!doctype HTML>
<html>
	<head>
		<title>Test</title>
	</head>
	<body>
		<div id="feedback">
			<?php
				if (!empty($_POST)) {
					require_once('FileShrink.php');
					new FileShrink();
				}
			?>
		</div>
	
		<fieldset>
			<legend>Fill all fields</legend>
			
			<form method="post" action="index.php">
				<p>
					<label>Type:</label>
					<select name="type">
						<option value=""></option>
						<option value="js">Javascript</option>
						<option value="css">CSS</option>
					</select>
				</p>
				
				<p>
					<label>Path:</label>
					<input type="text" name="path" value=""> Eg.: E:\workspace\PROJECTNAME\_css 
				</p>
				
				<p>
					<label>Files: <small>(in order of importance and comma separated)</small></label>
					<textarea name="files" rows="20" cols="100"></textarea>
				</p>
				
				<p>
					<label>Filename output:</label>
					<input type="text" name="filename" value=""> Eg.: application.min
				</p>
				
				<p>
					<input type="submit" name="test" value="minify">
				</p>
			</form>
		</fieldset>
	</body>
</html>