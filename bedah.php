       <!--PHP-->
<?php
  require 'vendor/autoload.php';
  \EasyRdf\RdfNamespace::set('ab', 'http://learningsparql.com/ns/name#');
  \EasyRdf\RdfNamespace::set('d', 'http://learningsparql.com/ns/data#');
  
  $jena_endpoint ='http://localhost:3030/data2';
  $sparql_jena = new \EasyRdf\Sparql\Client($jena_endpoint);
    $data =
      "
      SELECT ?namaDokter ?dokterSpesialis ?umur ?pengalamanKerja ?jadwalPraktek ?jamPraktek ?lantaiPraktek
      {
      ?dokter ab:name ?namaDokter ;
          ab:spesialis ?spesialis ;
        ab:umur ?umur ;
        ab:pengalaman ?pengalamanKerja ;
        ab:jadwal ?jadwal ;
        ab:jam ?jam ;
        ab:lantai ?lantai .
      ?spesialis ab:spesialisname ?dokterSpesialis .
      ?jadwal ab:jadwalname ?jadwalPraktek .
      ?jam ab:jampraktek ?jamPraktek .
      ?lantai ab:lantaipraktek ?lantaiPraktek .
      FILTER (regex (?dokterSpesialis,  'Bedah', 'i'))
      }
      ORDER BY ?namaDokter
        ";
      $result = $sparql_jena->query($data);
  ?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link href="css/main.css" rel="stylesheet" />
  </head>
  <body style="background-image: url('img/bg.png'); background-size:cover; background-repeat:no-repeat">
  <img src="img/rsjk.png" alt="logo" style="width:15%; margin-left: 10px; margin-top:10px">
  <h1 style="text-align:center">Dokter Spesialis Bedah</h1>
    
  <table class="table table-striped mx-auto w-auto">
                            <tr>
                                <th>No</th>
                                <th>Nama Dokter</th>
                                <th>Spesialis</th>
                                <th>Umur</th>
                                <th>Jadwal Praktek</th>
                                <th>Jam Praktek</th>
                                <th>Lantai Praktek</th>
                            </tr>
                            <?php
                                $count = 0;
                                foreach ($result as $data):
                            ?>
                            <tr>
                                <td><?= $count += 1 ?></td>
                                <td><?= $data->namaDokter ?></td>
                                <td><?= $data->dokterSpesialis?></td>
                                <td><?= $data->umur ?></td>
                                <td><?= $data->jadwalPraktek ?></td>
                                <td><?= $data->jamPraktek ?></td>
                                <td><?= $data->lantaiPraktek ?></td>
                            </tr>
                            <?php endforeach; ?>
  </div>
</html>
