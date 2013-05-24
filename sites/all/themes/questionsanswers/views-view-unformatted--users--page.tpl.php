<table class="users_content_table"><tr>
<?php 
$j = 0;	
foreach ($rows as $row) { ?>
<?php if ($j == 3) { ?></tr><tr><?php $j = 0; } ?>
<td><?php print $row; ?></td>
<?php $j++; } ?>
<?php for ($i = 1; $i <= (3 - $j); $i++) { ?><td></td><?php } ?>
</tr></table>