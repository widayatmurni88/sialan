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

const bulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

const hari = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jum`at', 'sabtu'];

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