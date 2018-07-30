<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function CustomReportTo($entity){
     global $adb;
	 
    //Get the data of the current ticket
    global $current_user;
    $adb = PearDatabase::getInstance();
    $potentialData = $entity->getData();
    $Potential= $potentialData['id']; 
	$PotentialIDs = explode("x",$Potential);
	$PotentialID= $PotentialIDs[1];
   
    //Getting the Current USer
    $currentUser=$_SESSION['AUTHUSERID'];
	
	//Get the Report to user Id 
	$sql="SELECT reports_to_id FROM vtiger_users WHERE id = '$currentUser'";
	$result = $adb->pquery($sql);
	$reports_to_id = $result->fields['reports_to_id'];
   
   //get the user data by matching the report to user id to userid
   $dataUser = "SELECT * FROM vtiger_users WHERE id = '$reports_to_id'";
   $resultUser = $adb->pquery($dataUser);
   $userData = $resultUser->fields;
   $fname = $userData['first_name'];
   $lname = $userData['last_name'];	 
   $fullName= $fname.' '.$lname;
  
  //Update the Potential table report to fields
   $sqlUPDATE = "UPDATE vtiger_potentialscf SET `cf_975` = '$fullName' WHERE potentialid='$PotentialID'" ; 
   $UpdateResult=$adb->pquery($sqlUPDATE);
   
   if(!$UpdateResult){
		throw new Exception("Error in updating potential Report to");
	}
   
  
}

?>
