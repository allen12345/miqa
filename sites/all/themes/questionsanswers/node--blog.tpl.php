<?php 
$statistics = statistics_get($node->nid);
if (!$statistics) {  
  $statistics['totalcount'] = 0;
}
$count = format_plural($statistics['totalcount'], '1 view', '@count views');
$comment = '<a href="'.url("node/$node->nid", array('fragment' => 'comments')).'">'.format_plural($node->comment_count, '1 comment', '@count comments').'</a>';
if ($page == 0) { ?>
<div class="con-bt">
  <?php print render($content['field_image']); ?>
  <a href="<?php print $node_url ?>" title="<?php print $title ?>" class="title"><?php print $title ?></a>
  <?php 
    hide($content['comments']);
    hide($content['links']);
    print render($content); 
  ?>
  <div class="user">
    <?php print questionsanswers_helper_user_level_img($node->uid); ?> 
    <?php print $user_picture; ?>
    <div class="user-data">
      <?php print $name ?><br />
      <?php print format_date($node->created,'custom','M d, Y') ?><br />
      <?php if ($node->comment_count > 0) { ?><?php print $comment ?><br /><?php } ?>
      <?php print $count ?>
    </div>
  </div>
  <div class="clr"></div>
</div>
<?php } else { ?>
<div class="user">
  <?php print t('By !user on !date and it has !comment and !view', array(
    '!user' => $name, 
    '!date' => format_date($node->created,'custom','M d, Y'), 
    '!comment' => $comment, 
    '!view' => $count
  )) ?>
</div>
<div class="text">
  <?php 
    hide($content['comments']);
    hide($content['links']);
    print render($content); 
  ?>
</div>
<div class="clr"></div>
<hr />
<div class="links"><?php print render($content['links']); ?></div>
<hr />
<?php print render($content['comments']); ?>
<?php } ?>
<?php //print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>