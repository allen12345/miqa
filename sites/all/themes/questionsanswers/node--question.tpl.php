<?php 
$statistics = statistics_get($node->nid);
if (!$statistics) {  
  $statistics['totalcount'] = 0;
}
$count = format_plural($statistics['totalcount'], '1 view', '@count views');
$account = user_load($node->uid);
if ($node->uid) $ul = '<a href="'.url("user/$node->uid").'">'.render($content['field_name']).'</a>';
else $ul = ''.render($content['field_name']).'';

if ($page == 0) { ?>
<div class="con-t">
  <div class="count"><?php print questionsanswers_get_comments_count($node->nid) ?> <span><?php print t('answers') ?></span></div>
  <div class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></div>
  <div class="text"><?php hide($content['comments']); hide($content['links']); hide($content['rate_voting']); print render($content); ?></div>
  <div class="user">
    <?php print questionsanswers_helper_user_level_img($node->uid); ?>
    <?php print $user_picture; ?><?php print render($content['rate_voting']); ?>
    <div class="user-data"><?php print $ul ?> asked on <?php print format_date($node->created,'custom','M d, Y') ?> and it has <?php print $count ?>.<br />
    <a href="<?php print $node_url ?>"><?php print t('See the Best Answer') ?></a></div>
  </div>
</div>

<?php } else { ?>
<div class="con-q">
  <div class="user">
    <?php print questionsanswers_helper_user_level_img($node->uid); ?> 
    <?php print $user_picture; ?> 
    <div class="i-question"></div>
    <div class="data"><?php if ($node->uid) { ?><a href="<?php print url('user/'.$node->uid); ?>"><?php print render($content['field_name']); ?></a><?php } else { print render($content['field_name']); }?></div>
		<div class="data"><?php print format_date($node->created,'custom','M d, Y') ?></div> 
    <?php if ($count) { ?><div class="data"><?php print $count ?></div><?php } ?>
    <?php if ($node->uid) { ?><div class="data"><?php print t('Reputation') ?>: <?php print userpoints_get_current_points($node->uid) ?></div><?php } ?>
    <?php if ($rate_voting = render($content['rate_voting'])) { ?><div class="data"><?php print $rate_voting ?><div class="clr"></div></div><?php } ?>
    <?php if ($sharethis = render($content['sharethis'])) { ?><div class="data"><?php print $sharethis ?></div><?php } ?>
  </div>
  <div class="con">
    <h1 class="title"><?php print $title ?></h1>
    <?php if ($field_tags = render($content['field_tags'])) { ?><div class="tags"><?php print $field_tags ?></div><?php } ?>
    <div class="text">
      <?php 
      hide($content['comments']);
      hide($content['links']);
      print render($content); 
      ?>
    </div>
  </div>
  <div class="clr"></div>
</div>
<?php 
if (variable_get('comment_form_location_'. $node->type, COMMENT_FORM_SEPARATE_PAGE) == COMMENT_FORM_SEPARATE_PAGE) {
  $destination = "comment/reply/$node->nid#comment-form";
} else {
  $destination = "node/$node->nid#comment-form";
}
if (isset($content['links']['comment']['#links']['comment-add']['title'])) $content['links']['comment']['#links']['comment-add']['title'] = t('Add new answer');
if (isset($content['links']['comment']['#links']['comment_forbidden']['title'])) $content['links']['comment']['#links']['comment_forbidden']['title'] = t('<a href="!login">Log in</a> or <a href="!register">register</a> to post answer', array('!login' => url('user/login', array('query' => array('destination' => $destination))), '!register' => url('user/register', array('query' => array('destination' => $destination))) ));
unset($content['links']['statistics']);
?>
<?php questionsanswers_addcomment_out(render($content['links'])); ?>
<?php print render($content['comments']); ?>
<?php } ?>

<?php 
unset($content['field_name']);
unset($content['body']);
unset($content['comments']);
//unset($content['links']);
unset($content['field_tags']);
unset($content['field_email']);
unset($content['field_url']);
unset($content['rate_voting']);
unset($content['#printed']);
unset($content['#sorted']);
unset($content['#children']);
//print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>
