<?php global $user; ?>
<div class="blg-comments">
  <?php if ($node->comment_count) { ?>
    <h3 class="title"><?php print t('Comments'); ?></h3>
    <h2 class="title"><?php print t('!count Responses to Post !title', array('!count' => $node->comment_count, '!title' => $node->title)); ?></h2>
    <hr />
  <?php print render($content['comments']); ?>
  <?php } ?>
  <?php if ($content['comment_form']): ?>
    <div class="box">
      <div class="title"><?php print t('Leave a Comment'); ?></div>
      <?php print str_replace('resizable', '', render($content['comment_form'])); ?>
    </div>
  <?php endif; ?>             
</div>
<div class="clr"></div>
<?php //print '<pre>'. check_plain(print_r($node, 1)) .'</pre>'; ?>