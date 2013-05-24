<?php if ($page == 0) { ?>
<div class="con-bt">
  <a href="<?php print $node_url ?>" title="<?php print $title ?>" class="title"><?php print $title ?></a>
  <?php 
    hide($content['comments']);
    hide($content['links']);
    print render($content); 
  ?>
  <div class="clr"></div>
</div>
<?php } else { ?>
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