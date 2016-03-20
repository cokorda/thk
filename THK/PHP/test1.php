<html>
  <body>

  <?php
  include_once('semsol/ARC2.php'); /* ARC2 static class inclusion */


  $dbpconfig = array(
  "remote_store_endpoint" => "http://dpch.oss.web.id:3030/thk/query",
   );

  $store = ARC2::getRemoteStore($dbpconfig);

  if ($errs = $store->getErrors()) {
     echo "<h1>getRemoteSotre error<h1>" ;
  }

  $query = '
prefix owl: <http://www.w3.org/2002/07/owl#>
prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#>
prefix thk: <http://dpch.oss.web.id/Bali/TriHitaKarana.owl#>

SELECT DISTINCT ?class ?label ?description
WHERE {
  ?class a owl:Class.
  OPTIONAL { ?class rdfs:label ?label}
  OPTIONAL { ?class rdfs:comment ?description}
}
';


  $rows = $store->query($query, 'rows'); /* execute the query */

  if ($errs = $store->getErrors()) {
     echo "Query errors" ;
     print_r($errs);
  }

  /* display the results in an HTML table */
  echo "<table border='1'>" ;
  foreach( $rows as $row ) { /* loop for each returned row */
         print "<tr><td>" .$row['class'] . "</td><td>" . $row['label'] . "</td><td>" . $row['description']."</td></tr>";
  }
  echo "</table>"

  ?>
  </body>
</html>