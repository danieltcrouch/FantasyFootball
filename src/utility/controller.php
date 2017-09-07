<?php
session_start();
include_once( "database.php" );

//AJAX Endpoint
if ( isset( $_POST['action'] ) && function_exists( $_POST['action'] ) )
{
	$result = null;
	$action = $_POST['action'];
	
	if ( isset( $_POST['settings'] )  )
	{
		$settings = json_decode( $_POST['settings'] );
		$result = call_user_func_array( $action, ["settings"=>$settings] );
		$_SESSION['memberId'] = $result['memberId'];
	}
	
	echo $result;
}
?>
