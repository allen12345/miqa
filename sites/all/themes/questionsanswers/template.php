<?php

function questionsanswers_preprocess_html(&$variables) {
  global $base_url, $language;
  drupal_add_css(path_to_theme().'/css/color_'.theme_get_setting('tm_value_3').'.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
  if (theme_get_setting('tm_value_6')) 
    drupal_add_css(path_to_theme().'/css/top.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
}

function questionsanswers_get_pre() {
$style = theme_get_setting('skin');
switch ($style) {
	case 0:
		$p = '_blue';
		break;
	case 1:
		$p = '_gray';
		break;
	default:
		$p = '_blue';
}
return $p;
}

/* Top Menu */
function questionsanswers_menu_top($menu_name = 'menu-top-menu') {
  static $menu_output = array();

  if (!isset($menu_output[$menu_name])) {
    $tree = menu_tree_page_data($menu_name);
    $menu_output[$menu_name] = questionsanswers_menu_output_top($tree);
  }
  return $menu_output[$menu_name];
}


function questionsanswers_menu_output_top($tree) {
  $output = '';
  $items = array();

  foreach ($tree as $data) {
    if (!$data['link']['hidden']) {
      $items[] = $data;
    }
  }

  $num_items = count($items);
  foreach ($items as $i => $data) {
	$output .= '<li><a href="'.url($data['link']['href']).'">'.$data['link']['title'].'</a>'."</li>";
  }
  return $output ? '<ul class="menu">'. $output .'</ul>' : '';
}


function questionsanswers_preprocess_page(&$vars) {
  // Move secondary tabs into a separate variable.
  $vars['tabs2'] = array(
    '#theme' => 'menu_local_tasks',
    '#secondary' => $vars['tabs']['#secondary'],
  );
  unset($vars['tabs']['#secondary']);

  if (isset($vars['main_menu'])) {
    $vars['primary_nav'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
    ));
  }
  else {
    $vars['primary_nav'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_nav'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
    ));
  }
  else {
    $vars['secondary_nav'] = FALSE;
  }

  // Prepare header.
  $site_fields = array();
  if (!empty($vars['site_name'])) {
    $site_fields[] = $vars['site_name'];
  }
  if (!empty($vars['site_slogan'])) {
    $site_fields[] = $vars['site_slogan'];
  }
  $vars['site_title'] = implode(' ', $site_fields);
  if (!empty($site_fields)) {
    $site_fields[0] = '<span>' . $site_fields[0] . '</span>';
  }
  $vars['site_html'] = implode(' ', $site_fields);

  // Set a variable for the site name title and logo alt attributes text.
  $slogan_text = $vars['site_slogan'];
  $site_name_text = $vars['site_name'];
  $vars['site_name_and_slogan'] = $site_name_text . ' ' . $slogan_text;
}
/*
function questionsanswers_links__system_main_menu($variables) {
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';

    $output .= '<ul>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = array($key);

      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      $output .= '<li>';

      if (isset($link['href'])) {
        $link['html'] = TRUE;
        // Pass in $link as $options, they share the same keys.
        $output .= l('<span>'.$link['title'].'</span>', $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}
*/
function questionsanswers_links__system_secondary_menu($variables) {
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';

    $output .= '<ul>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = array();

      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'current';
      }
      $output .= '<li' . /*drupal_attributes(array('class' => $class)) .*/ '>';

      if (isset($link['href'])) {
        $link['html'] = TRUE;
        $link['attributes'] = array('class' => $class);
        // Pass in $link as $options, they share the same keys.
        $output .= l(''.$link['title'].'', $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '' . $link['title'] . '';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

function questionsanswers_tabs_out($id, $title, $text, $print = FALSE) {
	static $data = array();
	if ($id){
	  $data[$id] = new stdClass();
	  $data[$id]->id = $id;
	  $data[$id]->title = $title;
	  $data[$id]->text = $text;
	}
	if ($print and count($data)){
	  $out = $out1 = $out2 = '';
	  foreach ($data as $v) {
	    $out1 .= '<li><a class="current" rel="tab_sidebar_'.$v->id.'">'.$v->title.'</a></li>';
	    $out2 .= '<div style="display: none;" id="tab_sidebar_'.$v->id.'" class="tab_sidebar_list">'.$v->text.'</div>';
	  }
	  if ($out1) {
	    $out .= '<div class="tabs"><div class="tab_menu_container"><ul id="tab_menu">'.$out1.'</ul></div><div class="clr"></div><div class="blk"><div class="tab_container"><div class="tab_container_in">'.$out2.'</div></div></div></div>';
	  }
	  return $out;
	}	
}

function questionsanswers_addcomment_out($text, $print = FALSE) {
	static $data = '';
	if ($text){
   $data = $text;
	}
	if ($print and $data){
	  return $data;
	}	
}

function questionsanswers_zebracomment_out() {
	static $data = 'even';
	if ($data == 'even'){
	  $data = 'odd';
	}	else {
	  $data = 'even';
	}
	return $data;
}


/**
 * Preprocess function for the number_up_down template.
 */
function questionsanswers_preprocess_rate_template_number_up_down(&$variables) {
  extract($variables);

  $up_classes = 'rate-number-up-down-btn-up';
  $down_classes = 'rate-number-up-down-btn-down';
  if (isset($results['user_vote'])) {
    switch ($results['user_vote']) {
      case $links[0]['value']:
        $up_classes .= ' rate-voted';
        break;
      case $links[1]['value']:
        $down_classes .= ' rate-voted';
        break;
    }
  }

  $variables['up_button'] = theme('rate_button', array('text' => $links[0]['text'], 'href' => $links[0]['href'], 'class' => $up_classes));
  $variables['down_button'] = theme('rate_button', array('text' => $links[1]['text'], 'href' => $links[1]['href'], 'class' => $down_classes));
  if ($results['rating'] > 0) {
    $score = '+' . $results['rating'];
    $score_class = 'positive';
  }
  elseif ($results['rating'] < 0) {
    $score = $results['rating'];
    $score_class = 'negative';
  }
  else {
    $score = 0;
    $score_class = 'neutral';
  }
  $variables['score'] = $score . ' <span>' . t('likes') . '</span>';
  $variables['score_class'] = $score_class;

  $info = array();
  if ($mode == RATE_CLOSED) {
    $info[] = t('Voting is closed.');
  }
  if ($mode != RATE_COMPACT && $mode != RATE_COMPACT_DISABLED) {
    if (isset($results['user_vote'])) {
      $info[] = t('You voted \'@option\'.', array('@option' => $results['user_vote'] == 1 ? $links[0]['text'] : $links[1]['text']));
    }
  }
  $variables['info'] = implode(' ', $info);
}






/* Node */
function questionsanswers_get_node($type = 'type') {
	static $node = false;
	if (!$node and arg(0) == 'node' and is_numeric(arg(1))){
	//	$node = db_fetch_array(db_query('SELECT * FROM {node} where nid = %d',arg(1)));
	}	
  return $node[$type];
}

function questionsanswers_get_term($terms, $voc = 1) {
	$out = '';
	$o = array();
	if (is_array($terms)){
		foreach ($terms as $data) {
			if ($data->vid == $voc or $voc == 0)
				$o[] = l($data->name, 'taxonomy/term/'.$data->tid);
		}
		$out = implode(' ', $o);
	}	
	return $out;
}

/*
function questionsanswers_get_count_comments($node) {
	$out = '';
  $comments = comment_load_multiple(array(), array('pid' => $pid));
  foreach ($comments as $com) {
    $comment = comment_view($com, $node);
    $destination = "comment/reply/$com->nid/$com->cid";
    if (isset($comment['links']['comment']['#links']['comment_forbidden']['title'])) $comment['links']['comment']['#links']['comment_forbidden']['title'] = t('<a href="!login">Log in</a> or <a href="!register">register</a> to post answer', array('!login' => url('user/login', array('query' => array('destination' => $destination))), '!register' => url('user/register', array('query' => array('destination' => $destination))) ));

		$out .= '<div class="user_answer_small_details">'.render($comment['comment_body']).render($comment['links']).' '.theme('username', array('account' => $comment['#comment'])).' '.format_date($comment['#comment']->created).'</div>'.questionsanswers_get_comments($comment['#comment']->cid, $node); 

    //unset($comment['comment_body']);
    //unset($comment['links']);
    //$out .= '<pre>'. check_plain(print_r($comment['links'], 1)) .'</pre>';
	}	
  return $out;
} 
*/
function questionsanswers_get_comments($pid, $node) {
	$out = '';

  $comments = comment_load_multiple(array(), array('pid' => $pid));
  foreach ($comments as $com) {
    $comment = comment_view($com, $node);
    $destination = "comment/reply/$com->nid/$com->cid";
    if (isset($comment['links']['comment']['#links']['comment_forbidden']['title'])) $comment['links']['comment']['#links']['comment_forbidden']['title'] = t('<a href="!login">Log in</a> or <a href="!register">register</a> to post answer', array('!login' => url('user/login', array('query' => array('destination' => $destination))), '!register' => url('user/register', array('query' => array('destination' => $destination))) ));

		$out .= '<div class="rep">'.render($comment['comment_body']).t('Said').' '.theme('username', array('account' => $comment['#comment'])).' '.t('on').' '.format_date($comment['#comment']->created,'custom','M d, Y').render($comment['links']).'</div>'.questionsanswers_get_comments($comment['#comment']->cid, $node); 

    //unset($comment['comment_body']);
    //unset($comment['links']);
    //$out .= '<pre>'. check_plain(print_r($comment['links'], 1)) .'</pre>';
	}	
  return $out;
} 

function questionsanswers_get_comments_count($nid) {
  $n = db_select('comment', 't');
  $n->condition('t.nid', $nid);
  $n->condition('t.pid', 0);
  $n->addExpression('COUNT(t.cid)');
  $count = (int)$n->execute()->fetchField();
  if (!$count) $count = 0;
	return $count;
} 


function questionsanswers_user_tags($tags, $nid, $ret = FALSE) {
  static $out = array();
  
  if ($tags) {
    $temp = explode('~~~', $tags);
    if (is_array($temp)) {
      foreach ($temp as $arg) {
        $out[$arg][$nid] = $arg;
      }
    }
  }

  if ($ret and count($out)) {
    //$o = '<div class="user_profile_tags"><div class="user_profile_tags_title"><h3>'.t('Tags').' ('.count($out).')</h3></div><div class="user_profile_tags_inn"><table class="tags_content_table"><tr>';
    $o = '<table class="tags_content_table"><tr>';
    $j = 0;
    foreach ($out as $key => $arg) {
      //$out[$key] = $arg;
      //$o .= $arg;
      if ($j == 2) { 
        $o .= '</tr><tr>'; 
        $j = 0; 
      }
      $o .= '<td>'.str_replace('</a>', '<sup>'.count($out[$key]).'</sup></a>',$key).'</td>';
      $j++; 
    }
    for ($i = 1; $i <= (2 - $j); $i++) { $o .= '<td></td>'; }
    //$o .= '</tr></table></div></div>';
    $o .= '</tr></table>';
    return $o;
  }
  
} 

function questionsanswers_tags_filter($tags) {
  static $out = array();
  if ($tags and isset($out[$tags])) {
    return FALSE;
  } else {
    $out[$tags] = $tags;
    return TRUE;
  }
} 

/*
function questionsanswers_preprocess_user_profile(&$variables) {
  $variables['profile'] = array();
  // Sort sections by weight
  uasort($variables['account']->content, 'element_sort');
  foreach (element_children($variables['account']->content) as $key) {
    $variables['profile'][$key] = drupal_render($variables['account']->content[$key]);
  }
  $variables['var'] = $variables['account'];
  if (!empty($variables['account']->picture) && file_exists($variables['account']->picture)) {
    $picture = file_create_url($variables['account']->picture);
  } else if (variable_get('user_picture_default', '')) {
    $picture = variable_get('user_picture_default', '');
  }
  if (isset($picture)) {
    $alt = t("@user's picture", array('@user' => $variables['account']->name ? $variables['account']->name : variable_get('anonymous', t('Anonymous'))));
    $picture = theme('image', $picture, $alt, $alt, '', FALSE);
    if (!empty($variables['account']->uid) && user_access('access user profiles')) {
      $attributes = array('attributes' => array('title' => t('View user profile.')), 'html' => TRUE);
      $picture = l($picture, "user/".$variables['account']->uid, $attributes);
    }
  $variables['var']->picture = $picture;
  }
//  $twitter = twitter_twitter_accounts($variables['account']);
//  $variables['var']->twitter = $twitter;
  if (!$variables['var']->profile_name) $variables['var']->profile_name = $variables['account']->name;
  $time = time();
  if ($variables['var']->profile_birthday) $variables['var']->age = format_interval($time - mktime(0,0,0,$variables['var']->profile_birthday['month'],$variables['var']->profile_birthday['day'],$variables['var']->profile_birthday['year']), 1);
  $variables['var']->created_c = format_interval($time - $variables['var']->created, 2);
  $variables['var']->access_c = format_interval($time - $variables['var']->access, 2);

  $variables['var']->questions_c = db_result(db_query("SELECT count(nid) FROM {node} WHERE uid = %d and type = 'question'",$variables['account']->uid));
  $result = db_query("SELECT n.*, c.comment_count FROM {node} n LEFT JOIN {node_comment_statistics} c ON c.nid = n.nid WHERE n.uid = %d and n.type = 'question' LIMIT 0 , 30",$variables['account']->uid);
  while ($question = db_fetch_object($result)) {
	$variables['var']->questions[$question->nid] = $question;

	$variables['var']->questions[$question->nid]->comment_count = db_result(db_query("SELECT count(cid) FROM {comments} WHERE nid = %d and pid = 0",$question->nid));

    $variables['var']->questions[$question->nid]->vud = theme('vud_widget', $question->nid, 'node', variable_get('vud_tag', 'vote'), variable_get('vud_node_widget', 'plain'), (user_access('use vote up/down on nodes') || user_access('view vote up/down count on nodes')), '');
	$variables['var']->questions[$question->nid]->created_c = format_interval($time - $question->created);
	$statistics = statistics_get($question->nid);
	if ($statistics) {
		$variables['var']->questions[$question->nid]->count = format_plural($statistics['totalcount'], '<span>1</span> view', '<span>@count</span> views');
	}
  }
  $tag = variable_get('vud_tag', 'vote');
  $variables['var']->answers_c = db_result(db_query("SELECT count(c.cid) FROM {comments} c INNER JOIN {node} n ON n.nid = c.nid WHERE c.uid = %d and c.pid = 0 and n.type = 'question'",$variables['account']->uid));
  $result = db_query("SELECT c.* FROM {comments} c INNER JOIN {node} n ON n.nid = c.nid WHERE c.uid = %d and c.pid = 0 and n.type = 'question' ORDER BY timestamp DESC LIMIT 0 , 30",$variables['account']->uid);
  while ($answers = db_fetch_object($result)) {
	$variables['var']->answers[$answers->cid] = $answers;
	$criteria = array(
		'content_type' => 'comment',
		'content_id' => $answers->cid,
		'value_type' => 'points',
		'tag' => $tag,
		'function' => 'sum'
	);
	$variables['var']->answers[$answers->cid]->vud_sum = (int) votingapi_select_single_result_value($criteria);
  }
  $variables['var']->tags_c = db_result(db_query("SELECT count(t.tid) FROM {term_node} t INNER JOIN {node} n ON n.vid = t.vid INNER JOIN {term_data} d ON d.tid = t.tid WHERE n.uid = %d and n.type = 'question' and d.vid = 1",$variables['account']->uid));
  $result = db_query("SELECT d.* FROM {term_node} t INNER JOIN {node} n ON n.vid = t.vid INNER JOIN {term_data} d ON d.tid = t.tid WHERE n.uid = %d and n.type = 'question' and d.vid = 1 LIMIT 0 , 60",$variables['account']->uid);
  while ($tags = db_fetch_object($result)) {
	$variables['var']->tags[$tags->tid] = $tags;
	$variables['var']->tags[$tags->tid]->node_c = questionsanswers_get_term_node_count($tags->tid);
  }
  $variables['var']->userpoints = userpoints_get_current_points($variables['account']->uid);
}
*/

function questionsanswers_get_term_node_count($term) {
  $n = db_select('taxonomy_index', 't');
  $n->condition('t.tid', $term);
  $n->addExpression('COUNT(t.nid)');
  $count = (int)$n->execute()->fetchField();
  if (!$count) $count = 0;
	return $count;
}


function questionsanswers_comment_view($comment, $node, $links = array(), $visible = TRUE) {
  static $first_new = TRUE;

  $output = '';
  $comment->new = node_mark($comment->nid, $comment->timestamp);
  if ($first_new && $comment->new != MARK_READ) {
    // Assign the anchor only for the first new comment. This avoids duplicate
    // id attributes on a page.
    $first_new = FALSE;
    $output .= "<a id=\"new\"></a>\n";
  }

  $output .= "<a id=\"comment-$comment->cid\"></a>\n";

  // Switch to folded/unfolded view of the comment
  if ($visible) {
    $comment->comment = check_markup($comment->comment, $comment->format, FALSE);

    // Comment API hook
	$comment1 = $comment->comment;
    comment_invoke_comment($comment, 'view');
	$comment->comment = $comment1;

	$type = _vud_comment_get_node_type($comment->nid);
    $comment_allow = in_array($type, variable_get('vud_comment_node_types', array()), TRUE);
    if ($comment_allow && user_access('use vote up/down on comments')) {
      $tag = variable_get('vud_tag', 'vote');
      $widget = variable_get('vud_comment_widget', 'plain');
      $comment->vud = theme('vud_widget', $comment->cid, 'comment', $tag, $widget);
    }
	$comment->userpoints = userpoints_get_current_points($comment->uid);
    $output .= theme('comment', $comment, $node, $links);
  }
  else {
    $output .= theme('comment_folded', $comment);
  }

  return $output;
}
/*
function questionsanswers_links($links, $attributes = array('class' => 'links')) {
  global $language;
  $output = '';
  if ($attributes['type']) {
  if (count($links) > 0) {
    $output = '';
    $i = true;
    foreach ($links as $key => $link) {
		$class = '';
      if ($i and $attributes['type']) $classl = 'first_tabber_item'; else $classl = '';

	  if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language->language)) {
        if ($attributes['type'] == 2) $class = 'current'; else  $class = 'active';

      }
      $output .= '<li'. drupal_attributes(array('class' => $class)) .'>';

      if (isset($link['href'])) {
		$link['html'] = true;
		$link['attributes']['class'] = $classl;
        $output .= l('<span>'.$link['title'].'</span>', $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i = false;
      $output .= "</li>\n";
    }

  }
  } else {
	  $output = theme_links($links, $attributes);
  }

  return $output;
}
*/

function questionsanswers_get_field_var($data, $arg = 'value') {
  if (isset($data) and is_array($data) and count($data)) {
    $var = each ($data);
    if (isset($var['value']) and is_array($var['value']) and count($var['value'])) {
      $var = each ($var['value']);
      if (isset($var['value'][$arg])) {
        return $var['value'][$arg];
      }
    }
  }
	return false;
}

function questionsanswers_box($title, $content, $region = 'main') {
  global $user;
  $v1 = array('class="form-textarea resizable required"');
  $v2 = array('class="form-textarea required"');
  if (!$user->uid) {
    $v1[] = 'class="form-submit"';
    $v2[] = 'class="form-submit anon"';
  }
  $output = '<div class="box"><h2 class="title">'. $title .'</h2><div>'. str_replace($v1,$v2,$content) .'</div></div>';
  return $output;
}