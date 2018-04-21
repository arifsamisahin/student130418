<?php

  require_once '../core/init.php';

  global $connect;

  $t_id = 6;
  $s_id = 16;

  $sql1 = "SELECT *, COUNT(*) as almasi_gereken , SUM(r.rC_status) as katildigi, SUM(r.recover) as telafi FROM rollCall r, lesson l, teacher t, student s WHERE s.id=r.student_id AND r.added_id='$t_id' AND r.student_id='$s_id' AND r.lesson_id=l.lesson_id AND t.id='$t_id' GROUP BY lesson_name";

  $result1 = mysqli_query($connect, $sql1);

    $toplam_katildigi = 0;
    $toplam_telafi = 0;
    $toplam_almasi_gereken = 0;
    $toplam_sonuc_aldigi = 0;


    while ($row1 = mysqli_fetch_array($result1)) {

        $sonuc_aldigi = $row1['telafi']+$row1['katildigi'];
        $katilim_orani = round($sonuc_aldigi/($row1['almasi_gereken'])*100);

        $toplam_katildigi += $row1['katildigi'];
        $toplam_telafi += $row1['telafi'];
        $toplam_almasi_gereken += $row1['almasi_gereken'];
        $toplam_sonuc_aldigi += $sonuc_aldigi;

        echo "Id=>" . $row1['id'] . " --- User=>" . $row1['u_id'] . " --- Student=>" . $row1['student_id'] .  " --- Name=>" . $row1['s_name'] . " --- KATILDIGI=> " . $row1['katildigi'] . " --- TELAFI=> " . $row1['telafi'] . " --- ALMASI GEREKEN=> " . $row1['almasi_gereken'] . " --- TOPLAM ALDIGI=> " . $sonuc_aldigi . " --- KATILIM ORANI=> %" . $katilim_orani . " ---Lesson=>" . $row1['lesson_name'] . "<br>";


    }

    echo "Toplam katildigi=> " . $toplam_katildigi . "<br>";
    echo "Toplam telafi=> " . $toplam_telafi . "<br>";
    echo "Toplam almasi gereken=> " . $toplam_almasi_gereken . "<br>";
    echo "Toplam Sonuc Olarak aldigi=> " . $toplam_sonuc_aldigi . "<br>";
    echo "Toplam Katilim Orani=> %" . round($toplam_sonuc_aldigi/$toplam_almasi_gereken*100) . "<br>";

    ?>
