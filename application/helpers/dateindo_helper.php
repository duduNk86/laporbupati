<?php

function longdate_indo($tgl){
   $ubah    = gmdate($tgl, time()+60*60*8);
   $pecah   = explode("-",$ubah);
   $tanggal = $pecah[2];
   $bulan   = long_bulan($pecah[1]);
   $tahun   = $pecah[0];
   //return $bulan . ' ' . $tanggal . ', ' . $tahun;
   //return $tanggal.'-'.$bulan.'-'.$tahun;
   return $tanggal.' '.$bulan.' '.$tahun;
}

function mediumdate_indo($tgl){
   $ubah    = gmdate($tgl, time()+60*60*8);
   $pecah   = explode("-",$ubah);
   $tanggal = $pecah[2];
   $bulan   = medium_bulan($pecah[1]);
   $tahun   = $pecah[0];
   //return $bulan . ' ' . $tanggal . ', ' . $tahun;
   //return $tanggal.'-'.$bulan.'-'.$tahun;
   return $tanggal.' '.$bulan.' '.$tahun;
}

function shortdate_indo($tgl){
   $ubah    = gmdate($tgl, time()+60*60*8);
   $pecah   = explode("-",$ubah);
   $tanggal = $pecah[2];
   $bulan   = short_bulan($pecah[1]);
   $tahun   = $pecah[0];
   //return $bulan . ' ' . $tanggal . ', ' . $tahun;
   //return $tanggal.'-'.$bulan.'-'.$tahun;
   return $tanggal.'-'.$bulan.'-'.$tahun;
}

function long_bulan($bln){
   switch ($bln)
   {
      case 1:
         return "Januari";
         break;
      case 2:
         return "Februari";
         break;
      case 3:
         return "Maret";
         break;
      case 4:
         return "April";
         break;
      case 5:
         return "Mei";
         break;
      case 6:
         return "Juni";
         break;
      case 7:
         return "Juli";
         break;
      case 8:
         return "Agustus";
         break;
      case 9:
         return "September";
         break;
      case 10:
         return "Oktober";
         break;
      case 11:
         return "November";
         break;
      case 12:
         return "Desember";
         break;
   }
}

function medium_bulan($bln){
   switch ($bln)
   {
      case 1:
         return "Jan";
         break;
      case 2:
         return "Feb";
         break;
      case 3:
         return "Mar";
         break;
      case 4:
         return "Apr";
         break;
      case 5:
         return "Mei";
         break;
      case 6:
         return "Jun";
         break;
      case 7:
         return "Jul";
         break;
      case 8:
         return "Agu";
         break;
      case 9:
         return "Sep";
         break;
      case 10:
         return "Okt";
         break;
      case 11:
         return "Nov";
         break;
      case 12:
         return "Des";
         break;
   }
}

function short_bulan($bln){
   switch ($bln)
   {
      case 1:
         return "01";
         break;
      case 2:
         return "02";
         break;
      case 3:
         return "03";
         break;
      case 4:
         return "04";
         break;
      case 5:
         return "05";
         break;
      case 6:
         return "06";
         break;
      case 7:
         return "07";
         break;
      case 8:
         return "08";
         break;
      case 9:
         return "09";
         break;
      case 10:
         return "10";
         break;
      case 11:
         return "11";
         break;
      case 12:
         return "12";
         break;
   }
}