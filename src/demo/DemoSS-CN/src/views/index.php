<?php
require_once '../library/config.php';
require_once '../library/functions.php';

checkFDUser();

$view = (isset($_GET['v']) && $_GET['v'] != '') ? $_GET['v'] : '';

switch ($view) {
	case 'LIST' :
		$content 	= 'eventlist.php';		
		$pageTitle 	= 'View Event Details';
		break;

	case 'USERS' :
		$content 	= 'userlist.php';		
		$pageTitle 	= 'View User Details';
		break;
		
	case 'CREATE' :
		$content 	= 'userform.php';		
		$pageTitle 	= 'Create New User';
		break;
		
	case 'USER' :
		$content 	= 'user.php';		
		$pageTitle 	= 'View User Details';
		break;
	
	case 'HOLY' :
		$content 	= 'holidays.php';		
		$pageTitle 	= 'Holidays';
		break;	
	
	case 'STATISTICS' :
		$content 	= 'chart.php';		
		$pageTitle 	= 'Charts';
		break;	
	
	case 'STATISTICS_NORMAL' :
		$content 	= 'chart_normal.php';		
		$pageTitle 	= 'Charts';
		break;	

	case 'CONTACT' :
		$content 	= 'contact.php';		
		$pageTitle 	= 'Contact';
		break;	
	
	default :
		$content 	= 'dashboard.php';		
		$pageTitle 	= 'Calendar Dashboard';
}

require_once '../include/template.php';
?>
