<?php

addToPosts()

function addToPosts($title, $img, $date, $details){
		$sql = "INSERT INTO data(ImgDate,Title,Img,Details) SELECT $date, $title, $img, $details";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
    }
    
?>