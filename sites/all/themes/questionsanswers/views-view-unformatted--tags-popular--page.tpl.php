<table class="tags_content_table"><tr>
<?php 
$j = 0;	
foreach ($rows as $row) { if ($row) { ?>
<?php if ($j == 4) { ?></tr><tr><?php $j = 0; } ?>
<td><?php print $row; ?></td>
<?php $j++; } } ?>
<?php for ($i = 1; $i <= (4 - $j); $i++) { ?><td></td><?php } ?>
</tr></table>