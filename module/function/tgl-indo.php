<?php  
    function tanggalIndo($waktu, $format) { //{tanggalIndoTiga tgl=0000-00-00 00:00:00 format="l, d/m/Y H:i:s"}
        if($waktu == "0000-00-00" || !$waktu || $waktu == "0000-00-00 00:00:00") {
            $rep = "";
        } else {
            if(preg_match('/-/', $waktu)) {
                $tahun = substr($waktu,0,4);
                $bulan = substr($waktu,5,2);
                $tanggal = substr($waktu,8,2);
            } else {
                $tahun = substr($waktu,0,4);
                $bulan = substr($waktu,4,2);
                $tanggal = substr($waktu,6,2);
            }

            $jam = substr($waktu,11,2);
            $menit= substr($waktu,14,2);
            $detik = substr($waktu,17,2);
            $hari_en = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
            $hari_id = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
            $bulan_en = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $bulan_id = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            $ret = @date($format, @mktime($jam, $menit, $detik, $bulan, $tanggal, $tahun));

            $replace_hari = str_replace($hari_en, $hari_id, $ret);
            $rep = str_replace($bulan_en, $bulan_id, $replace_hari);
            $rep = nl2br($rep);
        }
        return $rep;
    }
?>