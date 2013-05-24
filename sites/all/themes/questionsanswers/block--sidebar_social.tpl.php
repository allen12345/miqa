<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php if ($block->subject) { print '<h5>'.$block->subject.'</h5>'; } ?>
  <?php print render($title_suffix); ?>
  <div class="socc"><?php print $content; ?></div>
</div>