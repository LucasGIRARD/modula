<?php

$donneesSQL = select($connection,"SELECT bhl.BLOCK_id as id, b.name, bhl.posY, bhl.posY, m.name as moduleName FROM block_has_layout AS bhl LEFT JOIN block AS b ON bhl.LAYOUT_id = b.id LEFT JOIN module AS m ON b.MODULE_id = m.id WHERE b.enable=1 ORDER BY posY, posX ");
foreach ($donneesSQL as $value) {
   $brick[$value['id']]['name'] = $value['name'];
   $brick[$value['id']]['module'] = $value['moduleName'];
}

?>