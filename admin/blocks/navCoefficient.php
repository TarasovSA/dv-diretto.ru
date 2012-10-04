<ul class="nav nav-list">
    <li class="nav-header">Калькуляторы</li>
    <li <?=($GLOBALS['calc']=='villaggio'?'class="active"':'')?>><a href="/admin/index.php?p=coefficient&calc=villaggio">Villaggio</a></li>
    <li <?=($GLOBALS['calc']=='feliceCitta'?'class="active"':'')?>><a href="/admin/index.php?p=coefficient&calc=feliceCitta">Felice Citta</a></li>
    <li <?=($GLOBALS['calc']=='bellaVita'?'class="active"':'')?>><a href="/admin/index.php?p=coefficient&calc=bellaVita">Bella Vita</a></li>
    <li <?=($GLOBALS['calc']=='bellissimo'?'class="active"':'')?>><a href="/admin/index.php?p=coefficient&calc=bellissimo">Bellissimo</a></li>
    <li class="nav-header">Списки</li>
    <li><a href="/admin/index.php?p=coefficient&list=auto">Автомобили</a></li>
</ul>