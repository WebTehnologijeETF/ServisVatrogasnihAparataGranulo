<?php
$fajl = scandir("C:/wamp/www/servis/Skripte/novosti");
$novosti = array();
$datumi = array();
for ($i=2; $i<count($fajl); $i++) {
    $ucitaj = file("C:/wamp/www/servis/Skripte/novosti/".$fajl[$i]);
    array_push($novosti, $fajl[$i]);
    array_push($datumi, $ucitaj[0]);
}
//Sortiranje
    for ($i=0; $i<count($novosti) - 1; $i++) {
	try{
        if (DateTime::createFromFormat('DD.MM.YY hh:mm:ss', $datumi[$i]) < DateTime::createFromFormat('DD.MM.YY hh:mm:ss', $datumi[$i + 1])) {
            $v = $datumi[$i+1];
            $datumi[$i+1] = $datumi[$i];
            $datumi[$i] = $v;
            $v = $novosti[$i+1];
            $novosti[$i+1] = $novosti[$i];
            $novosti[$i] = $v;
            
        }
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
    }

for ($i=0; $i<count($novosti); $i++){
  $sadrzaj = file("C:/wamp/www/servis/Skripte/novosti/".$novosti[$i]);
    $opis = "";
    $detaljnije = "";
    $imaDetaljnije = false;
    for ($j=4; $j<count($sadrzaj);$j++) {
        if($sadrzaj[$j] == "--\r\n") {
            $imaDetaljnije = true;
            continue;
        }
        if ($imaDetaljnije == false) {
            $opis .= " ".$sadrzaj[$j];
        }
        else {
            $detaljnije .= " ".$sadrzaj[$j];
        }
    } 
	$news_item["datetime"] = $sadrzaj[0];
	$news_item["autor"] = $sadrzaj[1];
	$news_item["naslov"] = ucfirst(strtolower($sadrzaj[2]));
	$news_item["slika"] = $sadrzaj[3];
	$news_item["opis"] = $opis;
	$news_item["detaljnije"] = $detaljnije;
	
	echo '<article class="newsContainer">';
	echo '<img src="' . $sadrzaj[3] . '" class="news_image" alt=" ">';
	echo '<h1 class="news_header">' . ucfirst(strtolower($sadrzaj[2])) . '</h1>';
	echo '<p class="news_item">' . $opis . '</p>';
	if($imaDetaljnije) echo "<a onclick='loadSingleNewsItem(" . json_encode($news_item) . ")' class='detaljnijeLink'>Detaljnije...</a>";
	echo '</article>';
}

	?>