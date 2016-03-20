<?php
    $kabupaten = $_POST['kabupaten']; // required

    $kecamatan = $_POST['kecamatan']; // required
 
    $desa = $_POST['desa']; // required
 
    $banjar = $_POST['banjar']; // not required
 
include_once('semsol/ARC2.php'); /* ARC2 static class inclusion */


  $dbpconfig = array(
  "remote_store_endpoint" => "http://dpch.oss.web.id:3030/thk/update",
   );

  $store = ARC2::getRemoteStore($dbpconfig);

  if ($errs = $store->getErrors()) {
     echo "<h1>getRemoteSotre error<h1>" ;
  }

  $query = '
prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
prefix owl: <http://www.w3.org/2002/07/owl#>
prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
prefix thk: <http://dpch.oss.web.id/Bali/TriHitaKarana.owl#>

INSERT DATA
{
thk:$kecamatan a thk:Kecamatan;
thk:isPartOf thk:$kabupaten
thk:$desa a thk:Desa;
thk:isPartOf thk:$kecamatan.
thk:$banjar a thk:Banjar;
    thk:isPartOf thk:$desa.
}
';

?>