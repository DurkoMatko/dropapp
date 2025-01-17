<?php

	
	$table = $action;
	$ajax = checkajax();

	if(!$ajax) {

		initlist();

		$cmsmain->assign('title','Residents');

		listsetting('allowcopy', false);
		listsetting('allowmove', true);
		listsetting('allowmoveto', 1);
 		listsetting('allowsort',false);
 		listsetting('allowshowhide',false); 		
		listsetting('search', array('firstname','lastname', 'container'));
		listsetting('add', 'New person');

		listsetting('haspagemenu', true);
		addpagemenu('all', 'All', array('link'=>'?action=people', 'active'=>true));
		addpagemenu('deleted', 'Deleted', array('link'=>'?action=people_trash'));

		$statusarray = array('week'=>'New this week','month'=>'New this month');
		listfilter(array('label'=>'Show all people','options'=>$statusarray,'filter'=>'"show"'));

		listsetting('manualquery',true);
		#listfilter(array('label'=>'Filter op afdeling','query'=>'SELECT id AS value, title AS label FROM people_cats WHERE visible AND NOT deleted ORDER BY seq','filter'=>'c.id'));
		#			 AS lastactive , 

$search = substr(db_escape(trim($listconfig['searchvalue'])),1,strlen(db_escape(trim($listconfig['searchvalue'])))-2);

		$data = getlistdata('
		SELECT 
			IF(DATEDIFF(NOW(),
			IF(people.parent_id,NULL,GREATEST(COALESCE((SELECT transaction_date 
				FROM transactions AS t 
				WHERE t.people_id = people.id AND people.parent_id = 0 AND product_id != 0 
				ORDER BY transaction_date DESC LIMIT 1),0),
				COALESCE(people.modified,0),COALESCE(people.created,0))
			)) > (SELECT delete_inactive_users/2 FROM camps WHERE id = '.$_SESSION['camp']['id'].'),1,NULL) AS expired,
			people.*, 
			DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), people.date_of_birth)), "%Y")+0 AS age, 
			IF(gender="M","Male",IF(gender="F","Female","")) AS gender2, 
			IF(people.parent_id,"",SUM(t2.drops)) AS drops,  
			IF(notregistered,"NR","") AS nr
		FROM people 
		LEFT OUTER JOIN transactions AS t2 ON t2.people_id = people.id 
		WHERE 
			NOT people.deleted AND 
			'.($listconfig['filtervalue']=='week'?' DATE_FORMAT(NOW(),"%v-%x") = DATE_FORMAT(people.created,"%v-%x") AND':'').
			($listconfig['filtervalue']=='month'?' DATE_FORMAT(NOW(),"%m-%Y") = DATE_FORMAT(people.created,"%m-%Y") AND':'').'
			people.camp_id = '.$_SESSION['camp']['id']. 
			($listconfig['searchvalue']?' AND
			(lastname LIKE "%'.$search.'%" OR 
			 firstname LIKE "%'.$search.'%" OR 
			 container = "'.$search.'" OR 
			 (SELECT 
			 	COUNT(id) 
			 FROM people AS p 
			 WHERE 
			 	(lastname LIKE "%'.$search.'%" OR 
			 	 firstname LIKE "%'.$search.'%" OR 
			 	 container = "'.$search.'") AND 
			 	 p.parent_id = people.id AND NOT p.deleted AND p.camp_id = '.$_SESSION['camp']['id'].'
			 ))
			':' ')
		.'GROUP BY people.id ORDER BY people.seq');

		$daysinactive = db_value('SELECT delete_inactive_users/2 FROM camps WHERE id = '.$_SESSION['camp']['id']);

		foreach($data as $key=>$value) {
			if($data[$key]['expired']) {
				$data[$key]['expired'] = '<i class="fa fa-exclamation-triangle warning tooltip-this" title="This family hasn\'t been active for at least '. floor($daysinactive) .' days."></i> '; 
			} else {
				$data[$key]['expired'] ='';
			}
			if($data[$key]['bicycletraining'] && $_SESSION['camp']['bicycle']) {
				$data[$key]['expired'] .= '<i class="fa fa-bicycle tooltip-this" title="This person has a bicycle certificate."></i> ';
			}
			if($data[$key]['workshoptraining'] && $_SESSION['camp']['workshop']) {
				$data[$key]['expired'] .= '<i class="fa fa-wrench tooltip-this '.($data[$key]['workshopsupervisor']?'blue':'').'" title="This person has a workshop certificate."></i> ';
			}

			if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/people/'.$data[$key]['id'].'.jpg') && $_SESSION['camp']['idcard']) {
				$data[$key]['expired'] .= '<i class="fa fa-id-card-o tooltip-this" title="This person has a picture."></i> ';
			}
			if($data[$key]['volunteer']) {
				$data[$key]['expired'] .= '<i class="fa fa-heart blue tooltip-this" title="This is a resident volunteer."></i> ';
			}
		}

		addcolumn('text','Lastname','lastname');
		addcolumn('text','Firstname','firstname');
		addcolumn('text','Gender','gender2');
		addcolumn('text','Age','age');
		addcolumn('text','NR','nr');
		addcolumn('text',$_SESSION['camp']['familyidentifier'],'container');
		addcolumn('text', ucwords($translate['market_coins']),'drops');
		addcolumn('html','&nbsp;','expired');
		if($listconfig['filtervalue']) addcolumn('datetime','Created','created');

		addbutton('give','Give '.ucwords($translate['market_coins_short']),array('icon'=>'fa-tint','oneitemonly'=>false));
		addbutton('merge','Merge to family',array('icon'=>'fa-link','oneitemonly'=>false));
		addbutton('detach','Detach from family',array('icon'=>'fa-unlink','oneitemonly'=>false));

		if($_SESSION['camp']['bicycle']) $options['bicycle'] = 'Bicycle card';
		if($_SESSION['camp']['id']==1) $options['occ'] = 'OCCycle card';
		if($_SESSION['camp']['bicycle']) $options['workshop'] = 'Workshop card';
		if($_SESSION['camp']['idcard']) $options['id'] = 'ID Card';
		
		addbutton('print','Print',array('icon'=>'fa-print','options'=>$options));
		addbutton('touch','Touch',array('icon'=>'fa-hand-pointer'));

		if($_SESSION['user']['is_admin'] || $_SESSION['user']['coordinator']) addbutton('export','Export',array('icon'=>'fa-file-excel-o','showalways'=>true));

		$cmsmain->assign('data',$data);
		$cmsmain->assign('listconfig',$listconfig);
		$cmsmain->assign('listdata',$listdata);
		$cmsmain->assign('include','cms_list.tpl');


	} else {
		switch ($_POST['do']) {
		    case 'merge':
				$ids = explode(',',$_POST['ids']);
				foreach($ids as $key=>$value) {
					if(db_value('SELECT parent_id FROM people WHERE id = :id',array('id'=>$value))) {
						$containsmembers = true;
					}
				}
				if ($containsmembers) {
					$message = 'Please select only individuals or family heads to merge';
					$success = false;
				} elseif (count($ids)==1) {
					$message = 'Please select more than one person to merge them into a family';
					$success = false;
				} else {
					$oldest = db_value('SELECT id FROM people WHERE id IN ('.$_POST['ids'].') ORDER BY date_of_birth ASC LIMIT 1');
					$extradrops = db_value('SELECT SUM(drops) FROM transactions WHERE people_id IN ('.$_POST['ids'].') AND people_id != :oldest', array('oldest'=>$oldest));
					foreach($ids as $id) {
						if($id!=$oldest) {
							db_query('UPDATE people SET parent_id = :oldest WHERE id = :id',array('oldest'=>$oldest,'id'=>$id));
							$drops = db_value('SELECT SUM(drops) FROM transactions WHERE people_id = :id',array('id'=>$id));
							db_query('INSERT INTO transactions (people_id, drops, description, transaction_date, user_id) VALUES ('.$id.', -'.intval($drops).', "'.ucwords($translate['market_coins_short']).' moved to new family head", NOW(), '.$_SESSION['user']['id'].')');
						}
					}
					db_query('INSERT INTO transactions (people_id, drops, description, transaction_date, user_id) VALUES ('.$oldest.', '.intval($extradrops).', "'.ucwords($translate['market_coins_short']).' moved from family member to family head", NOW(), '.$_SESSION['user']['id'].')');
					$success = true;
					$redirect = true;
					correctchildren();
					
				}
		        break;

			case 'detach':
				$ids = explode(',',$_POST['ids']);
				foreach($ids as $key=>$value) {
					if(!db_value('SELECT parent_id FROM people WHERE id = :id',array('id'=>$value))) {
						$containsmembers = true;
					}
				}
				if ($containsmembers) {
					$message = 'Please select only members of a family, not family heads';
					$success = false;
				} else {
					foreach($ids as $id) {
						db_query('UPDATE people SET parent_id = 0 WHERE id = :id',array('id'=>$id));
					}
					$redirect = true;
					$success = true;
				}
				break;
		    case 'give':
				$ids = ($_POST['ids']);
				$success = true;
				$redirect = '?action=give&ids='.$ids;
		        break;

		    case 'move':
				$ids = json_decode($_POST['ids']);
		    	list($success, $message, $redirect, $aftermove) = listMove($table, $ids, true, 'correctdrops');
		        break;

		    case 'delete':
				$ids = explode(',',$_POST['ids']);
		    	list($success, $message, $redirect) = listDelete($table, $ids);
		        break;

		    case 'copy':
				$ids = explode(',',$_POST['ids']);
		    	list($success, $message, $redirect) = listCopy($table, $ids, 'name');
		        break;

		    case 'hide':
				$ids = explode(',',$_POST['ids']);
		    	list($success, $message, $redirect) = listShowHide($table, $ids, 0);
		        break;

		    case 'show':
				$ids = explode(',',$_POST['ids']);
		    	list($success, $message, $redirect) = listShowHide($table, $ids, 1);
		        break;

		    case 'touch':
				$ids = explode(',',$_POST['ids']);
				foreach($ids as $id) {
					db_query('UPDATE people SET modified = NOW(), modified_by = :user WHERE id = :id',array('id'=>$id,'user'=>$_SESSION['user']['id']));
					simpleSaveChangeHistory('people', $id, 'Touched');
				}
				$success = true;
				$message = 'Selected people have been touched';
				$redirect = true;
				
		        break;
		    case 'print':
				$success = true;
		    	$redirect = '/pdf/'.$_POST['option'].'card.php?id='.$_POST['ids'];
		        break;
		    case 'export':
				$success = true;
		    	$redirect = '?action=people_export';
		        break;
		}

		$return = array("success" => $success, 'message'=> $message, 'redirect'=>$redirect, 'action'=>$aftermove);

		echo json_encode($return);
		die();
	}

	function correctchildren() {
		$result = db_query('SELECT (SELECT p2.parent_id FROM people AS p2 WHERE p2.id = p1.parent_id) AS newparent, p1.id FROM people AS p1 WHERE p1.parent_id > 0 AND (SELECT p2.parent_id FROM people AS p2 WHERE p2.id = p1.parent_id) AND NOT deleted');
		while($row = db_fetch($result)) {
			db_query('UPDATE people SET parent_id = :newparent WHERE id = :id',array('newparent'=>$row['newparent'],'id'=>$row['id']));
		}
	}
	function correctdrops($id) {
		#$action = 'correctDrops({id:847, value: 1400}, {id:14, value: 1900})';

		$drops = db_value('SELECT SUM(drops) FROM transactions AS t WHERE people_id = :id',array('id'=>intval($id)));
		$person = db_row('SELECT * FROM people AS p WHERE id = :id',array('id'=>$id));

		if($drops && $person['parent_id']) {
			db_query('INSERT INTO transactions (people_id, drops, description, transaction_date, user_id) VALUES ('.$person['parent_id'].', '.$drops.', "'.ucwords($translate['market_coins_short']).' moved from family member to family head", NOW(), '.$_SESSION['user']['id'].')');
			db_query('INSERT INTO transactions (people_id, drops, description, transaction_date, user_id) VALUES ('.$person['id'].', -'.$drops.', "'.ucwords($translate['market_coins_short']).' moved to new family head", NOW(), '.$_SESSION['user']['id'].')');
			$newamount = db_value('SELECT SUM(drops) FROM transactions WHERE people_id = :id',array('id'=>$person['parent_id']));
			$aftermove = 'correctDrops({id:'.$person['id'].', value: ""}, {id:'.$person['parent_id'].', value: '.$newamount.'})';
			return $aftermove;
		}
	}
