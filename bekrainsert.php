<?php
class veriler{
	
public  function veri_ekle($hackerip,$attackquery,$attackthetime,$Attackedpage)
    {
      include_once 'baglanti.php';
            $sorgu=$db->prepare("insert into hackerip values (?,?,?,?)");

            $sorgu->bind_param("sssss",$hackerip,$attackquery,$attackthetime,$Attackedpage);

            $sorgu->execute();

            echo '$sorgu';
    } 
    }
?>
