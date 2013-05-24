<div class="blg-comment">
  <?php print questionsanswers_helper_user_level_img($node->uid); ?> 
  <?php print $picture ?> 
  <?php print $comment->name ?> says:<br /><?php print format_date($comment->created,'custom','M d, Y') ?>
  <div class="text">
    <?php
    //hide($content['links']);
    print render($content);
    ?>
  </div>
</div>
<?php 
//unset($content['comment_body']);
//unset($content['links']);
//print '<pre>'. check_plain(print_r($comment, 1)) .'</pre>'; ?>