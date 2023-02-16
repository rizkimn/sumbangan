<?php

$data  = [];
$total = 0;

function getAll() {
  return $data = json_decode(file_get_contents('data.json'), true);
}

$data = getAll();

foreach($data as $d) {
  $total += $d["Sumbangan"];
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

$total = rupiah($total);

if(isset($_POST['q'])) {
  $query = [];
  foreach($data as $k => $i) {
    if($_POST['q'] == $k || strtolower($_POST['q']) == strtolower($i["Nama"])) {
      $query[$k] = $i;
    }
  }
  $data = $query;
}

if(isset($_POST['getall'])) {
  $data = getAll();
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <title>Terima Kasih Calon Penghuni Surga :)</title>
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      color: #6702e3;
    }

    body {
      font-family: 'Poppins', Arial, sans-serif;
      background-image: linear-gradient(to right bottom, #246dea, #c753ca, #ff488d, #ff714c, #eba512);
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      min-height: 100vh;
    }

    .container {
      width: 80%;
      margin: 50px auto;
    }

    .search-btn input,
    .search-btn button {
      background: linear-gradient(to right bottom, #fff6, #fff2);
      border: none;
      padding: 12px 16px;
      outline: none;
      font-size: 20px;
      color: #fff;
      border-radius: 6px;
    }

    .search-btn button i {
      color: #fff;
    }

    .search-btn input::placeholder {
      color: #fff;
      opacity: 0.3;
    }

    .custom-table-wrapper {
      background-image: linear-gradient(to right bottom, #fff6, #fff2);
      padding: 30px 50px;
      margin-top: 20px;
      backdrop-filter: blur(30px);
      border-radius: 8px;
    }

    h3 {
      text-align: center;
      margin-bottom: 20px
    }

    .custom-table {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 15px;
    }

    ul.list-items {
      list-style: none;
      display: flex;
      align-items: center;
      transform-origin: center;
      transition: .3s;
    }

    ul.list-items:hover {
      transform: scale(1.2);
    }

    ul.list-items:hover li.list-item {
      background-color: #fff;
    }

    li.list-item {
      background-color: #fff3;
      padding: 10px 16px;
      border-radius: 4px;
      height: 100%;
      display: flex;
      align-items: center;
    }

    li.no {
      font-family: 'Fira Code', Courier, monospace;
      font-weight: 500;
    }

    li.name {
      margin-left: 5px;
      width: 100%;
    }

    @media screen and (max-width: 780px) {
      .container {
        width: 90%;
      }
      .search-btn form {
        width: 100%;
        display: grid;
        grid-template-columns: 70% 15% 15%;
        gap: 5px;
      }
      .search-btn input {
        box-shadow: #fff5 0 0 4px inset;
        padding: 12px;
        font-size: 14px;
      }
      .search-btn button {
        padding: 5px;
      }
      .custom-table-wrapper {
        padding: 20px;
        font-size: 12px;
      }
      .custom-table {
        grid-template-columns: repeat(1, 1fr);
        gap: 5px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="search-btn">
      <form method="POST">
        <input type="text" name="q" id="q" placeholder="Cari Nama atau Nomor Urut">
        <button type="submit"><i class="bx bx-search"></i></button>
        <button type="submit" name="getall"><i class="bx bx-refresh"></i></button>
      </form>
    </div>
    <div class="custom-table-wrapper">
      <h3>Nama-Nama Donatur</h3>
      <h4>Total Donasi Terkumpul : <?= $total ?></h4>
      <br>
      <div class="custom-table">
        <?php foreach($data as $n => $i): ?>
        <ul class="list-items">
          <li class="list-item no"><?= $n ?></li>
          <li class="list-item name"><?= $i["Nama"] ?></li>
        </ul>
        <?php endforeach; ?>
      </div>
    </div>
    <p style="font-size: 10px; margin-top: 10px; color: white; opacity: .3;">Copyright &copy; 2023 | Hamba Allah</p>
  </div>
</body>
</html>