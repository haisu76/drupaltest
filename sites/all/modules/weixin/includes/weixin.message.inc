<?php 
include(drupal_get_path('module', 'weixin') .'/includes/weixin_reply_func.inc');
include(drupal_get_path('module', 'weixin') .'/includes/weixin.configuration.inc');
include(drupal_get_path('module', 'weixin') .'/includes/weixin_binding.inc');
class wechatCallback {
	private $postObj	= '';
	private $fromUsername	= '';
	private $toUsername	= '';
	private $response	= '';
	private $message_type	= 'text';
	private $create_time	= '';
	public function get_weixin_openid() {
		return $this->fromUsername;
	}
	public function valid(){
		/*
		$data = array(
			'type'		=>	$this->message_type,
			'open_user_id'	=>	$this->fromUsername,
			'create_time'	=>	$this->create_time,
			'msgid'		=>	'',
			'content'	=>	'',
			'picurl'	=>	'',
			'location_x'	=>	0,
			'location_y'	=>	0,
			'scale'		=>	0,
			'lable'		=>	'',
			'title'		=>	'',
			'description'	=>	'',
			'url'		=>	'',
			'event'		=>	'',
			'event_key'	=>	'',
			'format'	=>	'',
			'media_id'	=>	'',
			'recognition'	=>	'',
		);
		file_put_contents('/tmp/data',var_export($data,true));
		drupal_write_record('weixin_msg', $data);
		*/
		file_put_contents('/tmp/weixin.log',var_export($_GET,true));
		if(isset($_GET['debug'])){
			$this->checkSignature();
			$this->getMsg();
		}else{
			if($this->checkSignature() || isset($_GET['yixin'])){
				if(isset($_GET["echostr"])){
					$echoStr = $_GET["echostr"];
					echo $echoStr;					
				}
				$this->getMsg();
				exit;
			}
		}
	}
	public function weixin_insert_message() {
		$data = array(
			'type'		=>	$this->message_type,
			'open_user_id'	=>	$this->fromUsername,
			'create_time'	=>	$this->create_time,
			'response'	=>      $this->response,
			'msgid'		=>	'',
			'content'	=>	'',
			'pic_url'	=>	'',
			'location_x'	=>	0,
			'location_y'	=>	0,
			'scale'		=>	0,
			'label'		=>	'',
			'title'		=>	'',
			'description'	=>	'',
			'url'		=>	'',
			'event'		=>	'',
			'event_key'	=>	'',
			'format'	=>	'',
			'media_id'	=>	'',
			'recognition'	=>	'',
			'ip'		=>	preg_replace( '/[^0-9a-fA-F:., ]/', '',$_SERVER['REMOTE_ADDR'] ),
			'user_agent'	=> 	strtolower(trim($_SERVER['HTTP_USER_AGENT'])),
			'ticket'	=> 	'',
		);
		$msgType = $this->message_type;
		$postObj = $this->postObj;

		if($msgType == 'text'){
			$data['msgid']		= $postObj->MsgId;
			$data['content']	= $postObj->Content;
		}elseif($msgType == 'image'){
			$data['msgid']		= $postObj->MsgId;
			$data['pic_url']	= $postObj->PicUrl;
			$data['media_id']	= $postObj->MediaId;
		}elseif($msgType == 'voice'){
			$data['msgid']		= $postObj->MsgId;
			$data['format']		= $postObj->Format;
			$data['media_id']	= $postObj->MediaId;
			$data['recognition']	= $postObj->Recognition;
		}
		elseif($msgType == 'location'){
			$data['msgid']		= $postObj->MsgId;
			$data['location_x']	= $postObj->Location_X;
			$data['location_y']	= $postObj->Location_Y;
			$data['scale']		= $postObj->Scale;
			$data['label']		= $postObj->Label;
		} elseif($msgType == 'event'){
                        $data['event']          = $postObj->Event;
                        if($data['event'] == 'LOCATION'){
                                $data['location_x']     = $postObj->Latitude;
                                $data['location_y']     = $postObj->Longitude;
	                }
                        $data['event_key']      = $postObj->EventKey;
			$data['ticket']		= $postObj->Ticket;
		}
		/*
		elseif($msgType == 'link'){
			$data['MsgId']		= $postObj->MsgId;
			$data['Title']		= $postObj->Title;
			$data['Description']	= $postObj->Description;
			$data['Url']		= $postObj->Url;
		}elseif($msgType == 'event'){
			$data['Event']		= $postObj->Event;
			if($data['Event'] == 'LOCATION'){
				$data['Location_X']	= $postObj->Latitude;
				$data['Location_Y']	= $postObj->Longitude;
		}
			$data['EventKey']	= $postObj->EventKey;
		}elseif($msgType == 'voice'){
			$data['MsgId']		= $postObj->MsgId;
			$data['Format']		= $postObj->Format;
			$data['MediaId']	= $postObj->MediaId;
			$data['Recognition']= $postObj->Recognition;
		}
		*/
		file_put_contents('/tmp/data_msg',var_export($data,true));
		file_put_contents('/tmp/data_user_agent',var_export($_SERVER, true));
		drupal_write_record('weixin_msg', $data);

	}
	public function weixin_custom_keyword_handler($key_words) {
		$weixin_custom_keywords = weixin_get_custom_keywords();
		if(isset($weixin_custom_keywords)) {
			file_put_contents('/tmp/key_words',var_export($weixin_custom_keywords,true));
			$weixin_custom_reply = $weixin_custom_keywords[$key_words];
			$reply_types = weixin_get_custom_reply_type();
			$weixin_reply_type = $reply_types[$key_words];
//			file_put_contents('/tmp/reply_type',var_export($weixin_custom_reply_type,true));
			if ($weixin_custom_reply) {
				if ($weixin_reply_type == 0) {
					$weixin_content = sprintf($this->get_textTpl(), $weixin_custom_reply);
					$this->set_response('custom_reply');
					echo $weixin_content;
					return TRUE;
				} elseif ($weixin_reply_type == 1) {
					weixin_custom_nodes_reply($this, $weixin_custom_reply);
					$this->set_response('custom_reply');
					return TRUE;
				} elseif ($weixin_reply_type == 2) {
					weixin_term_posts_reply($this, $weixin_custom_reply);
					$this->set_response('custom_reply');
					return TRUE;
				}
			} 
		}
		$weixin_builtin_replies = weixin_get_builtin_replies();
		if(isset($weixin_builtin_replies[$key_words])) {
			$weixin_reply_function = $weixin_builtin_replies[$key_words]['function'];
		}
		if(isset($weixin_reply_function)) {
			$this->set_response('advanced');
			call_user_func($weixin_reply_function, $this);
			return TRUE;
		}
		if ($this->weixin_drupal_search($key_words)) {
			return TRUE;
		} else {
			$clients_enable = variable_get('weixin_clients_enable');
			if($clients_enable) {
//				echo sprintf($this->get_textTpl(), "hello");
				$this->set_response('Multi_clients');
				echo sprintf($this->get_clientsTpl());
			}
		}
	}

	public function weixin_reply_handler() {
		if ( $this->message_type == "event" ) {
			if ($this->postObj->Event == "subscribe" || $this->postObj->Event == "SCAN") {
				$this->weixin_scan_reply(trim($this->postObj->EventKey), $this->fromUsername, $this->postObj->Event);
			} elseif($this->postObj->Event == "CLICK") {
				$this->weixin_custom_keyword_handler(trim($this->postObj->EventKey));
			}
		} elseif ($this->message_type == "text") {
			$this->weixin_custom_keyword_handler(trim($this->postObj->Content));
		} elseif ($this->message_type == "voice" and strlen($this->postObj->Recognition) > 0) {
			$this->weixin_custom_keyword_handler(trim($this->postObj->Recognition));
		} else {
			$weixin_welcome = "weixin_welcome";
			$welcome_content = sprintf($this->get_textTpl(), $weixin_welcome);
			echo $welcome_content;
		}
	}

	public function weixin_scan_reply($event_key, $open_user_id, $event_type) {
		$binding_msg = qr_code_binding($event_key, $open_user_id, $event_type);
		$weixin_welcome = variable_get('weixin_welcome_message').$binding_msg;
		$welcome_content = sprintf($this->get_textTpl(), $weixin_welcome);
		file_put_contents('/tmp/weixin_reply.html',var_export($welcome_content,true));
		echo $welcome_content;
		$this->set_response('welcome');
	}

	public function getMsg(){
		$postStr = (isset($GLOBALS["HTTP_RAW_POST_DATA"]))?$GLOBALS["HTTP_RAW_POST_DATA"]:'';
		file_put_contents('/tmp/weixin.html',var_export($postStr,true));

		if (isset($_GET['debug']) || !empty($postStr)){	
			if(isset($_GET['debug'])){
				$this->fromUsername = $this->toUsername = '';
//				$keyword = strtolower(trim($_GET['t']));
			}else{
				$postObj		= simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
				$this->postObj		= $postObj;
				$this->fromUsername	= (string)$postObj->FromUserName;
				$this->toUsername	= (string)$postObj->ToUserName;
				$this->message_type	= strtolower(trim($postObj->MsgType));
				$this->create_time	= (string)$postObj->CreateTime;
				file_put_contents('/tmp/weixin.html',var_export($this,true));
				/*
				$match_keyword = $this->weixin_custom_keyword_handler();
				if ($match_keyword == FALSE) {
					$this->weixin_reply_handler();
				}
				*/
				$this->weixin_reply_handler();
				$this->weixin_insert_message();
			}
		} else {
			/* no weixin message */
		}
	}
	
	public function weixin_drupal_search($keyword=' ') {
		$url = '';
		$count = 0;
		$info = search_get_default_module_info();
		$results = search_data($keyword, $info['module']);
		if (empty($results['#results'])) {
			$message = "no results";
//			echo $this->get_clientsTpl();
//			return false;
		} else {
			foreach ($results['#results'] as $result) {
				$url = $result['link'];
				$title = $result['title'];
				$summary = strip_tags($result['node']->body[$result['node']->language][0]['summary']);
				$body = drupal_substr(strip_tags($result['node']->body[$result['node']->language][0]['safe_value']),0,10);
				/*
				if (! empty($summary)) {
					$excerpt = $summary;
				} else {
					$excerpt = $body;	
				}
				*/
				$excerpt = $body;
				$thumb = '';
				$items = $items . $this->get_item($title, $excerpt, $thumb, $url);
				$count++;
			}
			$message = "results";
			echo sprintf($this->get_picTpl(), $count, $items);
			$this->set_response('auto_search_reply');
			file_put_contents('/tmp/weixin_reply.html',var_export($excerpt, true));
			return true;
		}
	}

	public function query($keyword=''){

		$weixin_count = weixin_robot_get_setting('weixin_count');

		$post_types = get_post_types( array('exclude_from_search' => false) );
		unset($post_types['page']);
		unset($post_types['attachment']);

		$weixin_query_array = array(
			's'						=> $keyword, 
			'ignore_sticky_posts'	=> true,
			'posts_per_page'		=> $weixin_count , 
			'post_status'			=> 'publish',
			'post_type'				=> $post_types
		);

		$weixin_query_array = apply_filters('weixin_query',$weixin_query_array); 

		if(empty($this->response)){
			if(isset($weixin_query_array['s'])){
				$this->response = 'query';
			}elseif(isset($weixin_query_array['cat'])){
				$this->response = 'cat';
			}elseif(isset($weixin_query_array['tag_id'])){
				$this->response = 'tag';
			}
		}

		global $wp_the_query;
		$wp_the_query->query($weixin_query_array);

		$items = '';

		$counter = 0;

		if($wp_the_query->have_posts()){
			while ($wp_the_query->have_posts()) {
				$wp_the_query->the_post();

				global $post;

				$title	= apply_filters('weixin_title', get_the_title()); 
				$excerpt= apply_filters('weixin_description', get_post_excerpt( $post,apply_filters( 'weixin_description_length', 150 ) ) );
				$url	= apply_filters('weixin_url', get_permalink());

				if($counter == 0){
					$thumb = get_post_weixin_thumb($post, array(640,320));
				}else{
					$thumb = get_post_weixin_thumb($post, array(80,80));
				}

				$items = $items . $this->get_item($title, $excerpt, $thumb, $url);
				$counter ++;
			}
		}

		$articleCount = count($wp_the_query->posts);
		if($articleCount > $weixin_count) $articleCount = $weixin_count;

		if($articleCount){
			echo sprintf($this->get_picTpl(),$articleCount,$items);
		}else{
			if(weixin_robot_get_setting('weixin_3rd_search')){
				weixin_robot_3rd_reply();
			}else{
				weixin_robot_not_found_reply($keyword);
			}
		}
	}

	public function get_item($title, $description, $picUrl, $url){
		if(!$description) $description = $title;

		return
		'
		<item>
			<Title><![CDATA['.html_entity_decode($title, ENT_QUOTES, "utf-8" ).']]></Title>
			<Description><![CDATA['.html_entity_decode($description, ENT_QUOTES, "utf-8" ).']]></Description>
			<PicUrl><![CDATA['.$picUrl.']]></PicUrl>
			<Url><![CDATA['.$url.']]></Url>
		</item>
		';
	}

	public function get_fromUsername(){
		return $this->fromUsername;
	}

	public function get_response(){
		return $this->response;
	}

	private function get_basicTpl(){
		return "
				<ToUserName><![CDATA[".$this->fromUsername."]]></ToUserName>
				<FromUserName><![CDATA[".$this->toUsername."]]></FromUserName>
				<CreateTime>".time()."</CreateTime>
		";
	}
	public function get_textTpl(){
		return "
			<xml>".$this->get_basicTpl()."
				<MsgType><![CDATA[text]]></MsgType>
				<Content><![CDATA[%s]]></Content>
			</xml>
		";
	}

	public function get_picTpl(){
		return "
			<xml>".$this->get_basicTpl()."
				<MsgType><![CDATA[news]]></MsgType>
				<Content><![CDATA[]]></Content>
				<ArticleCount>%d</ArticleCount>
				<Articles>
				%s
				</Articles>
			</xml>
		";
	}

	public function get_imageTpl(){
		return "
			<xml>".$this->get_basicTpl()."
				<MsgType><![CDATA[image]]></MsgType>
				<Image>
				<MediaId><![CDATA[%s]]></MediaId>
				</Image>
			</xml>
		";
	}

	public function get_voiceTpl(){
		return "
			<xml>".$this->get_basicTpl()."
				<MsgType><![CDATA[voice]]></MsgType>
				<Voice>
				<MediaId><![CDATA[%s]]></MediaId>
				</Voice>
			</xml>
		";
	}

	public function get_videoTpl(){
		return "
			<xml>".$this->get_basicTpl()."
				<MsgType><![CDATA[video]]></MsgType>
				<Video>
				<MediaId><![CDATA[%s]]></MediaId>
				<Title><![CDATA[%s]]></Title>
				<Description><![CDATA[%s]]></Description>
				</Video>
			</xml>
		";
	}

	public function get_musicTpl(){
		return "
			<xml>".$this->get_basicTpl()."
				<MsgType><![CDATA[music]]></MsgType>
				<Music>
				<Title><![CDATA[%s]]></Title>
				<Description><![CDATA[%s]]></Description>
				<MusicUrl><![CDATA[%s]]></MusicUrl>
				<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
				<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
			</Music>
			</xml>
		";
	}

	public function get_clientsTpl(){
		return "
			<xml>".$this->get_basicTpl()."
				<MsgType><![CDATA[transfer_customer_service]]></MsgType>
			</xml>
		";
	}

	public function get_msgType(){
		return $this->msgType;
	}

	public function get_postObj(){
		return $this->postObj;
	}

	public function set_response($response){
		$this->response = $response;
	}


	private function checkSignature(){
		$signature	= isset($_GET["signature"])?$_GET["signature"]:'';
		$timestamp	= isset($_GET["timestamp"])?$_GET["timestamp"]:'';
		$nonce 		= isset($_GET["nonce"])?$_GET["nonce"]:'';	
				
//		$weixin_token = weixin_robot_get_setting('weixin_token');
		$weixin_token = variable_get('weixin_token');
		if(isset($_GET['debug'])){
			echo 'WEIXIN_TOKEN: '.$weixin_token."\n";
		}
		$tmpArr = array($weixin_token, $timestamp, $nonce);
		//sort($tmpArr);
		sort($tmpArr,SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

function weixin_get_custom_reply_type() {
	$keywords_array = array();	
	$weixin_custom_reply_type = cache_get('weixin_custom_define_reply_type');
	if($weixin_custom_reply_type == false) {
		$sql = "select keyword,reply_type from {weixin_reply_keyword} where status = 1";
		$result = db_query($sql);
	//		$record = $result->fetchAllAssoc('keyword');
		while ($record = $result->fetchAssoc($result)) {
			$keywords_array[$record['keyword']] = $record['reply_type'];
		}

		cache_set('weixin_custom_define_reply_type',$keywords_array,'cache',3600);	
		return $keywords_array;
	} else {
		return $weixin_custom_reply_type->data;
	}
}

function weixin_get_custom_keywords() {
	$keywords_array = array();	
	$weixin_custom_keywords = cache_get('weixin_custom_define_keywords');
	if($weixin_custom_keywords == false) {
		$sql = "select keyword,reply from {weixin_reply_keyword} where status = 1";
		$result = db_query($sql);
	//		$record = $result->fetchAllAssoc('keyword');
		while ($record = $result->fetchAssoc($result)) {
			$keywords_array[$record['keyword']] = $record['reply'];
		}

		cache_set('weixin_custom_define_keywords',$keywords_array,'cache',3600);	
		return $keywords_array;
	} else {
		return $weixin_custom_keywords->data;
	}
}

function get_weixin_message_header() {
	$columns = array(
		array('data' => t('create_time')),
		array('data' => t('nickname')),
		array('data' => t('message_type')),
		array('data' => t('content')),	
		array('data' => t('Reply type')),	
		array('data' => t('Operation')),	
	);
	return $columns;
}

function get_weixin_message_rows($string ="") {
	global $base_url;
	$rows = array();
	$cell = array();
	$query = db_select('weixin_msg','msg')->extend('PagerDefault');
	$query->join('weixin_user', 'user', 'msg.open_user_id = user.openid');
	$query->fields('msg',array('id','open_user_id','create_time','type','content','recognition','pic_url','label','location_x','location_y','event','response'));
	$query->fields('user',array('nickname','headimgurl'));
	/*
	$query->condition('event','subscribe',"!=");
	$query->condition('event','unsubscribe',"!=");
	$query->condition('event','VIEW',"!=");
	$query->condition('event','CLICK',"!=");
	$query->condition('event','SCAN',"!=");
	$query->condition('event','LOCATION',"!=");
	*/
	$query->condition('type','manual',"!=");
	$query->condition('type','event',"!=");
	$query->orderBy('create_time','DESC');
//	$query->limit(100);
	if($string) {
		$query->condition('nickname', db_like($string) . '%', 'LIKE');
	}
	$result = $query->execute();
	while($record = $result->fetchAssoc()) {
		$cell[] = format_date($record['create_time'],'short');
//		$weixin_user = weixin_robot_get_user_info($record['open_user_id']);
		$weixin_user_pic_path = $base_url.'/'.drupal_get_path('module', 'weixin').'/includes/timthumb.php?src='.$record['headimgurl']; 
		dpm($weixin_user_pic_path);
		$cell[] = $record['nickname'].'<br>'.'<a href="'.$record['headimgurl'].'" rel="lightbox"><img src='.$weixin_user_pic_path.'width="32" /></a>';
		$cell[] = $record['type'].'<br>'.format_date($record['create_time'],'short');
//		dpm($weixin_user);
		if ($record['type'] == 'text') {
			$cell[] = $record['content'];
		} elseif ($record['type'] =='voice') {
			if($record['recognition']) {
				$cell[] = t('recognition').'<br>'.$record['recognition'];
			} else{
				$cell[] = t('not recognition');
			}	
		} elseif ($record['type'] == 'image') {
				$image_path = $base_url.'/'.drupal_get_path('module', 'weixin').'/includes/timthumb.php?src='.$record['pic_url'];
				$cell[] = '<a href="'.$record['pic_url'].'" rel="lightbox"><img src='.$image_path.'width="32" /></a>';
		} elseif ($record['type'] == 'location') {
				$cell[] = '<a href="http://ditu.google.cn/maps?q='.urlencode($record['label']).'&amp;ll='.$record['location_x'].','.$record['location_y'].'&amp;source=embed" target="_blank">'.$record['label'].'</a>';
		} elseif ($record['type'] == 'event') {
				$cell[] = $record['event'];
		} 
		$cell[] = $record['response'].'<div id="reply_msg_'.$record['id'].'"></div>';
		$delete_path = $base_url.'/'.'weixin/info?id='.$record['id'].'&op=delete';
		$delete_path_link = '<a href='.$delete_path.'>delete</a>';
		$edit_path_link =  '<a href="javascript:;" onclick="reply_to_weixin('.$record['id'].')">Reply</a>';
		$reply_form_link = '<div id="reply_form-'.$record['id'].'" style="display:none">'.drupal_render(drupal_get_form('weixin_reply_msg_form',$record['open_user_id'],$record['id'])).'</div>';
		$cell[] = $delete_path_link . "|" . $edit_path_link . $reply_form_link;
		$rows[] = $cell;
		unset($cell);
	}
	return $rows;
}

/*
function weixin_message_user_filter_form_submit($form,&$form_state)
{
	$nickname = $form_state['values']['nickname'];
	get_weixin_message_table($nickname);
}
*/

function weixin_message_user_filter_form($form, &$form_state) {
	$form['nickname'] = array(
		'#type' => 'textfield',
		'#title' => t('please input the user nickname to filter'),
		'#size' => 35,
		'#autocomplete_path' => 'weixin/info/user_autocomplete_callback',
	);
	$form['submit'] = array(
		'#type' => 'submit',
		'#value' => 'submit',
		'#prefix' => '<div id="filter">',
		'#suffix' => '</div>',
		'#ajax' => array(
			'callback' => 'ajax_user_fliter_callback',
			'wrapper' => 'meg_rows',
			'effect' => 'slide',
			'event' => 'click',
		),
	);
	return $form;
}

function ajax_user_fliter_callback($form, &$form_state) {
	$nickname = $form_state['values']['nickname'];
	$output = '';
	$rows	= get_weixin_message_rows($nickname);
	$header = get_weixin_message_header();
	$output .= '<div id="meg_rows">';
	$output .= theme('table',array('header' => $header,'rows'=>$rows));
	$output .= '</div>';
//	$output .= theme('pager');
	return $output;
}

function weixin_user_autocomplete_callback($string = "") {
	$matches = array();
	if ($string) {
		/*
		$query = db_select('weixin_user','user');
		$query->fields('user',array('nickname'));
		$query->condition('nickname', db_like($string) . '%', 'LIKE');
		$query->range(0, 10)->execute();
		*/
		$query = db_select('weixin_msg','msg')->extend('TableSort');
		$query->join('weixin_user', 'user', 'msg.open_user_id = user.openid');
		$query->fields('msg',array('id','open_user_id'));
		$query->fields('user',array('nickname'));
		$query->condition('nickname', db_like($string) . '%', 'LIKE')->range(0,10);
		$result = $query->execute();
		foreach ($result as $user) {
			$matches[$user->nickname] = check_plain($user->nickname);
		}
	}
	drupal_json_output($matches); 
}

function get_weixin_message_table($nickname="") {
	global $base_url;
//	weixin_user_autocomplete_callback('bjfany');
	$rows	= get_weixin_message_rows($nickname);
	$header = get_weixin_message_header();
	$output = '';
	$output .= drupal_render(drupal_get_form('weixin_message_user_filter_form'));
	$output .= '<div id="meg_rows">';
	$output .= theme('table',array('header' => $header,'rows'=>$rows));
	$output .= '</div>';
	$output .= theme('pager');
	$info_path = $base_url.'/'.'weixin/info';
	$msg_id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
	$msg_op = isset($_REQUEST['op'])?$_REQUEST['op']:'';
 	if (! empty($msg_id) && $msg_op == "delete" ) {
		db_delete('weixin_msg')->condition('id', $msg_id)->execute();
		drupal_goto($info_path);
	}
	return $output;
}

function weixin_send_user($weixin_openid, $content, $reply_type="text") {
	$weixin_access_token = weixin_robot_get_access_token();
	$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$weixin_access_token;
	$request = array();
	$request['touser'] = $weixin_openid;
	if($reply_type == 'text'){
		$request['msgtype'] = 'text';
		$request['text'] = array('content' => urlencode($content));
	}
	if(isset($request['msgtype']) && $request['msgtype']){
		$options = array (
			'method' => 'POST',
			'data' => urldecode(json_encode($request)),
//			'headers' => array('Content-Type' => 'application/x-www-form-urlencoded'),
			'timeout' => 15,
		);
	//	dpm($options);
		$request_val = drupal_http_request($url, $options);
		$status_code = json_decode($request_val->data,true);
		return $status_code;
	}
}

function ajax_reply_user_callback($form, $form_state) 
{
	$msg = $form_state['values']['reply_msg'];
	$uid = $form_state['values']['open_id'];
	$msg_id = $form_state['values']['msg_id'];
	$reply_type_selector = '#reply_msg_'.$msg_id;
	$reply_form_selector = '#reply_form-'.$msg_id;
	$status_code = weixin_send_user($uid, $msg);
	if($status_code['errcode']) {
		$return_msg = $status_code['errcode'].":".$status_code['errmsg'];
	} else {
		$return_msg = $msg;
		$data = array(
			'type' => 'manual',
			'content' => $msg,
			'open_user_id' => $uid,
			'create_time' => time(),
		);
		drupal_write_record('weixin_msg',$data);
	}
	$commands = array();	
	$commands[] = ajax_command_after($reply_type_selector, $return_msg);
	$commands[] = ajax_command_css($reply_form_selector, array('display' => 'none'));
	return array('#type' => 'ajax', '#commands' => $commands);	
}

function weixin_reply_msg_form($form,&$form_state,$open_user_id,$id)
{
	$form['open_id'] = array(
		'#type' => 'hidden',
		'#value' => $open_user_id,
	);
	$form['msg_id'] = array(
		'#type' => 'hidden',
		'#value' => $id,
	);
	$form['reply_msg'] = array(
		'#type' => 'textfield',
		'#title' => t('Reply message'),
		'#size' => '40',
	);
	$form['submit'] = array(
		'#type' => 'submit',
		'#ajax' => array(
			'callback' => 'ajax_reply_user_callback',
//			'wrapper' => 'reply_msg_'.$id,
			'effect' => 'slide',
			'event' => 'click',
		),
		'#value' => t('Submit'),
	);
	return $form;
}

function weixin_upload_media_file($file, $type) {
	$ch = curl_init();
	$access_token = weixin_robot_get_access_token(); 
	$uri = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=".$type;
	$postdata['media'] = '@'.$file;
	curl_setopt($ch,CURLOPT_URL,$uri);
	curl_setopt($ch,CURLOPT_POST,true);  
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postdata);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$data = curl_exec($ch);
	$return_val = json_decode($data,true);
//	dpm($return_val);
	if(isset($return_val['thumb_media_id'])) {
		return $return_val['thumb_media_id'];
	}
}

function weixin_upload_news($nodes) {
	$access_token = weixin_robot_get_access_token(); 
	$articles=array();
	$type = 'image';
	foreach($nodes as $nid) {
		$news = array();
		$node = node_load($nid);
//		dpm($node);
		$news['author']=$node->name;
		$news['title']=urlencode($node->title);
//		$news['content_source_url']=url('node/'.$node->nid, array('absolute' => TRUE));;
		$news['content']=urlencode(strip_tags($node->body[$node->language][0]['safe_value'],'<p> <h2> <br> <tr> <td> <strong>'));
//		$news['content']=urlencode($node->body[$node->language][0]['safe_value']);
		$news['digest']=urlencode(strip_tags($node->body[$node->language][0]['safe_summary']));
		$image_file_uri = $node->field_image[$node->language][0]['uri'];
		$image_file_path = image_style_path('thumbnail',$image_file_uri);
		$image_server_path = drupal_realpath($image_file_path);
		$news['thumb_media_id'] = weixin_upload_media_file($image_server_path,'thumb');
		$articles['articles'][]=$news;
	}
//	dpm($articles);
//	dpm(json_encode($articles));
	$url = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token='.$access_token;
	$options = array (
		'method' => 'POST',
		'data' => urldecode(json_encode($articles)),
//		'headers' => array('Content-Type' => 'application/x-www-form-urlencoded'),
		'timeout' => 15,
	);
//	dpm($options);
	$request_val = drupal_http_request($url, $options);
	$request_val_data = json_decode($request_val->data, true);
	dpm($request_val_data);
	return $request_val_data['media_id'];
}

function weixin_nodes_send($nodes) {
//	dpm($nodes);
	/*
	$confirm_question = format_plural(count($nodes),
				'Are you sure you want to delete this item?',
				'Are you sure you want to delete these items?');
	return confirm_form($form,
			$confirm_question,
			'admin/content', t('This action cannot be undone.'),
			t('Delete'), t('Cancel'));
	*/

	$access_token = weixin_robot_get_access_token(); 
	$media_id = weixin_upload_news($nodes);
	$data=array();
	$data['filter']['group_id']=100;
	$data['mpnews']['media_id']=$media_id;
	$data['msgtype']="mpnewst";
	$url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$access_token;
	$options = array (
		'method' => 'POST',
		'data' => urldecode(json_encode($data)),
//		'headers' => array('Content-Type' => 'application/x-www-form-urlencoded'),
		'timeout' => 15,
	);
	$request_val = drupal_http_request($url, $options);
	dpm($request_val);
}

function weixin_node_send($form,$group_id=0)
{
//	dpm($form);
	$data=array();
	$data['filter']['group_id']=100;
	$data['text']['content']="hello";
	$data['msgtype']="text";
	$weixin_access_token = weixin_robot_get_access_token();
	if(isset($form->field_image['und'])) {
		$image_path = file_create_url(file_load($form->field_image['und'][0]['fid'])->uri);
//		dpm($image_path);
		$file_data = array("media" => "@".$image_path);
		$url = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$weixin_access_token.'&type=image';
		$result = https_request($url, $file_data);
		dpm($result);
		
	}
	// send to all user
	$url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$weixin_access_token;
	$options = array (
		'method' => 'POST',
		'data' => urldecode(json_encode($data)),
//		'headers' => array('Content-Type' => 'application/x-www-form-urlencoded'),
		'timeout' => 15,
	);
	$request_val = drupal_http_request($url, $options);
	dpm($request_val);
}

function weixin_get_builtin_replies($type = '') {
	$weixin_builtin_replies = cache_get('weixin_builtin_replies');
	if($weixin_builtin_replies == false) {
		$weixin_builtin_replies = array();
		$weixin_builtin_replies['new'] = array('type'=>'full','reply'=>'new article','function'=>'weixin_new_posts_reply');
		$weixin_builtin_replies['project'] = array('type'=>'full','reply'=>'new article','function'=>'weixin_new_projects_reply');
		$weixin_builtin_replies['new_task'] = array('type'=>'full','reply'=>'new article','function'=>'weixin_new_tasks_reply');
		$weixin_builtin_replies['task_status'] = array('type'=>'full','reply'=>'new article','function'=>'weixin_my_task_status');
//		$weixin_builtin_replies['term'] = array('type'=>'full','reply'=>'term article','function'=>'weixin_term_posts_reply');
	}
	return $weixin_builtin_replies;
}

//$wechatObj = new wechatCallback();
