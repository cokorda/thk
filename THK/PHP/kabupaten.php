<?php
    /**
     * 
     * 
     *    
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */

    set_include_path(get_include_path() . PATH_SEPARATOR . '../easyrdf/lib/');
    require_once "EasyRdf.php";
    require_once "../easyrdf/examples/html_tag_helpers.php";

    // Setup some additional prefixes
    EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
    EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
	EasyRdf_Namespace::set('thk', 'http://dpch.oss.web.id/Bali/TriHitaKarana.owl#');

    $sparql = new EasyRdf_Sparql_Client('http://localhost:3030/thk/query');
?>
<html>
<head>
  <title>List of Villages</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>List of space in Bali</h1>

<h2>Lists of villages in Bali</h2>
<ul>
<?php
    $result = $sparql->query(
        'SELECT * WHERE {'.
        '  ?Kabupaten rdf:type thk:Kabupaten .'.
        '} ORDER BY ?Kabupaten'
    );
    foreach ($result as $row) {
                $kabupaten_name = explode("#",$row->Kabupaten);
                $kabupaten_name_view = $kabupaten_name[1];
                $kabupaten_name_view = preg_replace('/(?<!\ )[A-Z]/', ' $0', $kabupaten_name_view);
        echo "<li> <a href=".($row->Kabupaten)."> ".$kabupaten_name_view."</a></li>\n";
    }
?>
</ul>
<p>Total number of Villages: <?= $result->numRows() ?></p>

</body>
</html>