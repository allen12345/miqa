<?php 
$us = user_load($fields['uid']->content);
$us = user_view($us);
print '<div class="user-picture">'.questionsanswers_helper_user_level_img($fields['uid']->content).str_replace(array('<div class="user-picture">', '</div>'), '', render($us['user_picture'])).'</div>'; 
?>