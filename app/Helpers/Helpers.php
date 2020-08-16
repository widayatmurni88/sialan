<?php

/*
  untuk bikin helper => kemudian tambahkan di file composer.json
    "autoload": {
      "psr-4": {
        ...
      },
      "classmap": [
        ...
      ],
      "files": [
        "app/Helpers/Helpers.php"
      ]
    }

  run composer dump-autoload
*/

const jammasuk        = '010000';
const jampulang       = '091400';
const jammasukjumat   = '080000';
const jampulangjumat  = '160000';


const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu'];
const day  = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

function all_bulan_indo(){
  return bulan;
}

function get_bulan_indo($index){
  return bulan[$index]; 
}

function all_bulan_indo_3dig(){
  for ($i=0; $i < count(bulan); $i++) { 
    $bln[] = substr(bulan[$i], 0, 3);
  }
  return $bln;
}

function all_hari_indo(){
  return hari;
}

function get_hari_indo($index){
  return hari[$index];
}

function all_hari_indo_3dig(){
  for ($i=0; $i < count(hari); $i++) { 
    $hr[] = substr(hari[$i], 0, 3);
  }
  return $hr;
}

function get_hari_from_day($day){
  return get_hari_indo(array_search($day, array_values(day)));
}