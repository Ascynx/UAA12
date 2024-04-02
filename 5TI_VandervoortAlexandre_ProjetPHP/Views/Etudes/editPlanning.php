<?php
    $datemin = date_create();
    $datemax = date_create()->add(DateInterval::createFromDateString("1 year"));

    $datemin_str = $datemin->format("Y-m-d");
    $datemax_str = $datemax->format("Y-m-d");
?>

<link rel="stylesheet" href="Assets/css/newEntries.css">
<div class="flex column center-items center-content">
    <div class="flex column center-items">
        <form action="/editPlanning?planning=<?=$components["planning"]?>" method="post" class="flex column center-items center-content">
        <div>    
            <label for="date">Date</label>
            <input type="date" name="date" id="date" min="<?=$datemin_str?>" max="<?=$datemax_str?>" required <?=isset($_POST["date"]) ? 'value="' . $_POST["date"] . '"' : ''?>/>
        </div>

        <div>
            <label for="debut">Heure de début</label>
            <input type="time" name="debut" id="debut" min="8:25" max="16:15" placeholder="8:25" required <?=isset($_POST["debut"]) ? 'value="' . $_POST["debut"] . '"' : ''?>/>
            <span id="valid"></span>    
        </div>
            
        <div>
            <label for="duree">Nombre d'heures (périodes de 50m)</label>
            <input type="number" name="duree" id="duree" min="1" max="8" required <?=isset($_POST["duree"]) ? 'value="' . $_POST["duree"] . '"' : ''?>/>
        </div>

        <input type="submit" value="envoyer">
        </form>
    </div>
</div>