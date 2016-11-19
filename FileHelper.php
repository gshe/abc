<?php
class FileHelper
{
  public $indexFilePath = 'index';
  public $outputFilePath = 'out/';
  
  function createFolder($path){
  	if (!file_exists($path))
  	{
   		$this->createFolder(dirname($path));
   		mkdir($path, 0777);
  	}
  }
 
  public function getIndexValue(){
  	$fileHandle = fopen($this->indexFilePath, "a+");
 	$lastMaxCount = fgets($fileHandle);
 	fclose($fileHandle);
 	if (!$lastMaxCount){
 		$lastMaxCount = 0;
 	}
 	return $lastMaxCount;
  }
  
  public function setIndexValue($maxCount){
  	$fileHandle = fopen($this->indexFilePath, "w+");
  	fwrite($fileHandle, $maxCount);
  	fclose($fileHandle);
  }
  
  public function outputMail($mailObj){
	if (!$mailObj || !$mailObj->id){
	    return ;
	}
	$this->createFolder($this->outputFilePath);
	
	$fileHandle = fopen($this->outputFilePath . $mailObj->id . '.json', "w+");
  	fwrite($fileHandle, json_encode($mailObj));
  	fclose($fileHandle);
  }
}

?>
