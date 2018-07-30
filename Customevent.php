<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT);
//Necessary files to get access to vtiger db object and bootstrap vtiger
include_once 'include/Webservices/Relation.php';
include_once 'vtlib/Vtiger/Module.php';
include_once 'includes/main/WebUI.php';
//The entity method class manager
include_once 'modules/com_vtiger_workflow/VTEntityMethodManager.inc';
//The name of the module where this custom workflow task will be available
$moduleName = "Potentials"; 
//The name of the method to be displayed to the list of custom actions for the workflow
$methodName = "Update Account Nummber"; 
//The file path where the function to be invoked is present
$filePath = "modules/custom/HelpDeskHandler.php";
//The name of the function to invoke 
$functionName = "updateAccountNumber"; 
//Instantiate tha entity method manager using the $adb (the vtiger db object)
$emm = new VTEntityMethodManager($adb);
//Add the entity method to the database
$result = $emm->addEntityMethod($moduleName,$methodName,$filePath,$functionName);
//This is the name of the second method we will add

$moduleName = "Documents"; 
$methodName = "Update Attachment Link";
//The name of the function to be invoked in the second workflow
$functionName = "updateAttachmentLink";
//Add the second entity method to the database
$result = $emm->addEntityMethod($moduleName,$methodName,$filePath,$functionName);






/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('vtlib/Vtiger/Event.php');
Vtiger_Event::register('Documents', 'vtiger.entity.afterdelete', 'DocumentsHandler', 'modules/Documents/DocumentsHandler.php');

Vtiger_Event::register('Documents', 'vtiger.entity.afterrestore', 'TICustomRestoreDocHandler', 'modules/RecycleBin/helper/CustomRestoreDoc.php');

