<?php

function weixin_nodes_reply($nodes, $wechat_obj) {
//		$this->set_response('advanced');
	if (!empty($nodes)) {
		$count = 0;
		foreach ($nodes as $node) {
			file_put_contents('/tmp/node',var_export($node, true));
			$title = $node->title;
			$body = drupal_substr(strip_tags($node->body[$node->language][0]['safe_value']),0,10);
			if(!empty($node->field_image)) {
				$thumb = file_create_url($node->field_image[$node->language][0]['uri']);
			} else {
				$thumb = '';
			}
			$url = url('node/'.$node->nid, array('absolute' => TRUE));
			$items = $items . $wechat_obj->get_item($title, $excerpt, $thumb, $url);
			$count++;
		}
		echo sprintf($wechat_obj->get_picTpl(), $count, $items);
		file_put_contents('/tmp/news',var_export($news, true));
	}
}

function weixin_project_nodes_reply($nodes, $wechat_obj) {
	if (!empty($nodes)) {
		$count = 0;
		$project_node_count = variable_get('weixin_reply_message_number');
		foreach ($nodes as $node) {
			$count++;
			file_put_contents('/tmp/project_node',var_export($node, true));
			$title = $node->title;
			$body = drupal_substr(strip_tags($node->body[$node->language][0]['safe_value']),0,10);
			if(!empty($node->field_group_logo)) {
				$thumb = file_create_url($node->field_group_logo['und'][0]['uri']);
				file_put_contents('/tmp/thumb',var_export($thumb, true));
			} else {
				$thumb = '';
			}
			$url = url('node/'.$node->nid, array('absolute' => TRUE));
			$items = $items . $wechat_obj->get_item($title, $excerpt, $thumb, $url);
			if($count >= $project_node_count) {
				break;
			}
		}
		echo sprintf($wechat_obj->get_picTpl(), $count, $items);
//		file_put_contents('/tmp/news',var_export($news, true));
	}
}

function weixin_new_posts_reply($wechat_obj) {
		$nodes = node_get_recent(5);
		weixin_nodes_reply($nodes, $wechat_obj);
		file_put_contents('/tmp/reply_function',var_export($nodes, true));
}

function weixin_new_projects_reply($wechat_obj) {
//		$node_type = "project";
		$result = db_query("SELECT nid FROM {node} WHERE type = 'project' ORDER BY created DESC LIMIT 10");
		$nids = array();
		$nodes = array();
		foreach ($result as $obj) {
//			file_put_contents('/tmp/reply_function',var_export($nid->nid, true));
			$nids[] = $obj->nid;
		}
		file_put_contents('/tmp/project_nids',var_export($nids, true));
		/*
		$nodes = node_get_recent(10);
		weixin_nodes_reply($nodes, $wechat_obj);
		 */
		foreach ($nids as $node_id) {
			$nodes[$node_id]=node_load($node_id);
		}
		weixin_project_nodes_reply($nodes, $wechat_obj);
}

function weixin_new_tasks_reply($wechat_obj) {
//		$node_type = "project";
		$result = db_query("SELECT nid FROM {node} WHERE type = 'task' ORDER BY created DESC LIMIT 10");
		$nids = array();
		$nodes = array();
		foreach ($result as $obj) {
//			file_put_contents('/tmp/reply_function',var_export($nid->nid, true));
			$nids[] = $obj->nid;
		}
//		file_put_contents('/tmp/project_nids',var_export($nids, true));
		/*
		$nodes = node_get_recent(10);
		weixin_nodes_reply($nodes, $wechat_obj);
		 */
		foreach ($nids as $node_id) {
			$nodes[$node_id]=node_load($node_id);
		}
		weixin_project_nodes_reply($nodes, $wechat_obj);
}

function weixin_get_id_by_openid($weixin_open_id) {
	        $query = db_select('weixin_user_map','user_map');
//	        $query->join('weixin_user_map','user_map', 'user_map.wx_openid = weixin_user.openid');
	        $query->condition('wx_openid',$weixin_open_id);
	        $query->fields('user_map',array('uid'));
		$user_id = $query->execute()->fetchField();
		return $user_id;
}

function weixin_my_task_status($wechat_obj, $keyword) {
		$user_id = weixin_get_id_by_openid($wechat_obj->get_weixin_openid());
}

function weixin_custom_nodes_reply($wechat_obj, $keyword) {
		$nodes = array();
		$node_list = split(",", $keyword);
//		file_put_contents('/tmp/reply_nodes',var_export($nodes, true));
		foreach ($node_list as $node_id) {
			$nodes[$node_id]=node_load($node_id);
		}
		weixin_nodes_reply($nodes, $wechat_obj);
}

function weixin_term_posts_reply($wechat_obj, $keyword) {
		$nodes = array();
		$node_list = taxonomy_select_nodes($keyword, $pager = TRUE, $limit = 5);
		foreach ($node_list as $node_id) {
//			file_put_contents('/tmp/node_id',var_export($node_id, true));
			$nodes[$node_id]=node_load($node_id);
		}
		weixin_nodes_reply($nodes, $wechat_obj);
//		file_put_contents('/tmp/term_nodes',var_export($nodes, true));
}
