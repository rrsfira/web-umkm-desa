 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
	  <?php 
	$id = $_GET['barang'];
	$hasil = $lihat -> barang_edit($id);
?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
					  	<a href="index.php?page=barang"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik </button></a>
						<h3>Details Barang</h3>
						<?php if(isset($_GET['success-stok'])){?>
						<div class="alert alert-success">
							<p>Tambah Stok Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Tambah Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>
						<table class="table table-striped">
								<tr>
								<div class="col-sm-3">
								<div class="panel panel-primary">
									<div class="panel-heading">
									</div>
									<div class="panel-body">
										<center><img src="assets/img/barang/<?php echo $hasil['gmbr'];?>"  alt="#" style="width:200px;border:4px solid #ddd;"/></center>			
									</div>
									<div class="panel-footer">
										<form method="POST" action="fungsi/edit/edit.php?gmbr=barang" enctype="multipart/form-data">
											<input type="file" accept="image/*" name="fotot">
											<input type="hidden" value="<?php echo $hasil['gmbr'];?>" name="fotot2">
											<input type="hidden"  name="id" value="<?php echo $hasil['id_barang'];?>">
											<span class="pull-right">
												<button type="submit"  class="btn btn-primary btn-sm" value="Tambah"><i class="fa fa-pencil"> Ganti Foto</i></button>
											</span>
										</form>
										<br/>
										<br/>
									</div>
								</div>
							</div>
								</tr><tr>
									<td>ID Barang</td>
									<td><?php echo $hasil['id_barang'];?></td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td><?php echo $hasil['nama_kategori'];?></td>
								</tr>
								<tr>
									<td>Nama Barang</td>
									<td><?php echo $hasil['nama_barang'];?></td>
								</tr>
								<tr>
									<td>Merk Barang</td>
									<td><?php echo $hasil['merk'];?></td>
								</tr>
								<tr>
									<td>Harga Beli</td>
									<td><?php echo $hasil['harga_beli'];?></td>
								</tr>
								<tr>
									<td>Harga Jual</td>
									<td><?php echo $hasil['harga_jual'];?></td>
								</tr>
								<tr>
									<td>Satuan Barang</td>
									<td><?php echo $hasil['satuan_barang'];?></td>
								</tr>
								<tr>
									<td>Stok</td>
									<td><?php echo $hasil['stok'];?></td>
								</tr>
								<tr>
									<td>Tanggal Input</td>
									<td><?php echo $hasil['tgl_input'];?></td>
								</tr>
								<tr>
									<td>Tanggal Update</td>
									<td><?php echo $hasil['tgl_update'];?></td>
								</tr>
						</table>
						<div class="clearfix" style="padding-top:16%;"></div>
				  </div>
              </div>
          </section>
      </section>
	
