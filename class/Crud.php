<?php

   include_once('Database.php');
   include_once('library/Validation.php');

   class Crud extends Database {

      public $validation;

      public function __construct()
      {
         parent::__construct();
         $this->validation = new Validation(); 
      }

      public function execute($query)
      {
         while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
         }
         
         return $rows;
      }

      public function execute_a_row($query)
      {
         while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
         }
         
         return $rows[0];
      }

      public function getBook()
      {
         $query = $this->connection->query(
               "SELECT buku.id, buku.kode_buku, buku.judul, buku.stok, pengarang.pengarang, penerbit.penerbit 
               FROM buku JOIN pengarang ON buku.id_pengarang=pengarang.id 
               JOIN penerbit ON buku.id_penerbit = penerbit.id"
            );
            
         return $this->execute($query);
      }

      public function getDetail()
      {
         $id = $_GET['id'];
         $query = $this->connection->query(
            "SELECT buku.*, pengarang.pengarang, penerbit.penerbit 
            FROM buku JOIN pengarang ON buku.id_pengarang=pengarang.id 
            JOIN penerbit ON buku.id_penerbit = penerbit.id
            WHERE buku.id = $id"
         );

         return $this->execute_a_row($query);
      }

      public function getPengarang()
      {
         $query = $this->connection->query("SELECT * FROM pengarang");

         return $this->execute($query);
      }

      public function getPenerbit()
      {
         $query = $this->connection->query("SELECT * FROM penerbit");

         return $this->execute($query);
      }

      public function getLastKodeBuku()
      {
         $query = $this->connection->query("SELECT kode_buku FROM buku ORDER BY id DESC LIMIT 1");
         
         while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
         }
         
         $lastNumber = (int) substr($rows[0]['kode_buku'], 4, 4);
         $lastNumber += 1;
         $kodeBuku = "B" . sprintf("%04s", $lastNumber);
         return $kodeBuku;
      }

      public function getLastKodeBM()
      {
         $query = $this->connection->query("SELECT kode_bm FROM barang_masuk ORDER BY id DESC LIMIT 1");
         
         while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
         }
         
         $lastNumber = (int) substr($rows[0]['kode_bm'], 4, 4);
         $lastNumber += 1;
         $kodeBuku = "BM" . sprintf("%04s", $lastNumber);
         return $kodeBuku;
      }

      public function getLastKodeBK()
      {
         $query = $this->connection->query("SELECT kode_bk FROM barang_keluar ORDER BY id DESC LIMIT 1");
         
         while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
         }
         
         $lastNumber = (int) substr($rows[0]['kode_bk'], 4, 4);
         $lastNumber += 1;
         $kodeBuku = "BK" . sprintf("%04s", $lastNumber);
         return $kodeBuku;
      }

      public function getPenerbitById()
      {
         $id = $_GET['id'];
         $query = $this->connection->query(
            "SELECT * FROM penerbit WHERE id = $id"
         );

         return $this->execute_a_row($query);
      }

      public function getBarangMasuk()
      {
         $query = $this->connection->query(
            "SELECT barang_masuk.*, buku.kode_buku AS kode_buku,buku.judul AS buku FROM barang_masuk
             JOIN buku ON barang_masuk.buku_id = buku.id
             ORDER BY barang_masuk.id ASC"
         );

         return $this->execute($query);
      }

      public function getBarangKeluar()
      {
         $query = $this->connection->query(
            "SELECT barang_keluar.*, buku.kode_buku AS kode_buku,buku.judul AS buku FROM barang_keluar
             JOIN buku ON barang_keluar.buku_id = buku.id
             ORDER BY barang_keluar.id ASC"
         );

         return $this->execute($query);
      }

      public function getBarangMasukById()
      {
         $id = $_GET['id'];

         $query = $this->connection->query(
            "SELECT barang_masuk.*, buku.kode_buku AS kode_buku,buku.judul FROM barang_masuk
             JOIN buku ON barang_masuk.buku_id = buku.id
             WHERE barang_masuk.id = $id"
         );

         return $this->execute_a_row($query);
      }

      public function getBarangKeluarById()
      {
         $id = $_GET['id'];

         $query = $this->connection->query(
            "SELECT barang_keluar.*, buku.kode_buku AS kode_buku,buku.judul FROM barang_keluar
             JOIN buku ON barang_keluar.buku_id = buku.id
             WHERE barang_keluar.id = $id"
         );

         return $this->execute_a_row($query);
      }

      public function insertPengarang()
      {
         $pengarang = $this->validation->checkInput($_POST['pengarang']);
         
         if ($pengarang == false) {
            return false;
            exit;
         } else {
            $this->connection->query("INSERT INTO pengarang VALUES ('', '$pengarang')");
            return true;
         }	
      }

      public function insertPenerbit()
      {
         $penerbit = $this->validation->checkInput($_POST['penerbit']);
         
         if ($penerbit == false) {
            return false;
            exit;
         } else {
            $this->connection->query("INSERT INTO penerbit VALUES ('', '$penerbit')");
            return true;
         }	
      }

      public function insertBook()
      {
         $judul         = $this->validation->checkInput($_POST['judul']);
         $kode_buku     = $this->validation->checkInput($_POST['kode_buku']);
         $id_pengarang  = $this->validation->isEmpty($_POST['pengarang']);
         $id_penerbit   = $this->validation->isEmpty($_POST['penerbit']);
         $tebal_halaman = $this->validation->isNumber($_POST['tebal_halaman']);
         $cetakan       = $this->validation->isEmpty($_POST['cetakan']);
         $harga         = $this->validation->isNumber($_POST['harga']);
         $stok          = $this->validation->isNumber($_POST['stok']);
         $deskripsi     = $this->validation->checkInput($_POST['deskripsi']);

         
         
         if(($judul && $kode_buku && $id_penerbit && $id_penerbit && $tebal_halaman && $cetakan && $harga && $stok && $deskripsi) == false) {
            return false;
         }else{
            $this->connection->query("INSERT INTO buku VALUES ('', '$kode_buku','$judul', '$id_pengarang', '$id_penerbit', '$tebal_halaman', '$cetakan', '$harga', '$stok', '$deskripsi')");
            return true;
         }
      }

      public function insertBM()
      {
         $kode_bm    = $this->validation->checkInput($_POST['kode_bm']);
         $kode_buku  = $this->validation->checkInput($_POST['kode_buku']);
         $jumlah_bm  = $this->validation->isEmpty($_POST['jumlah_bm']);
         $tanggal_bm = $this->validation->isEmpty($_POST['tanggal_bm']);
         
         if(($kode_bm && $kode_buku && $jumlah_bm && $tanggal_bm) == false) {
            return false;
         }else{
            $this->connection->query("INSERT INTO barang_masuk VALUES ('','$kode_bm', '$kode_buku', '$jumlah_bm', '$tanggal_bm')");
            return true;
         }
      }

      public function insertBK()
      {
         $kode_bk    = $this->validation->checkInput($_POST['kode_bk']);
         $kode_buku  = $this->validation->checkInput($_POST['kode_buku']);
         $jumlah_bk  = $this->validation->isEmpty($_POST['jumlah_bk']);
         $tanggal_bk = $this->validation->isEmpty($_POST['tanggal_bk']);
         
         if(($kode_bk && $kode_buku && $jumlah_bk && $tanggal_bk) == false) {
            return false;
         }else{
            $this->connection->query("INSERT INTO barang_keluar VALUES ('','$kode_bk', '$kode_buku', '$jumlah_bk', '$tanggal_bk')");
            return true;
         }
      }

      public function updateBook()
      {
         $id            = $_POST['id'];
         $kode_buku     = $this->validation->checkInput($_POST['kode_buku']);
         $judul         = $this->validation->checkInput($_POST['judul']);
         $id_pengarang  = $this->validation->isEmpty($_POST['pengarang']);
         $id_penerbit   = $this->validation->isEmpty($_POST['penerbit']);
         $tebal_halaman = $this->validation->isNumber($_POST['tebal_halaman']);
         $cetakan       = $this->validation->isEmpty($_POST['cetakan']);
         $harga         = $this->validation->isNumber($_POST['harga']);
         $stok          = $this->validation->isNumber($_POST['stok']);
         $deskripsi     = $this->validation->checkInput($_POST['deskripsi']);
         
         if(($kode_buku && $judul && $id_pengarang && $id_penerbit && $tebal_halaman && $cetakan && $harga && $stok && $deskripsi) == false) {
            return false;
            exit;
         }else{
            $this->connection->query(
               "UPDATE buku SET 
                  kode_buku = '$kode_buku',
                  judul = '$judul', 
                  id_pengarang = '$id_pengarang', 
                  id_penerbit = '$id_penerbit', 
                  tebal_halaman = '$tebal_halaman', 
                  cetakan = '$cetakan', 
                  harga = '$harga', 
                  stok = '$stok', 
                  deskripsi = '$deskripsi'
               WHERE id = $id"
            );
            return true;
         }
      }

      public function updatePenerbit()
      {
         $id       = $_POST['id'];
         $penerbit = $this->validation->checkInput($_POST['penerbit']);

         if($penerbit == false) {
            return false;
            exit;
         }else{
            $this->connection->query(
               "UPDATE penerbit SET 
                  penerbit = '$penerbit'
               WHERE id = $id"
            );
            return true;
         }
      }

      public function updateBM()
      {
         $id         = $_POST['id'];
         $kode_bm    = $this->validation->checkInput($_POST['kode_bm']);
         $kode_buku  = $this->validation->checkInput($_POST['kode_buku']);
         $jumlah_bm  = $this->validation->isEmpty($_POST['jumlah_bm']);
         $tanggal_bm = $this->validation->isEmpty($_POST['tanggal_bm']);

         if(($kode_bm && $kode_buku && $jumlah_bm && $tanggal_bm) == false) {
            return false;
         }else{
            $this->connection->query(
               "UPDATE barang_masuk SET 
               kode_bm = '$kode_bm',
               buku_id = '$kode_buku', 
               jumlah_bm = '$jumlah_bm', 
               tanggal_bm = '$tanggal_bm'
            WHERE id = $id"
            );
            return true;
         }

      }

      public function updateBK()
      {
         $id         = $_POST['id'];
         $kode_bk    = $this->validation->checkInput($_POST['kode_bk']);
         $kode_buku  = $this->validation->checkInput($_POST['kode_buku']);
         $jumlah_bk  = $this->validation->isEmpty($_POST['jumlah_bk']);
         $tanggal_bk = $this->validation->isEmpty($_POST['tanggal_bk']);

         if(($kode_bk && $kode_buku && $jumlah_bk && $tanggal_bk) == false) {
            return false;
         }else{
            $this->connection->query(
               "UPDATE barang_keluar SET 
               kode_bk = '$kode_bk',
               buku_id = '$kode_buku', 
               jumlah_bk = '$jumlah_bk', 
               tanggal_bk = '$tanggal_bk'
            WHERE id = $id"
            );
            return true;
         }

      }

      public function deleteBook()
      {
         $id = $_GET['id'];

         if(isset($id)){
            $this->connection->query("DELETE FROM buku WHERE id = $id");
            return true;
         }else{
            return false;
         }
      }

      public function deletePenerbit()
      {
         $id = $_GET['id'];

         if(isset($id)){
            $this->connection->query("DELETE FROM penerbit WHERE id = $id");
            return true;
         }else{
            return false;
         }
      }

      public function deleteBM()
      {
         $id = $_GET['id'];

         if(isset($id)){
            $this->connection->query("DELETE FROM barang_masuk WHERE id = $id");
            return true;
         }else{
            return false;
         }
      }

      public function deleteBK()
      {
         $id = $_GET['id'];

         if(isset($id)){
            $this->connection->query("DELETE FROM barang_keluar WHERE id = $id");
            return true;
         }else{
            return false;
         }
      }

      public function searchBook()
      {
         $keyword = $_POST['keyword'];
         $query = $this->connection->query(
            "SELECT buku.id, buku.kode_buku, buku.judul AS judul, buku.stok AS stok, pengarang.pengarang AS pengarang, penerbit.penerbit AS penerbit 
            FROM buku JOIN pengarang ON buku.id_pengarang=pengarang.id 
            JOIN penerbit ON buku.id_penerbit = penerbit.id 
            WHERE judul LIKE '%$keyword%' OR kode_buku LIKE '%$keyword%' OR stok LIKE '%$keyword%' OR pengarang LIKE '%$keyword%' OR penerbit LIKE '%$keyword%'");

            while ($row = $query->fetch_assoc()) {
               if(isset($row)){
                  $rows[] = $row;
                  return $rows;
               }else{
                  return false;
               }
            }
      }

      public function searchPenerbit()
      {
         $keyword = $_POST['keyword'];
         $query = $this->connection->query(
            "SELECT penerbit.penerbit AS penerbit FROM penerbit WHERE penerbit LIKE '%$keyword%'");

         while ($row = $query->fetch_assoc()) {
            if(isset($row)){
               $rows[] = $row;
               return $rows;
            }else{
               return false;
            }
         }
      }

      public function searchBarangMasuk()
      {
         $keyword = $_POST['keyword'];
         $query = $this->connection->query(
            "SELECT barang_masuk.*, buku.kode_buku,buku.judul AS buku FROM barang_masuk
            JOIN buku ON barang_masuk.buku_id = buku.id WHERE barang_masuk.kode_bm LIKE '%$keyword%' OR barang_masuk.jumlah_bm LIKE '%$keyword%' OR barang_masuk.tanggal_bm LIKE '%$keyword%' OR buku.judul LIKE '%$keyword%'");

         while ($row = $query->fetch_assoc()) {
            if(isset($row)){
               $rows[] = $row;
               return $rows;
            }else{
               return false;
            }
         }
      }

      public function searchBarangKeluar()
      {
         $keyword = $_POST['keyword'];
         $query = $this->connection->query(
            "SELECT barang_keluar.*, buku.kode_buku,buku.judul AS buku FROM barang_keluar
            JOIN buku ON barang_keluar.buku_id = buku.id WHERE barang_keluar.kode_bk LIKE '%$keyword%' OR barang_keluar.jumlah_bk LIKE '%$keyword%' OR barang_keluar.tanggal_bk LIKE '%$keyword%' OR buku.judul LIKE '%$keyword%'");

         while ($row = $query->fetch_assoc()) {
            if(isset($row)){
               $rows[] = $row;
               return $rows;
            }else{
               return false;
            }
         }
      }
   }