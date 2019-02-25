<?php
session_start();
include_once( "database.php" );

if ( isset( $_POST['action'] ) && function_exists( $_POST['action'] ) )
{
    $action = $_POST['action'];
    $result = null;

	if ( isset( $_POST['memberId'] ) && isset( $_POST['settings'] )  )
	{
		$settings = json_decode( $_POST['settings'] );
		$result = $action( $_POST['memberId'], $settings );
	}
	elseif ( isset( $_POST['settings'] )  )
	{
		$settings = json_decode( $_POST['settings'] );
		$result = $action( $settings );
	}
	elseif ( isset( $_POST['memberId'] ) )
	{
		$result = $action( $_POST['memberId'] );
	}
	else
	{
		$result = $action();
	}
	
	echo json_encode( $result );
}
?>
