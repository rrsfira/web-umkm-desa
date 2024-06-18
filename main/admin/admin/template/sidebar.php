   <!-- **************************************************MAIN SIDEBAR MENU******************************************************** -->
   <!--sidebar start-->

   <aside>
       <div id="sidebar" class="nav-collapse ">
           <!-- sidebar menu start-->
           <ul class="sidebar-menu" id="nav-accordion">
               <br><br>
               <h5 class="centered"><?php echo $admin['name']; ?></h5>
               <h5 class="centered">( <?php echo $admin['user_type']; ?> )</h5>

               <li class="mt">
                   <a href="index.php">
                       <i class="fa fa-dashboard"></i>
                       <span>Dashboard</span>
                   </a>
               </li>

               <li class="sub-menu">
                   <a href="javascript:;">
                       <i class="fa fa-desktop"></i>
                       <span>Verifikasi <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                   </a>
                   <ul class="sub">
                       <li><a href="index.php?page=tampil">Verifikasi Penjual</a></li>
                   </ul>
               </li>

               <li class="sub-menu">
                   <a href="javascript:;">
                       <i class="fa fa-desktop"></i>
                       <span>Data Penjual <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                   </a>
                   <ul class="sub">
                       <li><a href="index.php?page=datapenjual">Data Penjual</a></li>
                   </ul>
               </li>
               <li class="sub-menu">
                   <a href="javascript:;">
                       <i class="fa fa-desktop"></i>
                       <span>Data User <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                   </a>
                   <ul class="sub">
                       <li><a href="index.php?page=datauser">Data User</a></li>
                   </ul>
               </li>
               <li class="sub-menu">
                   <a href="javascript:;">
                       <i class="fa fa-desktop"></i>
                       <span>Buat Akun <span style="padding-left:2px;"> <i class="fa fa-angle-down"></i></span></span>
                   </a>
                   <ul class="sub">
                       <li><a href="index.php?page=akunpenjual">Penjual</a></li>
                   </ul>
                   <ul class="sub">
                       <li><a href="index.php?page=akunuser">Admin</a></li>
                   </ul>
               </li>
               <!-- sidebar menu end-->
       </div>
   </aside>
   <!--sidebar end-->