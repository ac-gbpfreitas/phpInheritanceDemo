<?php

class FileAgent {

	//Static Function that will read the file
    #Parameter: Temporary FilePath
	#Return: A String
    static function read($fileName)    {

		//Try Open the file to read
		try {
			//File Handle opens the file to read
			$fileHandle = fopen($fileName,'r');

			//If there is any issue with the file
			if (!$fileHandle) {
				throw new Exception("There was an error reading the file $fileName");
			}
			//Collects the file content into a huge String
			$fileContent = fread($fileHandle,filesize($fileName));
			//*IMPORTANT* Close the file
			fclose($fileHandle);

		} catch (Exception $ex) {
			echo $ex->getMessage();
		}
		//Return the file content as a String
		return $fileContent;
    }
}

?>