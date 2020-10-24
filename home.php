<?php 
   if($_SESSION['login'] != true){
      header('Location: login.php');
   }
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
   <h1 class="h2">Dashboard</h1>
</div>

<div class="alert alert-primary text-center" role="alert">
   <h1 class="alert-heading text-center">Selamat Datang</h1>
   <h6 class="mt-3">Selamat datang di Aplikasi Gudang Toko Buku Gramedia. <br> Aplikasi berbasis website ini merupakan Tugas Akhir dari Mata Kuliah Pemrograman Web 2.</h6>
   <hr>
   <p class="mb-0 text-center">Tegar Pratama-171011400809-06TPLP008</p>
   <small>2020</small>
</div>