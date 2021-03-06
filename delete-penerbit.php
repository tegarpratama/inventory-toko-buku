<?php 
   if($_SESSION['login'] != true){
      header('Location: login.php');
   }

   $crud = new Crud();

   if(isset($_POST['submit'])){
      if($crud->deletePenerbit() == true){
            Flasher::setFlash('Data Penerbit Berhasil Dihapus!', 'success');
            header('Location: index.php?page=penerbit');
         }else{
            Flasher::setFlash('Data Penerbit Gagal Dihapus!', 'danger');
            header('Location: index.php?page=penerbit');
      }
   }
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
   <h1 class="h2">Hapus Data Penerbit</h1>
</div>

<?php if(isset($_GET['id'])) : ?>   
   <div class="alert alert-danger" role="alert">
      Yakin ingin menghapus data penerbit ?
   </div>

   <form action="" method="post">
      <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
      <button name="submit" type="submit" class="btn btn-danger btn-sm">Hapus</button>
      <a href="index.php?page=penerbit" class="btn btn-secondary btn-sm">Batal</a>
   </form>
      
<?php else: ?>
   <h2 class="text-center mt-5">404 Not Found!</h2>
<?php endif ?>

