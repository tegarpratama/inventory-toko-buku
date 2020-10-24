<?php 
   if($_SESSION['login'] != true){
      header('Location: login.php');
   }

   $crud = new Crud();
   $penerbit = $crud->getPenerbitById();

   if(isset($_POST['submit'])){
      if($crud->updatePenerbit() == true) {
         Flasher::setFlash('Data Penerbit Berhasil Diupdate!', 'success');
         header('Location:index.php?page=penerbit');
      }else{
         Flasher::setFlash('Oops, Terjadi Suatu Kesalahan!', 'danger');
      }
   }
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
   <h1 class="h2">Form Ubah Penerbit</h1>
</div>

<?php Flasher::flash(); ?> 

<form action="" method="post">

   <input type="hidden" name="id" value="<?= $penerbit['id'] ?>">

   <div class="form-group">
      <label for="penerbit">NamaPenerbit</label>
      <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $penerbit['penerbit'] ?>">
  </div>

   <div class="row">
      <div class="col">
         <a href="index.php?page=penerbit" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-circle-left mr-2"></i>Kembali</a>
         <button type="submit" name="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save mr-2"></i>Simpan</button>
      </div>
   </div>

</form>

