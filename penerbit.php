<?php 
   if($_SESSION['login'] != true){
      header('Location: login.php');
   }

   $crud = new Crud();
   $result = $crud->getPenerbit();

   if(isset($_POST['search'])){
      if($crud->searchPenerbit() == true){
         $result = $crud->searchPenerbit();
      }else{
         echo "
				<script>
					alert('Data tidak ditemukan');
					document.location.href = 'index.php?page=penerbit';
				</script>
			";
      }
   }
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
   <h1 class="h2">Data Penerbit</h1>
</div>

<div class="row justify-content-center mt-2">
   <div class="col-12">
      <?php Flasher::flash();?>
   </div>
</div>

<div class="row mt-4">
   <div class="col">
      <a href="index.php?page=create-penerbit" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>Tambah Penerbit</a>
   </div>
   <div class="col">
      <form class="form-inline float-right" action="" method="post">
         <label class="sr-only" for="inlineFormInputGroupSearch2">Search</label>
         <div class="input-group mb-2 mr-sm-2">
            <input type="text" name="keyword" class="form-control form-control-sm" id="inlineFormInputGroupSearch2" placeholder="Search Something...">
         </div>
         <button type="submit" name="search" class="btn btn-primary btn-sm mb-2"><i class="fas fa-search "></i></button>
      </form>
   </div>
</div>

<table class="table table-bordered mt-3">
   <thead>
      <tr>
         <th scope="col" style="width:  5%">No</th>
         <th scope="col">Penerbit</th>
         <th scope="col" style="width:  9%">Action</th>
      </tr>
   </thead>
   <tbody>
      <?php $no = 1; foreach($result as $r) : ?>
      <tr>
         <td><?= $no++ ?></td>
         <td><?= $r['penerbit'] ?></td>
         <td>
            <a href="index.php?id=<?= $r['id'] ?>&page=update-penerbit" class="btn btn-warning btn-sm text-light"><i class="fas fa-edit"></i></a>
            <a href="index.php?id=<?= $r['id'] ?>&page=delete-penerbit" class="btn btn-danger btn-sm text-light"><i class="fas fa-trash"></i></a>
         </td>
      </tr>
      <?php endforeach ?>
   </tbody>
</table>


