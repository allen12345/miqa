<?php $acc = user_load(arg(1)); 
$field_twitter = strip_tags(render($user_profile['field_twitter']));
?>
<div class="left info">
  <?php print render($user_profile['user_picture']); ?>
  <?php if ($field_name = render($user_profile['field_name'])) { ?><h1 class="title"><?php print $field_name; ?></h1><?php } ?>
  <dl>
    <dt><?php print t('Member for'); ?>:</dt><dd><?php print format_interval(time() - $acc->created, 2); ?></dd>
    <dt><?php print t('Seen'); ?>:</dt><dd><?php print format_interval(time() - $acc->access, 2); ?></dd>
    <?php if ($field_location = render($user_profile['field_location'])) { ?><dt><?php print t('Location'); ?>:</dt><dd><?php print $field_location; ?></dd><?php } ?>
    <?php if ($field_birthday =strip_tags(render($user_profile['field_birthdayu']))) { ?><dt><?php print t('Age'); ?>:</dt><dd><?php print format_interval(time() - $field_birthday, 1); ?></dd><?php } ?>
    <?php if ($field_url = strip_tags(render($user_profile['field_url']))) { if (strlen($field_url) > 15) $profile_url = substr($field_url, 0, 19).'...'; else $profile_url = $field_url; ?><dt><?php print t('Website'); ?>:</dt><dd><a href="<?php print $field_url; ?>"><?php print $profile_url; ?></a></dd><?php } ?>
    <dt><?php print t('Reputation'); ?>:</dt><dd><?php print userpoints_get_current_points($acc->uid, 0); ?></dd>
  </dl>
</div>
<div class="right badges">
  <?php if ($user_level_id =strip_tags(render($user_profile['user_level_id']))) { ?><div class="stat<?php print $user_level_id; ?>"><?php print t('!level Member', array('!level' => render($user_profile['user_level_name']))); ?></div><?php } ?>
  <a href="<?php print url('node/16'); ?>" class="seebadges"><?php print t('See badges'); ?></a>
  <div class="clr"></div>
  <?php print render($user_profile['user_badges']); ?>
</div>
<div class="clr"></div>

<?php
$ff = FALSE;
if ($field_about = render($user_profile['field_about']) and $field_twitter) { 
  $ff = TRUE;
}
?>
<?php if ($field_about) { ?>
  <div class="<?php if ($ff) { print 'left '; }?>about"><div class="blk-u">
    <div class="title"><?php print t('About'); ?></div>
    <?php print $field_about; ?>
  </div></div>
<?php } ?>
<?php if ($field_twitter) { ?>
  <div class="<?php if ($ff) { print 'right '; }?>twit"><div class="blk-u">
    <div class="title"><?php print t('Latest tweets'); ?></div>
    <div class="widget-twitter activity" data-username="<?php print $field_twitter; ?>" data-count="2" data-retweets="true">
		  <div class="tweets"><ul class="tweet_list"></ul></div>
    </div> 
  </div></div>
<?php } ?>
<div class="clr">&nbsp;</div>
<div class="content-left last-l">            
  <?php
    $name = 'user_questions';
    $display_id = 'block';
    if ($view = views_get_view($name)) {
      if ($view->access($display_id)) {
        $output = $view->execute_display($display_id);
        $view->destroy();
        print '<div class="title">'.$output['subject'].'</div>';
	      print $output['content'];
      }
      $view->destroy();
    }
  ?>
</div>
<div class="content-right last-l">
  <?php
    $name = 'user_answers';
    $display_id = 'block';
    if ($view = views_get_view($name)) {
      if ($view->access($display_id)) {
        $output = $view->execute_display($display_id);
        $view->destroy();
        print '<div class="title">'.$output['subject'].'</div>';
	      print $output['content'];
      }
      $view->destroy();
    }
  ?>
</div>
<div class="clr"></div>
<div class="content-left last-l">
  <?php
    $name = 'user_tags';
    $display_id = 'block';
    if ($view = views_get_view($name)) {
      if ($view->access($display_id)) {
        $output = $view->execute_display($display_id);
        $view->destroy();
        print '<div class="title">'.$output['subject'].'</div>';
	      print $output['content'];
      }
      $view->destroy();
    }
  ?>
</div>
<div class="content-right last-l">
  <?php
    $name = 'user_blogs';
    $display_id = 'block';
    if ($view = views_get_view($name)) {
      if ($view->access($display_id)) {
        $output = $view->execute_display($display_id);
        $view->destroy();
        print '<div class="title">'.$output['subject'].'</div>';
	      print $output['content'];
      }
      $view->destroy();
    }
  ?>
</div>
<div class="clr"></div>

<div class="profile"<?php print $attributes; ?>>
  <?php //print render($user_profile); ?>
</div>
<?php 
/*
unset($user_profile['field_about']);
unset($user_profile['user_picture']);
unset($user_profile['field_name']);
unset($user_profile['userpoints']);
unset($user_profile['field_location']);
unset($user_profile['field_url']);
unset($user_profile['summary']);
unset($user_profile['simplenews']);
unset($user_profile['field_birthdayu']);
*/
//print '<div class="user_profile_main"><pre>'. check_plain(print_r($user_profile, 1)) .'</pre></div>'; 

?>