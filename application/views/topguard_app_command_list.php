<div><h>어플리케이션이 보낸 명령어입니다.</h>
<ul>
<?php
foreach($commands as $entry){
?>
    <li><?=$entry->userid?>, <?=$entry->id?>, <?=$entry->name?></li>
<?php
}
?>
</ul>
</div>
