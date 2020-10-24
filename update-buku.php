<?php 
   if($_SESSION['login'] != true){
      header('Location: login.php');
   }

   $crud = new Crud();
   $book = $crud->getDetail();
   $pengarang  = $crud->getPengarang();
   $penerbit   = $crud->getPenerbit();

   if(isset($_POST['submit'])){
      if($crud->updateBook() == true) {
         Flasher::setFlash('Data Buku Berhasil Diupdate!', 'success');
         header('Location:index.php?page=buku');
      }else{
         Flasher::setFlash('Oops, Terjadi Suatu Kesalahan!', 'danger');
      }
   }
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
   <h1 class="h2">Form Ubah Buku</h1>
</div>

<?php Flasher::flash(); ?> 

<form action="" method="post">

   <input type="hidden" name="id" value="<?= $book['id'] ?>">

   <div class="form-row">
      <div class="col">
         <label for="judul">Judul Buku</label>
         <input type="text" class="form-control" name="judul" id="judul" value="<?= $book['judul'] ?>" autocomplete="off">
      </div>
      <div class="col">
         <label for="cetakan">Kode Buku</label>
         <input type="text" class="form-control" name="kode_buku" id="kode_buku"  value="<?= $book['kode_buku'] ?>" autocomplete="off">
      </div>
   </div>

   <div class="form-row mt-4">
      <div class="col">
         <label for="pengarang">Pengarang</label>
         <select class="custom-select" name="pengarang">
            <?php foreach($pengarang as $p) : ?>
               <option value="<?= $p['id'] ?>" <?php if($book['id_pengarang'] == $p['id']){ print 'selected'; }?>><?= $p['pengarang'] ?></option>
            <?php endforeach ?>
         </select>
      </div>
      <div class="col">
         <label for="penerbit">Penerbit</label>
         <select class="custom-select" name="penerbit">
            <?php foreach($penerbit as $p) : ?>
               <option value="<?= $p['id'] ?>" <?php if($book['id_penerbit'] == $p['id']){ print 'selected'; }?>><?= $p['penerbit'] ?></option>
            <?php endforeach ?>
         </select>
      </div>
      <div class="col">
         <label for="cetakan">Cetakan</label>
         <input type="text" class="form-control" name="cetakan" id="cetakan"  value="<?= $book['cetakan'] ?>" autocomplete="off">
      </div>
   </div>

   <div class="form-row mt-4">
      <div class="col">
         <label for="tebal_halaman">Tebal Buku (Halaman)</label>
         <input type="number" class="form-control" name="tebal_halaman" id="tebal_halaman"  value="<?= $book['tebal_halaman'] ?>" autocomplete="off">
      </div>
      <div class="col">
         <label for="harga">Harga Buku</label>
         <input type="number" class="form-control" name="harga" id="harga"  value="<?= $book['harga'] ?>" autocomplete="off">
      </div>
      <div class="col">
         <label for="stok">Stok Tersedia</label>
         <input type="number" class="form-control" name="stok" id="stok"  value="<?= $book['stok'] ?>" autocomplete="off">
      </div>
   </div>

   <div class="form-group mt-4">
      <label for="exampleFormControlTextarea1">Deskripsi</label>
      <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" autocomplete="off"><?= $book['deskripsi'] ?></textarea>
   </div>

   <div class="row">
      <div class="col">
         <a href="index.php?page=buku" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-circle-left mr-2"></i>Kembali</a>
         <button type="submit" name="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save mr-2"></i>Simpan</button>
      </div>
   </div>

</form>

