<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/sidoarjo.png" type="">
    <!-- tittle -->
    <title> UMKM | Website Desa Pabean Sidoarjo </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <a href="">Beranda</a>
            <a href="">Kontak</a>
            <a href="">Info</a>
            <a href="../pembeli.php">Keluar</a>
        </nav>
    </header>

    <!-- carousel -->
    <div class="carousel">
        <!-- list item -->
        <div class="list">
            <div class="item">
                <img src="image/img1.jpg">
                <div class="content">
                    <div class="author">BATIK PAK JUNAEDI</div>
                    <div class="title">BATIK SIDOARJO</div>
                    <div class="topic">BATIK</div>
                    <div class="des">
                        <!-- lorem 50 -->
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                    </div>
                    <div class="buttons">
                        <button>KUNJUNGI TOKO</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img2.jpeg">
                <div class="content">
                    <div class="author">WARUNG BU DJU</div>
                    <div class="title">IWAK ASIN & BUMBU</div>
                    <div class="topic">BUMBU</div>
                    <div class="des">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                    </div>
                    <div class="buttons">
                        <a href="tokoo/index.php" class="buttons">Kunjungi Toko</a>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img3.jpg">
                <div class="content">
                    <div class="author">REMPAH BU SUMADI</div>
                    <div class="title">REMPAH MASAKAN</div>
                    <div class="topic">REMPAH</div>
                    <div class="des">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                    </div>
                    <div class="buttons">
                        <a href="project_pweb/main/tokoo/index.php">Kunjungi Toko</a>
                    </div>

                </div>
            </div>
            <div class="item">
                <img src="image/img4.jpeg">
                <div class="content">
                    <div class="author">JAJANAN PASAR MAK INEM</div>
                    <div class="title">JAJANAN PASAR</div>
                    <div class="topic">JAJANAN</div>
                    <div class="des">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                    </div>
                    <div class="buttons">
                        <button>KUNJUNGI TOKO</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- list thumnail -->
        <div class="thumbnail">
            <div class="item">
                <img src="image/img1.jpg">
                <div class="content">
                    <div class="title">
                        Batik Sidoarjo
                    </div>
                    <div class="description">
                        Description
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img2.jpeg">
                <div class="content">
                    <div class="title">
                        Warung bu dju
                    </div>
                    <div class="description">
                        Description
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img3.jpg">
                <div class="content">
                    <div class="title">
                        Rempah Sumadi
                    </div>
                    <div class="description">
                        Description
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img4.jpeg">
                <div class="content">
                    <div class="title">
                        Jajanan pasar
                    </div>
                    <div class="description">
                        Description
                    </div>
                </div>
            </div>
        </div>
        <!-- next prev -->

        <div class="arrows">
            <button id="prev">></button>
            <button id="next">></button>
        </div>
        <!-- time running -->
        <div class="time"></div>
    </div>

    <script src="app.js"></script>
</body>
</html>