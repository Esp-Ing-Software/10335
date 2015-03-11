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
	
function connect()
{
	// DB connection info
	$host = "mysql.nixiweb.com";
	$user = "u474286048_10335";
	$pwd = "103352015";
	$db = "u474286048_foro";
	try{
		$conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(Exception $e){
		die(print_r($e));
	}
	return $conn;
}

function markItemComplete($item_id)
{
	$conn = connect();
	$sql = "UPDATE items SET is_complete = 1 WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $item_id);
	$stmt->execute();
}

function getCurrentItemView()
{
	$param = "".$_GET["viewForo"]."";
if ($param==""){
return '';
} else {
	$conn = connect();
	$sql = "SELECT THR_NAME,THR_FMT_FMY,THR_ID,THR_LINK,THR_FMT_TPE,THR_USR_ID FROM THREAD WHERE `THR_ENB` LIKE '1' ".getBrowserViewForoParam()." ORDER BY THR_DATE ASC";
	$stmt = $conn->query($sql);
	return $stmt->fetchAll(PDO::FETCH_NUM);
}
}

function getAllItems()
{
	
	$conn = connect();
	$sql = "SELECT THR_NAME,THR_FMT_FMY,THR_ID,THR_LINK,THR_FMT_TPE,THR_USR_ID FROM THREAD WHERE `THR_ENB` LIKE '1' ".getBrowserViewParam()." ORDER BY THR_DATE DESC";
	$stmt = $conn->query($sql);
	return $stmt->fetchAll(PDO::FETCH_NUM);
}

function getBrowserViewParam(){
	$param = "".$_GET["viewForo"]."";
	if ($param=="")
	return '';
else return "AND THR_WBL_ID like '".$_GET["viewForo"]."'";
}
function getBrowserViewForoParam(){
	$param = "".$_GET["viewForo"]."";
	if ($param=="")
	return '';
else return "AND THR_ID = ".$_GET["viewForo"]."";
}

function addItem($name, $soporte, $cod, $tipo, $padre, $familia)
{
	$conn = connect();
	$sql = "INSERT INTO `THREAD`(`THR_ID`, `THR_NAME`, `THR_DATE`, `THR_LINK`, `THR_FMT_TPE`, `THR_ENB`, `THR_FMT_FMY`, `THR_WBL_ID`, `THR_USR_ID`)  VALUES (null,?,null,?,?,1,?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $name);
	$stmt->bindValue(2, $soporte);
	$stmt->bindValue(3, $tipo);
	$stmt->bindValue(4, $familia);
	$stmt->bindValue(5, $padre);
	$stmt->bindValue(6, $cod);
	
	$stmt->execute();
}

function deleteItem($item_id)
{
	$conn = connect();
	$sql = "DELETE FROM items WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bindValue(1, $item_id);
	$stmt->execute();
}

?>