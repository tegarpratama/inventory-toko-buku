<?php 
   if($_SESSION['login'] != true){
      header('Location: login.php');
   }

   $crud = new Crud();
   $result = $crud->getDetail();
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
   <h1 class="h2">Detail Buku</h1>
</div>

<table class="table table-bordered table-hover">
   <tr>
      <th>Kode Buku</th>
      <td><?= $result['kode_buku'] ?></td>
   </tr>
   <tr>
      <th style="width:  17%">Judul Buku</th>
      <td><?= $result['judul'] ?></td>
   </tr>
   <tr>
      <th>Pengarang</th>
      <td><?= $result['pengarang'] ?></td>
   </tr>
   <tr>
      <th>Penerbit</th>
      <td><?= $result['penerbit'] ?></td>
   </tr>
   <tr>
      <th>Tebal Buku</th>
      <td><?= $result['tebal_halaman'] ?></td>
   </tr>
   <tr>
      <th>Cetakan</th>
      <td><?= $result['cetakan'] ?></td>
   </tr>
   <tr>
      <th>Harga Buku</th>
      <td><?= $result['harga'] ?></td>
   </tr>
   <tr>
      <th>Stok</th>
      <td><?= $result['stok'] ?></td>
   </tr>
   <tr>
      <th>Deskripsi</th>
      <td><?= $result['deskripsi'] ?></td>
   </tr>
</table>

<a href="index.php?page=buku" class="btn btn-secondary btn-sm float-right"><i class="fas fa-chevron-circle-left mr-2"></i>Kembali</a>