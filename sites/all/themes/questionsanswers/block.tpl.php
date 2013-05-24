<div id="<?php print $block_html_id; ?>" class="blk <?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php if ($block->subject) { print '<div class="title">'.$block->subject.'</div>'; } ?>
  <?php print render($title_suffix); ?>
  <?php print $content; ?>
</div>
<?php //print '<pre>'. check_plain(print_r($block, 1)) .'</pre>'; ?>