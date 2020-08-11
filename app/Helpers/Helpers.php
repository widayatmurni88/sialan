function all_bulan_indo(){
  const bulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember];
  return bulan;
}

function get_bulan_indo($index){
  return $this->all_bulan_indo[$index];
}

function all_hari_indo(){
  const hari = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
  return hari;
}

function get_hari_indo($index){
  return $this->all_hari_indo[$index];
}