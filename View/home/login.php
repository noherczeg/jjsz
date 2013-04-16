<h3><?= $title ?></h3>
<h5>Az aktuális idő: <?= $ido ?></h5>
<form method="POST" action="">
    <label>név:</label><input type="text" size="20" name="name" /><br>
    <label>jelszó:</label><input type="password" size="20" name="password" /><br>
    <input type="submit" name="submit" value="Küldés">
</form>