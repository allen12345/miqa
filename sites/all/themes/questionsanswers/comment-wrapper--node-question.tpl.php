<?php global $user; ?>
<div class="comments">
<div class="comments-l"><?php print questionsanswers_addcomment_out(FALSE, TRUE); ?></div><h2 class="title"><?php print t('!count answers',array('!count' => questionsanswers_get_comments_count($node->nid))) ?></h2>
  <?php print render($content['comments']); ?>              
  <?php if ($content['comment_form']) { ?>
    <div class="clr">&nbsp;</div>
    <div class="blk-comment-form">
      <div class="title"><?php print t('Your Answer'); ?></div>
      <?php print str_replace('resizable', '', render($content['comment_form'])); ?>
    </div>
  <?php } ?>
</div>
<div class="clr"></div>
<?php //print '<pre>'. check_plain(print_r($node, 1)) .'</pre>'; ?>