<?php 
   if($_SESSION['login'] != true){
      header('Location: login.php');
   }

   $crud     = new Crud();
   $kodeBK   = $crud->getLastkodeBK();
   $book     = $crud->getBook();

   if(isset($_POST['submit'])) {
      if($crud->insertBK() == true){
         Flasher::setFlash('Data Barang Keluar Berhasil Ditambahkan!', 'success');
         header('Location: index.php?page=barangkeluar');
      }else{
         Flasher::setFlash('Data Barang Keluar Gagal Dihapus!', 'danger');
         header('Location: index.php?page=barangkeluar');
      }
   }
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
   <h1 class="h2">Tambah Barang Keluar</h1>
</div>

<?php Flasher::flash(); unset($_SESSION['flash']);  ?> 

<form action="" method="post">
   <div class="form-group">
      <label for="kode_bm">Kode Barang Keluar</label>
      <input type="text" class="form-control" name="kode_bk" readonly value="<?= $kodeBK ?>">
   </div>

   <div class="form-group">
      <label for="kode_buku">Kode Buku</label>
      <select class="form-control" name="kode_buku">
      <option>Pilih Kode Buku</option>
      <?php foreach($book as $b) : ?>
         <option value="<?= $b['id'] ?>"><?= $b['kode_buku'] . ' | ' . $b['judul']  ?></option>
      <?php endforeach ?>
      </select>
  </div>

   <div class="form-group">
      <label for="kode_bm">Jumlah Barang Keluar</label>
      <input type="number" class="form-control" name="jumlah_bk">
   </div>

   <div class="form-group">
      <label for="kode_bm">Tanggal</label>
      <input type="date" class="form-control" name="tanggal_bk">
   </div>

   <div class="row">
      <div class="col">
         <a href="index.php?page=barangkeluar" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-circle-left mr-2"></i>Kembali</a>
         <button type="submit" name="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save mr-2"></i>Simpan</button>
      </div>
   </div>

</form>

