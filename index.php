<!doctype HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>File Shrink</title>
		<meta name="description" content="File Shrink is a script to minify CSS and JavaScript files.">
		<meta name="author" content="Vin&iacute;cius Ebersol">
		
		<style type="text/css">
			body {
				font:normal 13px Helvetica, Arial, sans-serif; 
			}
			
			#general {
				width:650px;
				margin:0 auto;
			}
			
			#general > h1, #general > p {
				text-align:center;
			} 
			
			p {
				margin:20px 0;
			}
			
			input, select, textarea {
				width:600px;
				font-size:24px;
				color:#666666;
			}
			
			textarea {
				height:200px;
			}
			
			input[type="submit"] {
				width:auto;
			}
			
			label {
				font-size:24px;
			}
			
			small {
				color:#E00005;
				font-size:12px;
			}
		</style>
		
	</head>
	<body>
		<div id="general">
			<h1>File Shrink</h1>
			
			<p>Fill form to minify your files. This script uses Reducisaurus webservice to minify your files.</p>
			
			<div id="feedback">
				<?php
					if (!empty($_POST)) {
						require_once('FileShrink.php');
						new FileShrink();
					}
				?>
			</div>
		
			<fieldset>
				<form method="post" action="index.php">
					<p>
						<label>Type:</label><br>
						<select name="type">
							<option value=""></option>
							<option value="js" <?php echo (!empty($_REQUEST['type']) && $_REQUEST['type'] === 'js')  ? 'selected="selected"' : ''; ?>>Javascript</option>
							<option value="css" <?php echo (!empty($_REQUEST['type']) && $_REQUEST['type'] === 'css')  ? 'selected="selected"' : ''; ?>>CSS</option>
						</select>
					</p>
					
					<p>
						<label>Path:</label><br>
						<input type="text" name="path" value="<?php echo !empty($_REQUEST['path']) ? $_REQUEST['path'] : ''; ?>"><br>
						<small>Eg.: E:\workspace\PROJECTNAME\_css</small> 
					</p>
					
					<p>
						<label>Files:</label><br>
						<textarea name="files" rows="20" cols="100"><?php echo !empty($_REQUEST['files']) ? $_REQUEST['files'] : ''; ?></textarea><br>
						<small>(in order of importance and comma separated)</small>
					</p>
					
					<p>
						<label>Filename output:</label><br>
						<input type="text" name="filename" value="<?php echo !empty($_REQUEST['filename']) ? $_REQUEST['filename'] : ''; ?>"><br>
						<small>Eg.: application.min<small>
					</p>
					
					<p style="text-align:center;">
						<input type="submit" name="submit">
					</p>
				</form>
			</fieldset>
		</div>
	</body>
</html>