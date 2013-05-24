<?php 
$out = '';
foreach ($rows as $id => $row) { 
$out .= $row; 
} 
if ($out) {
/*
  $n = db_select('node', 'n');
  $n->condition('type', 'question');
  $n->condition('status', 1);
  $n->condition('uid', arg(1));
  $n->addExpression('COUNT(n.nid)');
  $count = (int)$n->execute()->fetchField();
  */
?>
<?php print $out; ?>
<?php } ?>
