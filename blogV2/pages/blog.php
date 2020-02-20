<?php
    require_once("classes/Db.php");
    Db::pripoj("127.0.0.1","root","","blogv2");

    if(isset($_GET["clanek"]))
    {
        $vysledky =  Db::query(' SELECT `id`, `nadpis`, `text` FROM `clanky` WHERE `id`=? ',array($_GET["clanek"]))->fetchAll();
        echo('<div class="articles">');
        foreach ($vysledky as $v) {
            echo('<a>'.$v["nadpis"]."</a><br><p>".$v["text"]."</p><br>");
        }
        echo('<form method="post" action="index.php?s=blog">
                <input class="button" type="submit" value="back">
            </form><br>
            </div>');
    }
    else
    {
        $vysledky =  Db::query(' SELECT `id`, `nadpis`, `text` FROM `clanky` ')->fetchAll();
        echo('<div class="articles">');
        foreach ($vysledky as $v) {
            echo('<a class="article-header" href=index.php?s=blog&clanek='.$v["id"].'>'.$v["nadpis"]."</a><br><p>".$v["text"]."<p><br>");
        }
        echo('</div>');
    }

?>