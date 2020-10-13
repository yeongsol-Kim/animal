<?php for ($i = 1; $i <= 12; $i++): ?>
<label for="ch<?=$i?>"><?=$i?>월</label>
<input id="ch<?=$i?>" class="ch" type="checkbox" value="<?=2**($i-1)?>"><br>
<?php endfor; ?>

<h1 id="num"></h1>