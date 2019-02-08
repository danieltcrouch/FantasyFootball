<?php
session_start();
include_once( "database.php" );

if ( isset( $_POST['action'] ) && function_exists( $_POST['action'] ) )
{
    $action = $_POST['action'];
    $result = null;

	if ( isset( $_POST['settings'] )  )
	{
		$settings = json_decode( $_POST['settings'] );
		$result = $action( $settings );
	}
	elseif ( isset( $_POST['memberId'] ) )
	{
		$result = json_decode( $_POST['memberId'] );
	}
	
	echo json_encode( $result );
}
?>
