<?php if (questionsanswers_tags_filter($fields['tid']->content)) { print '<a href="'.url('taxonomy/term/'.$fields['tid']->content).'">'.$fields['name']->content.' <sup>'.questionsanswers_get_term_node_count($fields['tid']->content).'</sup></a>'; } ?>