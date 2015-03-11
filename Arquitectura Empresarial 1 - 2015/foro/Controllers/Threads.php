<?php
/** * Copyright 2013 Microsoft Corporation 
	*  
	* Licensed under the Apache License, Version 2.0 (the "License"); 
	* you may not use this file except in compliance with the License. 
	* You may obtain a copy of the License at 
	* http://www.apache.org/licenses/LICENSE-2.0 
	*  
	* Unless required by applicable law or agreed to in writing, software 
	* distributed under the License is distributed on an "AS IS" BASIS, 
	* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. 
	* See the License for the specific language governing permissions and 
	* limitations under the License. 
	*/
	
include_once './Manager/admin/taskmodel.php';
function getItems()
{
  $items = getAllItems();
  return $items;
}
function getCurrentItem()
{
  $items = getCurrentItemView();
  return $items;
}
function addItemForo($name, $soporte, $cod, $tipo, $padre)
{
	$to      = 'luisurbm@gmail.com';
$subject = 'NEW FORO';
$message = 'NEW FORO '.$name.' - '.$soporte.' - '.$cod.' - '.$tipo.' - '.$padre;
$headers = 'From: webmaster@example.com' . "\r\n" .'Reply-To: webmaster@example.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
	 addItem($name, $soporte, $cod, $tipo, $padre);
	   
   $subject = "This is subject";
   $message = "This is simple text message.";
   $header = "From:abc@somedomain.com \r\n";
   $retval = mail ($to,$subject,$message,$header);
   if( $retval == true )  
   {
      echo "alert(Message sent successfully...');";
   }
   else
   {
      echo "alert('Message could not be sent...');";
   }
   session_destroy(); 
	 return '';
}
?>