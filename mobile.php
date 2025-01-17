<?php
	error_reporting(E_ALL);
	ini_set('display_errors',true);

	$login = true; #tell core not to check login, because we use an alternate version
	require_once('library/core.php');

	date_default_timezone_set('Europe/Athens');
	db_query('SET time_zone = "+02:00"');

	$tpl = new Zmarty;

	if($_GET['logout']!='') {
		logout($settings['rootdir'].'/mobile.php');
	}
	
	checkmobilesession();
	if($_POST && $_POST['action']=='login') {
		require_once('mobile/login.php');
	}

	/* new: fill the camp selection menu -------------------------------------------- */
	if($_GET['camp']) {
		if($_SESSION['user']['is_admin']) {
			$_SESSION['camp'] = db_row('SELECT c.* FROM camps AS c WHERE c.id = :camp',array('camp'=>$_GET['camp']));
		} else {
			$_SESSION['camp'] = db_row('SELECT c.* FROM camps AS c, cms_users_camps AS x WHERE c.id = x.camps_id AND c.id = :camp AND x.cms_users_id = :id',array('camp'=>$_GET['camp'], 'id'=>$_SESSION['user']['id']));
		}
	}
	if($_SESSION['user']['is_admin']) {
		$camplist = db_array('SELECT c.* FROM camps AS c');
	} else {
		$camplist = db_array('SELECT c.* FROM camps AS c, cms_users_camps AS x WHERE x.camps_id = c.id AND x.cms_users_id = :id',array('id'=>$_SESSION['user']['id']));
	}
	if(!isset($_SESSION['camp'])) $_SESSION['camp'] = $camplist[0];
	$tpl->assign('camps',$camplist);
	$tpl->assign('currentcamp',$_SESSION['camp']);
	/* end of the camp menu addition -------------------------------------------- */

	if($_GET['message']) $data['message'] = $_GET['message'];
	if($_GET['warning']) $data['warning'] = true;
	
	if(!$_SESSION['user']) {
		$data['destination'] = $_SERVER['REQUEST_URI'];
		$tpl->assign('include','mobile_login.tpl');
	} elseif(!$_SESSION['camp']['id']) { 
		$data['message'] = 'You don\'t have access to this camp. Ask your coordinator to correct this!';

#		$tpl->assign('include','mobile_message.tpl');
	} else {
		# Boxlabel is scanned 
		if($_GET['barcode']!='' || $_GET['boxid']!='') {
			require_once('mobile/barcode.php');
			
		# Assign a QR code to existing box
		} elseif($_GET['assignbox']!='') {
			require_once('mobile/assignbox.php');
			
		# Save assignbox selection
		} elseif($_GET['saveassignbox']!='') {
			require_once('mobile/saveassignbox.php');
			
		# Make a new box with this QR code
		} elseif($_GET['newbox']!='') {
			require_once('mobile/newbox.php');
			
		# Edit the info for existing box
		} elseif($_GET['editbox']!='') {
			require_once('mobile/editbox.php');
			
		# Save a new box with this QR code
		} elseif($_GET['savebox']!='') {
			require_once('mobile/savebox.php');
		
		# Move this box to a new location
		} elseif($_GET['move']!='') {
			require_once('mobile/move.php');
	
		# Change the amount of items in this box
		} elseif($_GET['changeamount']!='') {
			require_once('mobile/changeamount.php');
	
		# Save the new amount of items in this box
		} elseif($_GET['saveamount']!='') {
			require_once('mobile/saveamount.php');
	
		# Save the new amount of items in this box
		} elseif(isset($_GET['vieworders'])) {
			require_once('mobile/vieworders.php');
	
		# Find a box by manually entered number
		} elseif($_GET['findbox']!='') {
			require_once('mobile/findbox.php');
	
		} else {
			require_once('mobile/start.php');
		}	
	}

	$data['favicon16'] = $settings['rootdir']. (file_exists("uploads/favicon-16x16.png") ? '/uploads/favicon-16x16.png' : '/assets/img/favicon-16x16.png');
	$data['favicon32'] = $settings['rootdir']. (file_exists("uploads/favicon-32x32.png") ? '/uploads/favicon-32x32.png' : '/assets/img/favicon-32x32.png');
	$data['faviconapple'] = $settings['rootdir']. (file_exists("uploads/apple-touch-icon.png") ? '/uploads/apple-touch-icon.png' : '/assets/img/apple-touch-icon.png');

	$tpl->assign('data',$data);	
	$tpl->display('mobile.tpl');
	
function checkmobilesession() {
	global $settings;
	
	if(isset($_SESSION['user'])) { # a valid session exists
		db_query('UPDATE '.$settings['cms_usertable'].' SET lastaction = NOW() WHERE id = :id', array('id'=>$_SESSION['user']['id']));			
	} else { # no valid session exists	
		if(isset($_COOKIE['autologin_user'])) { # a autologin cookie exists
			$user = db_row('SELECT * FROM '.$settings['cms_usertable'].' WHERE email != "" AND email = :email AND pass = :pass',array('email'=>$_COOKIE['autologin_user'], 'pass'=>$_COOKIE['autologin_pass']));
			if($user) {
				$_SESSION['user'] = $user;
				db_query('UPDATE '.$settings['cms_usertable'].' SET lastlogin = NOW(), lastaction = NOW() WHERE id = :id',array('id'=>$_SESSION['user']['id']));
			}
		}
	}
}

	function generateBoxID($length = 6, $possible = '0123456789') {
		$password = "";
	 	$i = 0; 
		while ($i < $length) { 
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			if (!strstr($password, $char)) { 
				$password .= $char;
				$i++;
			}
		}
		return $password;
	}
