<div class="con-1">
  <?php print (isset($fields['field_image']->content) ? $fields['field_image']->content : ''); ?>
  <div class="text"><?php print $fields['title']->content; ?></div>
  <div class="data"><?php print $fields['created']->content; ?></div>
</div>