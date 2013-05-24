<?php 
$us = user_load($fields['uid']->content);
$us = user_view($us);
if ($field_name = strip_tags(render($us['field_name']))) $field_name = l($field_name.'<sup>'.$fields['points']->content.'</sup>','user/'.$fields['uid']->content,array('html' => TRUE));
else $field_name = l($us['#account']->name.'<sup>'.$fields['points']->content.'</sup>','user/'.$fields['uid']->content,array('html' => TRUE));
print questionsanswers_helper_user_level_img($fields['uid']->content).render($us['user_picture']).
      '<div class="tt">'.
        $field_name.'<br />'.
        questionsanswers_helper_user_questions($fields['uid']->content).'<br />'.
        questionsanswers_helper_user_answers($fields['uid']->content).'<br />'.
        questionsanswers_helper_user_tags($fields['uid']->content).'<br />'.
      '</div>'; 
?>