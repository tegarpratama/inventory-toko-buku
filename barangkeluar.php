<?php 
   if($_SESSION['login'] != true){
      header('Location: login.php');
   }
   
   $crud = new Crud();
   $result = $crud->getBarangKeluar();

   if(isset($_POST['search'])){
      if($crud->searchBarangKeluar() == true){
         $result = $crud->searchBarangKeluar();
      }else{
         echo "
				<script>
					alert('Data tidak ditemukan');
					document.location.href = 'index.php?page=barangkeluar';
				</script>
			";
      }
   }
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
   <h1 class="h2">Data Barang Keluar</h1>
</div>

<div class="row justify-content-center mt-2">
   <div class="col-12">
      <?php Flasher::flash();?>
   </div>
</div>

<div class="row mt-4">
   <div class="col">
      <a href="index.php?page=create-bk" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>Tambah Barang Keluar</a>
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
         <th scope="col">Kode Barang Keluar</th>
         <th scope="col">Kode Buku</th>
         <th scope="col">Nama Buku</th>
         <th scope="col">Stok Keluar</th>
         <th scope="col">Tanggal</th>
         <th scope="col" style="width:  9%">Action</th>
      </tr>
   </thead>
   <tbody>
      <?php $no = 1; foreach($result as $r) : ?>
      <tr>
         <td><?= $r['kode_bk'] ?></td>
         <td><?= $r['kode_buku'] ?></td>
         <td><?= $r['buku'] ?></td>
         <td><?= $r['jumlah_bk'] ?></td>
         <td><?= $r['tanggal_bk'] ?></td>
         <td>
            <a href="index.php?id=<?= $r['id'] ?>&page=update-bk" class="btn btn-warning btn-sm text-light"><i class="fas fa-edit"></i></a>
            <a href="index.php?id=<?= $r['id'] ?>&page=delete-bk" class="btn btn-danger btn-sm text-light"><i class="fas fa-trash"></i></a>
         </td>
      </tr>
      <?php endforeach ?>
   </tbody>
</table>


