<?php
include 'FileHelper.php';
include 'MailObject.php';

 	$fileHelper = new FileHelper();
 	$lastFetchCount = $fileHelper->getIndexValue();
 	$con = mysql_connect("localhost", "root","8434139");
 	if(!$con){
   		die('Could not connect to: ' . mysql_error()); 
 	}
 	mysql_select_db("phabricator_metamta", $con);
 	$result = mysql_query("SELECT * FROM metamta_mail where id >" . $lastFetchCount);
	echo $result;
	$maxCount = 0;
  	while($row = mysql_fetch_array($result))
  	{
  	    $mailObj = new MailObject();
  	    $mailObj->id = $row['id'];
  	    $mailObj->phid = $row['phid'];
  	    $mailObj->actorPHID = $row['actorPHID'];
		$mailObj->parameters = $row['parameters'];
		$mailObj->status = $row['status'];
		$mailObj->message = $row['message'];
		$mailObj->relatedPHID = $row['relatedPHID'];
		$mailObj->dateCreated = $row['dateCreated'];
		$mailObj->dateModified = $row['dateModified'];
     	$fileHelper->outputMail($mailObj);
     	$maxCount = $row['id'];
  	}
  	exec('./GitScript.sh');
 	$fileHelper->setIndexValue($maxCount);
  	mysql_close($con);
 
?>
