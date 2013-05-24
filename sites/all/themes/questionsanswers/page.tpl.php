<?php 
print render($page['header']);
global $user, $base_url; 
$n = db_select('node', 'n');
$n->condition('type', 'question');
$n->condition('status', 1);
$n->addExpression('COUNT(n.nid)');
$qcount = (int)$n->execute()->fetchField();
//profile_load_profile($user);
$isnode = (arg(0)=='node' and is_numeric(arg(1)) and !arg(2));
if (!(isset($page['content']['system_main']['nodes'][arg(1)]) and isset($page['content']['system_main']['nodes'][arg(1)]['#node']->type))) { $page['content']['system_main']['nodes'][arg(1)]['#node'] = new stdClass(); $page['content']['system_main']['nodes'][arg(1)]['#node']->type = '';}
?>
    <div class="header">
      <div class="top">
        <div class="inn"> 
          <div class="left logo">
            <?php if (theme_get_setting('default_logo')) { ?>
              <a href="<?php print check_url($front_page); ?>" title="<?php print $site_name; ?>" rel="home" id="logo"><img src="<?php print $base_url.'/'.drupal_get_path('theme','questionsanswers').'/img/logo-'.theme_get_setting('tm_value_3').'.png'; ?>" alt="<?php print $site_name; ?>" /></a>
            <?php } else { ?>
              <a href="<?php print check_url($front_page); ?>" title="<?php print $site_name; ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" /></a>
            <?php } ?>
            <a href="<?php print check_url($front_page); ?>"><?php print $site_title; ?></a> 
          </div>
          <div class="right soc">
            <?php print render($page['sidebar_social']); ?>
          </div>
          <div class="center r">
            <ul class="menu">
              <?php if ($user->uid) { ?>
                <li><a href="<?php echo url('user/'.$user->uid); ?>"><?php echo t('My Account'); ?></a></li>
                <li>or</li>
                <li><a href="<?php echo url('user/logout'); ?>"><?php echo t('Log Out'); ?></a></li>
              <?php } else { ?>
                <li><a href="<?php echo url('user'); ?>"><?php echo t('Sign in'); ?></a></li>
                <li>or</li>
                <li><a href="<?php echo url('user/register'); ?>"><?php echo t('Register'); ?></a></li>
              <?php } ?>
            </ul>
          </div>
          <div class="center l">
            <?php print questionsanswers_menu_top() ?>
          </div>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="nav">
        <div class="inn">
          <?php if ($primary_nav) { print $primary_nav; } ?>
          <div class="search">
            <?php print render($page['sidebar_search']); ?>
          </div>
        </div>
        <div class="clr"></div>
      </div>
      
    </div>
    <div class="main">
      <div class="main-content-block">
        <div class="left">
          <?php if ($content_top = render($page['content_top'])) { print '<div class="mess">'.$content_top.'</div>'; } ?>
          <?php if (!empty($messages)): print $messages; endif; ?>
          <?php if ($tabs) { print '<div class="dtab">'. render($tabs) .'</div>'; } ?>
          <?php if ($secondary_nav){ print '<div class="tabs-main"><div class="tab-main_menu_container">'.$secondary_nav.'</div><div class="clr"></div>'; } else { print '<div>'; } ?>
            <div class="blk">
              <?php if (arg(0) == 'blog' or ($page['content']['system_main']['nodes'][arg(1)]['#node']->type and $page['content']['system_main']['nodes'][arg(1)]['#node']->type != 'question')) { ?>
                <div class="con-b">
                  <h1 class="title"><?php print $title; ?></h1>
                  <?php if ($action_links) {print '<ul class="action-page-links">'.render($action_links).'</ul>';}?>
                  <?php if (arg(0) == 'blog') { ?><hr /><?php } ?>
                  <?php if (!empty($help)): print $help; endif; ?>
                  <?php print render($page['content']); ?>
                </div>
              <?php } elseif (arg(0) == 'user' and is_numeric(arg(1)) and !arg(2)) { ?>
                <div class="con-p">
                  <?php if ($action_links) {print '<ul class="action-page-links">'.render($action_links).'</ul>';}?>
                  <?php if (!empty($help)): print $help; endif; ?>
                  <?php print render($page['content']); ?>
                </div>
              <?php } else { ?>
                <?php if (
                  isset($title) and $title and (
                  arg(0) != 'questions' and
                  arg(0) != 'tags' and
                  arg(0) != 'users' and
                  $page['content']['system_main']['nodes'][arg(1)]['#node']->type != 'question'
                  )
                ) { print '<h1 class="title">'.$title.'</h1>'; } ?>
                <?php if ($action_links) {print '<ul class="action-page-links">'.render($action_links).'</ul>';}?>
					      <?php if (!empty($help)): print $help; endif; ?>
                <?php print str_replace('<div class="vertical-tabs-panes">', '<div class="clr"></div><div class="vertical-tabs-panes">', render($page['content'])); ?>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="right">
          <div class="blk">
            <div class="text-block-1"><?php print t('We have already answers to'); ?></div>
            <div class="text-block-2"><?php print $qcount.' '.t('questions'); ?></div>
            <div class="link-block-1"><a href="<?php print url('node/add/question') ?>"><?php print t('Ask a Question'); ?></a></div>
          </div>
        <?php print render($page['sidebar_right_tabs']); print questionsanswers_tabs_out(FALSE, FALSE, FALSE, TRUE); ?>
        <?php print render($page['sidebar_right']); ?>
      </div>
    </div>
    <div class="footer">
      <div class="inn">
        <div class="left">
          <?php print render($page['footer_left']); ?>
        </div>
        <div class="center">
          <?php print render($page['footer_middle']); ?>
        </div>
        <div class="right">
          <?php print render($page['footer_right']); ?>
          <div class="copy"><?php print render($page['footer_message']); ?></div>
        </div>      
      </div>
    </div>