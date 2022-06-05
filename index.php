<?php
    require 'vendor/autoload.php';
    \EasyRdf\RdfNamespace::set('ab', 'http://learningsparql.com/ns/name#');
    \EasyRdf\RdfNamespace::set('d', 'http://learningsparql.com/ns/data#');
    
    $jena_endpoint ='http://localhost:3030/data2';
    $sparql_jena = new \EasyRdf\Sparql\Client($jena_endpoint);
  $search = "";
  if (isset($_POST['search-doctor'])) {
    $search = $_POST['search-doctor'];
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

      FILTER (regex (?namaDokter,  '$search', 'i') || regex (?dokterSpesialis,  '$search', 'i') || regex (?umur,  '$search', 'i') || regex (?pengalamanKerja,  '$search', 'i') || regex (?jadwalPraktek,  '$search', 'i') || regex (?jamPraktek,  '$search', 'i') || regex (?lantaiPraktek,  '$search', 'i'))
      }
      ORDER BY ?dokterSpesialis ?namaDokter
      ";
      $result = $sparql_jena->query($data);
  } 
  else {
    $result = [];
  }

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
  <body>
    <div class="s130">
      <form action="" method="post" id=nameform>
        <div class="inner-form">
          <div class="input-field first-wrap">
            <div class="svg-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
              </svg>
            </div>
            <input type="text" name="search-doctor" placeholder="Temukan dokter Anda disini..." />
          </div>
          <div class="input-field second-wrap">
            <button class="btn-search" type="submit">Cari</button>
          </div>
        </div>
      </form>
    </div>

    <!-- About -->
    <section class="about">
      <div class="container">
        <div class="row about">
        <div class="col-lg-6">
          <img src="img/jkfull.png" alt="about" class="img-fluid" style="padding-top:70px"/>
        </div>
        <div class="col-lg">
          <h3>RS Jasa Kartini</h3>
          <p>
          Rumah Sakit Jasa Kartini merupakan salah satu lembaga pelayanan jasa kesehatan di Kota Tasikmalaya yang berlokasi di Jalan Otto Iskandardinata No 15 Tasikmalaya. Awal diprakarsainya Rumah Sakit Jasa Kartini bermula dengan didirikannya Yayasan Karsa Abdi Husada pada tahun 1996 yang mulai melakukan persiapan dan pembangunan Rumah Sakit Jasa Kartini.
          Pada tanggal 9 Maret 1997 Rumah Sakit Jasa Kartini secara resmi mulai memberikan pelayanannya kepada masyarakat, sejak saat itu jumlah tempat tidur rawat inap Rumah Sakit terus bertambah dari waktu ke waktu seiring dengan peningkatan animo masyarakat terhadap pelayanan kesehatan Rumah Sakit Jasa Kartini.
          </p>
        </div>
      </div>

      
      <!-- Doctor Spesialis -->
      <div class="card-container mt-3">
        <h3>Spesialis Kami</h3>
        <div class="row">
          <div class="card" style="width: 250px;">
              <img src="img/dokter-anak.png" class="card-img-top" alt="bedah">
              <div class="card-body text-center">
                  <h5 class="card-title">Anak dan Tumbuh Kembang Anak</h5>
                  <a href="anak.php" class="btn btn-primary">Details</a>
              </div>
          </div>
          <div class="card" style="width: 250px;">
              <img src="img/bedah.png" class="card-img-top" alt="Sample Image">
              <div class="card-body text-center">
                  <h5 class="card-title">Bedah</h5>
                  <a href="bedah.php" class="btn btn-primary">Details</a>
              </div>
          </div>
          <div class="card" style="width: 250px;">
              <img src="img/dokter-jantung.png" class="card-img-top" alt="Sample Image">
              <div class="card-body text-center">
                  <h5 class="card-title">Jantung</h5>
                  <a href="jantung.php" class="btn btn-primary">Details</a>
              </div>
          </div>
          <div class="card" style="width: 250px;">
              <img src="img/dokter-kandungan.png" class="card-img-top" alt="Sample Image">
              <div class="card-body text-center">
                  <h5 class="card-title">Kandungan dan Kebidanan</h5>
                  <a href="kandungan.php" class="btn btn-primary">Details</a>
              </div>
          </div>
          
        <div class="row">
          <div class="card" style="width: 250px;">
              <img src="img/dokter-kulit.png" class="card-img-top" alt="Sample Image">
              <div class="card-body text-center">
                  <h5 class="card-title">Kulit dan Kelamin</h5>
                  <a href="kulit.php" class="btn btn-primary">Details</a>
              </div>
          </div>
          <div class="card" style="width: 250px;">
              <img src="img/gigi.png" class="card-img-top" alt="Sample Image">
              <div class="card-body text-center">
                  <h5 class="card-title">Gigi dan Konservasi Gigi</h5>
                  <a href="gigi.php" class="btn btn-primary">Details</a>
              </div>
          </div>
          <div class="card" style="width: 250px;">
              <img src="img/dokter-penyakit-dalam.png" class="card-img-top" alt="Sample Image">
              <div class="card-body text-center">
                  <h5 class="card-title">Penyakit Dalam</h5>
                  <a href="penyakit_dalam.php" class="btn btn-primary">Details</a>
              </div>
          </div><div class="card" style="width: 250px;">
              <img src="img/dokter-telinga-hidung-tenggorokan-tht.png" class="card-img-top" alt="Sample Image">
              <div class="card-body text-center">
                  <h5 class="card-title">THT</h5>
                  <a href="tht.php" class="btn btn-primary">Details</a>
              </div>
          </div>
          <a href="daftar_dokter.php" class="btn btn-info" style="background-color: #B8DCE4; margin-top: 30px">Daftar Dokter</a>
      </div>
      
      <!-- Hasil Pencarian -->

      <div class="row text-center mb-3 hasil">
        <div class="col">
          <h2 style="margin-top: 80px">Hasil Pencarian</h2>
        </div>
      </div>
      <div class="row fs-5">
        <div class="col-md-5">
          <p>
            <span>
        <?php
        if ($search != NULL) {
          echo $search;
        } else {
          echo "Dokter yang dicari :";
        }
        ?></span>
          </p>
        </div>
      </div>

  <div class="cari">
    <table class="table" style="margin-bottom: 50px ;">
      <tr>
      <th>No</th>
      <th>Nama Dokter</th>
      <th>Spesialis</th>
      <th>Umur</th>
      <th>Jadwal Praktek</th>
      </tr>
      <?php
        $count = 0;
        foreach ($result as $data):
      ?>
      <tr>
      <td><?= $count += 1 ?></td>
      <td><?= $data->namaDokter ?></td>
      <td><?= $data->dokterSpesialis?></td>
      <td><?= $data->umur?></td>
      <td><a href="detail.php?q=<?= $data->namaDokter?>">Detail</a></td>
      </tr>
      <?php endforeach; ?>  
    </table>
  </div>

<footer class="bg-light text-center text-lg-start">
  <div class="text-center p-3" style="background-color: #B8DCE4;">
   © 2022 Copyright: Syakira Rahma Fauziyah - 140810190013
 </div>
</footer>
</body>
</html>
