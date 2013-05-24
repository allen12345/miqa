<?php if ($comment->pid == 0 or (arg(0) == 'comment' and arg(1) == 'reply')) { 
global $user;
$destination = "comment/reply/$comment->nid/$comment->cid";
if (isset($content['links']['comment']['#links']['comment_forbidden']['title'])) $content['links']['comment']['#links']['comment_forbidden']['title'] = t('<a href="!login">Log in</a> or <a href="!register">register</a> to post answer', array('!login' => url('user/login', array('query' => array('destination' => $destination))), '!register' => url('user/register', array('query' => array('destination' => $destination))) ));
?>
<div class="comment">
  <div class="user">
    <?php print questionsanswers_helper_user_level_img($node->uid); ?>
    <?php print $picture ?>
    <?php $ccid = questionsanswers_helper_node_load_bestanswer($comment->nid); if ($ccid == $comment->cid) print '<div class="i-best">'.t('best answer').'</div>'; ?>
    <div class="data"><?php print $comment->name ?></div>
		<div class="data"><?php print format_date($comment->created,'custom','M d, Y') ?></div> 
    <?php if ($comment->uid) { ?><div class="data"><?php print t('Reputation') ?>: <?php print userpoints_get_current_points($comment->uid) ?></div><?php } ?>
    <?php if ($rate_voting = render($content['rate_voting'])) { ?><div class="data"><?php print $rate_voting ?><div class="clr"></div></div><?php } ?>
    <?php if ($node->uid and $user->uid and $node->uid == $user->uid) { ?><div class="data"><?php print l('Best Answer' , 'node/'.$comment->nid.'/bestanswer/'.$comment->cid) ?><div class="clr"></div></div><?php } ?>
  </div>
 
  <div class="con <?php if ($ccid == $comment->cid) print 'odd'; else print 'even'; ?>">
    <div class="st"></div>
    <div class="text">
      <?php
        //hide($content['links']);
        print render($content);
      ?>
      <?php print questionsanswers_get_comments($comment->cid, $node) ?>
    </div>
  </div>
  <div class="clr"></div>
</div>
<?php } else {print ' ';}?>
<?php 
//unset($content['comment_body']);
//unset($content['links']);
//print '<pre>'. check_plain(print_r($comment, 1)) .'</pre>'; ?>