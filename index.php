<?php
    //Koneksi Database
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "dblatihan";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

    //jika tombol simpan diklik
    if(isset($_POST['bsimpan']))
    {
        $simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi)
                                          VALUES ('$_POST[tnim]',
                                                 '$_POST[tnama]',
                                                 '$_POST[talamat]',
                                                 '$_POST[tprodi]')
                                         ");
        if($simpan)  //jika simpan sukses
        {
            echo "<script>
                    alert('Simpan data sukses!');
                    document.location.href='index.php';
                  </script>";
        }
        else
        {
            echo "<script>
                    alert('Simpan data GAGAL!!');
                    document.location.href='index.php';
                 </script>";  
        }
    }


    //Pengujian jika tombol Edit/Hapus di klik
    if (isset($_GET['hal']))
    
        //Pengujian Jika edit Data
        if($_GET['hal']=="edit")
        {
            //Tampilkan Data yang akan diedit
            $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]'");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //Jika Data ditemukan,maka Data ditampung dulu ke dalam variabel
                $vnim = $data['nim'];
                $vnama = $data['nama'];
                $valamat = $data ['alamat'];
                $vprodi = $data ['prodi'];
            }
        }
        else if ($_GET['hal']== "hapus")
    
    //persiapan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_GET[id]'");
    if($hapus) //jika hapus data sukses
    {
        echo "<script>
                alert('Hapus data sukses!');
                document.location.href='index.php';
              </script>"
    ;}
    


?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD 2020 PHP &  MySQL + Bootstrap 4</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <h1 class="text-center">CRUD PHP & MySQL + BOOTSTRAP</h1>
    <h2 class="text-center"> TUGAS PWDPB Dian Anggraini</h2>

    <!--awal card form-->
    <div class="card mt-3">
    <div class="card-header bg-success text-white">
        Form Input Mahasiswa
    </div>
    <div class="card-body">
        <form method="post" action="">
             <div class="form-group">
                <label>Nim</label>
                <input type="text" name="tnim"  class="form-control" placeholder="Input Nim Anda disini!" require >
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="tnama"  class="form-control" placeholder="Input Nama Anda disini!" require >
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="talamat" placeholder="Input Alamat Anda disini!"></textarea>
            </div>
            <div class="form-group">
                <label>Program Studi</label>
                <select class="form-control" name="tprodi">
                    <option></option>
                    <option value="D3-MI">D3-MI</option>
                    <option value="S1-SI">S1-SI</option>
                    <option value="S1-TI">S1-TI</option>
                </select>
            </div>

            <buttom type="submit" class="btn btn-primary" name="bsimpan">Simpan</buttom>
            <buttom type="reset" class="btn btn-danger" name="breset">Kosongkan</buttom>

        </form>
    </div>
    </div>
    <!--akhir card form-->

    <!--awal card tabel-->
    <div class="card mt-3">
    <div class="card-header bg-info text-white">
       Daftar Mahasiswa
    </div>
    <div class="card-body">

    <table class="table table-bordered table-striped">
        <tr>
            <th>No.</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Program Studi</th>
            <th>Aksi</th>
        </tr>
        <?php
            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * from tmhs order by id_mhs desc");
            while($data = mysqli_fetch_array($tampil)) :
        
        ?>
        <tr>
            <td><?=$no++;?></td>
            <td><?=$data['nim']?></td>
            <td><?=$data['nama']?></td>
            <td><?=$data['alamat']?></td>
            <td><?=$data['prodi']?></td>
            <td>
                <a href="index.php?hal=edit&id=<?=$data['id_mhs']?>" class="btn btn-warning"> Edit </a>
                <a href="index.php?hal=hapus&id=<?$data['id_mhs']?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')"class="btn btn-danger"> Hapus </a>
            </td>
        </tr>
            <?php endwhile; //penutup perulangan while ?>
    </table>

    </div>
    </div>
    <!--akhir card tabel-->

</div>

<script type="text/javascript" src="css/bootstrap.min.js"></script>
</body>
</html>