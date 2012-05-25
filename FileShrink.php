<?php

Class FileShrink {
	private $webserviceUrl = 'http://reducisaurus.appspot.com/';

	public function __construct() {
		$this->data = $_POST;
		$this->call();
	}
	
	public function call() {
		$ch = curl_init();
		
		echo '<p>Activity started...</p>';
		
		// Expect blank to avoid proxy errors.
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Expect:"));
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_URL, $this->getURL());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->setParams());
		echo '<p>Sending files...</p>';
		
		//curl_setopt($ch, CURLOPT_HEADER, TRUE);

		$this->response = curl_exec($ch);
		echo '<p>Response received!</p>';
		curl_close($ch);
		
		echo '<p>Saving file</p>';
		$this->saveFile();
	}
	
	public function setParams() {
		$files = explode(',', $_POST['files']);
		$params = array();
		
		$i = 0;
		
		foreach ($files as $i => $file) {
			$fullFilePath = $this->getPath() . trim($file);
			$params['file' . (string)($i + 1)] = "@$fullFilePath";
		}
		
		return $params;
	}
	
	public function getURL() {
		return $this->webserviceUrl . $this->data['type'];
	}
	
	public function getPath() {
		$pathInfo = pathinfo(__FILE__);
		$lastChar = substr($this->data['path'], -1);
		
		if (!empty($this->data['path']) && ($lastChar === '/' || $lastChar === '\\')) {
			return $this->data['path'];
		}
		
		return (!empty($this->data['path']) ? $this->data['path'] : $pathInfo['dirname']) . DIRECTORY_SEPARATOR;
	}
	
	public function saveFile() {
		$filename = $this->data['filename'] . '.' . $this->data['type'];
	
		if (file_exists($this->getPath() . $filename)) {
			$filename = $this->data['filename'] . '-' . date('Ymd-His') . '.' . $this->data['type'];
		}
		
		file_put_contents($this->getPath() . $filename, $this->response);
		
		echo '<p>File successfully saved. Go to '. $this->getPath() .' and open the file '. $filename .' to see the result.</p>';
	}
}
?>