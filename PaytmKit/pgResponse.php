
<?php

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
include('../admin/dbcon.php');
include('../function.php');

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

if($isValidChecksum == "TRUE") {

	if ($_POST["STATUS"] == "TXN_SUCCESS") 
	{

		  $orderid=$_POST['ORDERID'];
		  $txnid=$_POST['TXNID'];
		  $txnamount=$_POST['TXNAMOUNT'];
		  $mode=$_POST['PAYMENTMODE'];
		  $txndate=$_POST['TXNDATE'];
		  $gateway=$_POST['GATEWAYNAME'];
		  $banktxnid=$_POST['BANKTXNID'];
		  $bankname=$_POST['BANKNAME'];

		  header('location:../place_order.php?ORDERID='.$orderid.'&MID='.$mid.'&TXNID='.$txnid.'&TXNAMOUNT='.$txnamount.'&PAYMENTMODE='.$mode.'&TXNDATE='.$txndate.'&GATEWAYNAME='.$gateway.'&BANKTXNID='.$banktxnid.'&BANKNAME='.$bankname.'');

		    
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else{

	   header('location:../final_order.php?mismatched=failed');

	}

	
	

}
else {

	header('location:../final_order.php?mismatched=failed');
	//Process transaction as suspicious.
}

?>