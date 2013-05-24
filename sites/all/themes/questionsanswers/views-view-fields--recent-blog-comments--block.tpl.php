<div class="con-1">
  <?php print (isset($fields['field_image']->content) ? $fields['field_image']->content : ''); ?>
  <div class="text"><a href="<?php print $fields['path']->content; ?>#comment-<?php print $fields['cid']->content; ?>"><?php print $fields['comment_body']->content; ?></a></div>
  <div class="data"><?php print $fields['created']->content; ?></div>
</div>