<?php
	/*
	 * PROSES TAMPIL  
	 */ 
	 class view {
		protected $db;
		function __construct($db){
			$this->db = $db;
		}
			
			function member(){
				$sql = "select member.*, login.*
						from member inner join login on member.id_member = login.id_member";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function member_edit($id){
				$sql = "select member.*, login.*
						from member inner join login on member.id_member = login.id_member
						where member.id_member= ?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}
			
			function toko(){
				$sql = "select toko.*, login.*
        				from toko inner join login on toko.id_member = login.id_member";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function kategori(){
				$sql = "select*from kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function pemesanan(){
				$sql = "select*from pemesanan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function barang(){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori 
						ORDER BY id DESC";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			
			function barang_stok(){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori 
						where stok <= 3 
						ORDER BY id DESC";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function barang_edit($id){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where id_barang=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function barang_cari($cari){
				$sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
						from barang inner join kategori on barang.id_kategori = kategori.id_kategori
						where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function barang_id(){
				$sql = 'SELECT * FROM barang ORDER BY id DESC';
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				
				$urut = substr($hasil['id_barang'], 2, 3);
				$tambah = (int) $urut + 1;
				if(strlen($tambah) == 1){
					 $format = 'BR00'.$tambah.'';
				}else if(strlen($tambah) == 2){
					 $format = 'BR0'.$tambah.'';
				}else{
					$ex = explode('BR',$hasil['id_barang']);
					$no = (int) $ex[1] + 1;
					$format = 'BR'.$no.'';
				}
				return $format;
			}

			function kategori_edit($id){
				$sql = "select*from kategori where id_kategori=?";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($id));
				$hasil = $row -> fetch();
				return $hasil;
			}

			function kategori_row(){
				$sql = "select*from kategori";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function barang_row(){
				$sql = "select*from barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> rowCount();
				return $hasil;
			}

			function barang_stok_row(){
				$sql ="SELECT SUM(stok) as jml FROM barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function barang_beli_row(){
				$sql ="SELECT SUM(harga_beli) as beli FROM barang";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jual_row(){
				$sql ="SELECT SUM(jumlah) as stok FROM nota";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
			
			function jual(){
				$sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,
						member.nm_member from nota 
					   left join barang on barang.id_barang=nota.id_barang 
					   left join member on member.id_member=nota.id_member 
					   where nota.periode = ?
					   ORDER BY id_nota DESC";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array(date('m-Y')));
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function periode_jual($periode){
				$sql ="SELECT nota.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,
						member.nm_member from nota 
					   left join barang on barang.id_barang=nota.id_barang 
					   left join member on member.id_member=nota.id_member WHERE nota.periode = ? 
					   ORDER BY id_nota ASC";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($periode));
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function hari_jual($hari){
				$ex = explode('-', $hari);
				$monthNum  = $ex[1];
				$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
				if($ex[2] > 9)
				{
					$tgl = $ex[2];
				}else{
					$tgl1 = explode('0',$ex[2]);
					$tgl = $tgl1[1];
				}
				$cek = $tgl.' '.$monthName.' '.$ex[0];
				$param = "%{$cek}%";
				$sql ="SELECT nota.* , barang.id_barang, barang.nama_barang,  barang.harga_beli, member.id_member,
						member.nm_member from nota 
					   left join barang on barang.id_barang=nota.id_barang 
					   left join member on member.id_member=nota.id_member WHERE nota.tanggal_input LIKE ? 
					   ORDER BY id_nota ASC";
				$row = $this-> db -> prepare($sql);
				$row -> execute(array($param));
				$hasil = $row -> fetchAll();
				return $hasil;
			}

			function penjualan(){
				$sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, member.id_member,
						member.nm_member from penjualan 
					   left join barang on barang.id_barang=penjualan.id_barang 
					   left join member on member.id_member=penjualan.id_member
					   ORDER BY id_penjualan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function pemesanan_produk(){
				$sql ="SELECT pemesanan_produk.* , pemesanan_produk.id_pemesanan, barang.id_barang, barang.nama_barang from pemesanan_produk 
					   left join barang on barang.id_barang=pemesanan_produk.id_barang 
					   ORDER BY id_pemesanan";
				$row = $this-> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetchAll();
				return $hasil;
			}
			function jumlah(){
				$sql ="SELECT SUM(total) as bayar FROM penjualan";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jumlahp(){
				$sql ="SELECT SUM(total) as bayar FROM pemesanan";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jumlah_nota(){
				$sql ="SELECT SUM(total) as bayar FROM nota";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}

			function jml(){
				$sql ="SELECT SUM(harga_beli*stok) as byr FROM barang";
				$row = $this -> db -> prepare($sql);
				$row -> execute();
				$hasil = $row -> fetch();
				return $hasil;
			}
	 }
