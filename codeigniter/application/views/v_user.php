<!DOCTYPE html>
<html>
<head>
	<title>Membuat CRUD dengan CodeIgniter | MalasNgoding.com</title>
</head>
<body>
	<center><h1>Membuat CRUD dengan CodeIgniter | MalasNgoding.com</h1></center>
	<center><?php echo anchor('crud/tambah','Tambah Data'); ?></center>
    <?php
    
        if($this->session->userdata('status') != 'login')
        {
            ?>
            <center><h1> Anda belum login </h1></center>
            <center><?php echo anchor('crud/login','Login');?></center>
            <?php
        }else
        {
            ?>
            <center><h1> Selamat datang, <?php echo $this->session->userdata('nama');?> </h1></center>
            <center><?php echo anchor('crud/logout','Logout');?></center>
            <?php
        }
    
    ?>
	<table style="margin:20px auto;" border="1">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Pekerjaan</th>
			<th>Action</th>
		</tr>
		<?php 
            $no = 1;
            foreach($user as $u){ 
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $u->nama ?></td>
                <td><?php echo $u->alamat ?></td>
                <td><?php echo $u->pekerjaan ?></td>
                <td>
                        <?php echo anchor('crud/edit/'.$u->id,'Edit'); ?>
                        <?php echo anchor('crud/hapus/'.$u->id,'Hapus'); ?>
                </td>
            </tr>
		<?php } ?>
	</table>
</body>
</html>