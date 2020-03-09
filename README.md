# Dokumentasi Praktikum 3 Workshop Web Framework

Berikut ini adalah dokumentasi praktikum 3 workshop web framework.

## Requirements

- PHP 7.2.28 atau lebih tinggi.
- XAMPP 7.2.28 atau lebih tinggi ( atau aplikasi lainnya ).
- Code Igniter 3.1.11.
- Visual Studio Code atau text editor lainnya.

## Instalasi

- Download Code Igniter [CodeIgniter](https://codeigniter.com/en/download).
- Ekstrak Code Igniter kedalam folder yang telah dibuat.
- Buka folder yang berisi Code Igniter dengan text editor pilihan anda.

## Penggunaan

## 1. _autoload.php_
   File ini berfungsi untuk memuat seluruh **_library_** yang ada di dalam Code Igniter.
   
   1. Setelah selesai instalasi Code Igniter, buka folder **application/confing** kemudian buka **_autoload.php_**.
      
      ![ImageDokumentasi1](https://github.com/bagoesihsant/E41181277_Praktikum_3/blob/master/img_dokumentasi/Screenshot_Dokumentasi_001.png)
   
   2. Dalam **_autoload.php_**, temukan kode 
      ```php
      $autoload['libraries'] = array();
      ```
   3. Kemudian tambahkan **_library_** seperti **_database dan session_** kedalam baris kode tersebut.
      ```php
      $autoload['libraries'] = array('database','session');
      ```
   4. Fungsi bari baris kode diatas adalah memuat library **_database_** dan **_session_**.
   
   5. Kemudan dalam **_autoload.php_**, temukan kode
      ```php
      $autoload['helper'] = array();
      ```
   6. Kemudian tambahkan **_helper_** seperti **_url_** kedalam baris kode tersebut.
      ```php
      $autoload['helper'] = array('url');
      ```
   7. Fungsi dari baris kode tersebut adalah memuat library **_url_**.
      
## 2. _config.php_
   File ini berfungsi sebagai konfigurasi Code Igniter yang sudah anda install kedalam folder anda.
   
   1. Setelah selesai mengisi **_autoload.php_**, buka folder **application/config** kemudian buka **_config.php_**.
   
      ![ImageDokumentasi2](https://github.com/bagoesihsant/E41181277_Praktikum_3/blob/master/img_dokumentasi/Screenshot_Dokumentasi_002.png)
   
   2. Dalam **_config.php_**, temukan kode
      ```php
      $config['base_url'] = '';
      ```
   3. Kemudian tambahkan **_URL_** atau link kalian kedalam kode tersebut.
      ```php
      $config['base_url'] = 'https://www.contohlinkamu.com';
      ```
   4. Fungsi dari baris kode diatas adalah mempermudah developer mengatur url ketika memuat resource atau mengatur url untuk berpindah halaman.
   
## 3. _database.php_
   File ini berfungsi sebagai konfigurasi database yang akan kita gunakan.
   
   1. Setelah selesai mengisi **_config.php_**, buka folder **apllication/config** kemudian buka **_database.php_**.
      
      ![ImageDokumentasi3](https://github.com/bagoesihsant/E41181277_Praktikum_3/blob/master/img_dokumentasi/Screenshot_Dokumentasi_003.png)
   
   2. Dalam **_database.php_**, temukan kode
      ```php
      $db['default'] = array(
            'dsn'	=> '',
            'hostname' => 'localhost',
            'username' => '',
            'password' => '',
            'database' => '',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
      );
      ```
   3. Kemudian tambahkan konfigurasi server berisi database yang akan digunakan, dengan memasukkan username server, dan password ( bila ada ), kemudian nama database yang akan digunakan.
   
   4. Contoh kode :
      ```php
      $db['default'] = array(
               'dsn'	=> '',
               'hostname' => 'localhost',
               'username' => 'root',
               'password' => '*****',
               'database' => 'contohdb',
               'dbdriver' => 'mysqli',
               'dbprefix' => '',
               'pconnect' => FALSE,
               'db_debug' => (ENVIRONMENT !== 'production'),
               'cache_on' => FALSE,
               'cachedir' => '',
               'char_set' => 'utf8',
               'dbcollat' => 'utf8_general_ci',
               'swap_pre' => '',
               'encrypt' => FALSE,
               'compress' => FALSE,
               'stricton' => FALSE,
               'failover' => array(),
               'save_queries' => TRUE
         );
      ``` 
   5. Fungsi dari baris kode diatas adalah menyambungkan Code Igniter dengan server dan database yang akan digunakan.
   
## 4. _crud.php_
   File ini berfungsi sebagai **_Controller_**. **_Controller_** adalah file dalam Code Igniter yang berfungsi untuk menghubungkan **_View_** dan **_Model_**. Penjelasan mengenai **_View_** dan **_Model_** akan dibahas pada bagian selanjutnya.
   
   1. Setelah selesai mengedit **_database.php_**, buka folder **application/controllers** dan buat file baru bernama **_crud.php_**.
      
      ![ImageDokumentasi4](https://github.com/bagoesihsant/E41181277_Praktikum_3/blob/master/img_dokumentasi/Screenshot_Dokumentasi_004.png)
      
   2. Kemudian ketikkan kode berikut ini kedalam **_crud.php_**.
      ```php
      <?php
      defined('BASEPATH') OR exit('No direct script access allowed');

      class Crud extends CI_Controller {

          public function __construct()
          {
              parent::__construct();

              if($this->session->userdata('status') != "login"){
                  return false;
              }

          }

          public function index()
          {
              $data['user'] = $this->m_data->tampil_data()->result();
              $this->load->view('v_user',$data);
          }

          public function login()
          {
              $this->load->view('v_login');
          }

          public function aksi_login(){
              $username = $this->input->post('username');
              $password = $this->input->post('password');
              $where = array(
                        'username' => $username,
                        'password' => md5($password)
              );
              $cek = $this->m_data->cek_login("admin",$where)->num_rows();
              if($cek > 0){

                  $data_session = array(
                                   'nama' => $username,
                                   'status' => "login"
                                  );

                  $this->session->set_userdata($data_session);

                  redirect(base_url("crud"));

              }else{
                  echo "Username dan password salah !";
              }
          }

          public function logout(){
              $this->session->sess_destroy();
              redirect(base_url('crud/login'));
          }

          public function tambah()
          {
              $this->load->view('v_input');
          }

          public function tambah_aksi(){
              $nama = $this->input->post('nama');
              $alamat = $this->input->post('alamat');
              $pekerjaan = $this->input->post('pekerjaan');

              $data = array(
                      'nama' => $nama,
                      'alamat' => $alamat,
                      'pekerjaan' => $pekerjaan
                    );
              $this->m_data->input_data($data,'user');
              redirect('crud/index');
          }

          public function hapus($id){
              $where = array('id' => $id);
              $this->m_data->hapus_data($where,'user');
              redirect('crud/index');
          }

          public function edit($id){
              $where = array('id' => $id);
              $data['user'] = $this->m_data->edit_data($where,'user')->result();
              $this->load->view('v_update',$data);
          }

          public function update(){
              $id = $this->input->post('id');
              $nama = $this->input->post('nama');
              $alamat = $this->input->post('alamat');
              $pekerjaan = $this->input->post('pekerjaan');

              $data = array(
                  'nama' => $nama,
                  'alamat' => $alamat,
                  'pekerjaan' => $pekerjaan
              );

              $where = array(
                  'id' => $id
              );

              $this->m_data->update_data($where,$data,'user');
              redirect('crud/index');
          }

      }
      ?>
      ```
   3. Function / Method **_index_**, adalah function yang pertama kali diakses ketika pengguna membuka Code Igniter. Dalam method **_index_** terdapat variabel berupa array berisi data yang diambil dari **_Model m_data.php_** menggunakan method **_tampil_data()_**. Kemudian method **_index_** akan menampilkan **_View v_user.php_** dan mengirimkan array berisi data dari **_Model m_data.php_**.
   
   4. Function / Method **_login_**, adalah function yang berfungsi untuk menampilkan **_View v_login.php_**.
   
   5. Function / Method **_aksi_login_**, adalah function yang berfungsi untuk memeriksa apakah username dan password yang dimasukkan oleh user melalui **_v_login.php_** terdapat dalam database melalui method **_cek_login_** pada **_m_data.php_**. Apabila username dan password ditemukan maka function **_aksi_login_** akan mengatur session bahwa saat ini kita sedang login, apabila username dan password tidak ditemukan maka dikembalikan menuju halaman utama.
   
   6. Function / Method **_logout_**, adalah function yang berfungsi untuk menghapus session kita dari browser sehingga kita keluar dari jalannya sistem.
   
   7. Function / Method **_tambah_**, adalah function yang berfungsi untuk menampilkan **_View v_input.php_**.
   
   8. Function / Method **_tambah_aksi_**, adalah function yang berfungsi untuk menambahkan data berdasarkan input user kedalam database menggunakan method **_input_data_** dari **_m_data.php_**.
   
   9. Function / Method **_hapus_**, adalah function yang berfungsi untuk menghapus data berdasarkan input user ke database menggunakan method **_hapus_data_** dari **_m_data.php_**.
   
   10. Function / Method **_edit_**, adalah function yang berfungsi untuk menampilkan **_View V_update_** berisi data yang diambil dari database menggunakan method **_edit_data_** dari **_m_data.php_** berdasarkan input user.
   
   11. Function / Method **_update_**, adalah function yang berfungsi untuk mengubah data dalam database berdasarkan input user menggunakan method **_update_data_** dari **_m_data.php_**.
   
## 5. _m_data.php_
   File ini berfungsi sebagai **_Model_**. **_Model_** adalah file Code Igniter yang berfungsi untuk berinteraksi dengan database seperti menyimpan, menghapus, mengubah, mengambil, dan lainnya.
   
   1. Setelah selesai mengedit **_crud.php_**, buka folder **application/models** kemudian buat file baru bernama **_m_data.php_**.
      
      ![ImageDokumentasi5](https://github.com/bagoesihsant/E41181277_Praktikum_3/blob/master/img_dokumentasi/Screenshot_Dokumentasi_005.png)
      
   2. Kemudian ketikkan kode berikut ini kedalam **_m_data.php_**.
      ```php
      <?php
         class M_data extends CI_Model{
            
            public function tampil_data()
            {
               return $this->db->get('user');
            }
            
            public function input_data($data, $table)
            {
               $this->db->insert($table,$data);
            }
            
            public function hapus_data($where,$table)
            {
               $this->db->where($where);
               $this->db->delete($table);
            }
            
            public function edit_data($where,$table)
            {
               $this->db->get_where($table,$where);
            }
            
            public function update_data($where,$data,$table)
            {
               $this->db->where($where);
               $this->db->update($table,$data);
            }
            
            public function cek_login($table, $where)
            {
               return $this->db->get_where($table,$where);
            }
            
         }
      ?>
      ```
   3. Fungsi / Method **_tampil_data_**, berfungsi untuk mengambil **_seluruh_** data dari database.
  
   4. Fungsi / Method **_input_data_**, berfungsi untuk memasukkan data dari user kedalam database.
  
   5. Fungsi / Method **_hapus_data_**, berfungsi untuk menghapus data dalam database berdasarkan input user.
  
   6. Fungsi / Method **_edit_data_**, berfungsi untuk mengambil **_sebagian_** data dari database berdasarkan input user.
  
   7. Fungsi / Method **_update_data_**, berfungsi untuk mengubah data dalam database berdasarkan input user.
  
   8. Fungsi / Method **_cek_login_**, berfungsi untuk mencari apakah username dan password user berada didalam database atau tidak.
  
## 6. _v_user.php_
   File ini berfungsi sebagai **_View_**. **_View_**, adalah file Code Igniter yang berfungsi sebagai laman yang ditampilkan ke user.
   
   1. Setelah selesai mengedit **_m_data.php_**, buka folder **application/views** kemudian buat file baru bernama **_v_user.php_**.
      
      ![ImageDokumentasi6](https://github.com/bagoesihsant/E41181277_Praktikum_3/blob/master/img_dokumentasi/Screenshot_Dokumentasi_006.png)
      
   2. Kemudian ketikkan kode beriut kedalam **_v_user.php_**.
      ```php
         <!DOCTYPE HTML>
         <html>
            <head>
               <title>Membuat CRUD dengan CodeIgniter | MalasNgoding.com</title>
            </head>
            <body>
               <center><h1>Membuat CRUD dengan CodeIgniter | MalasNgoding.com</h1></center>
               <center><?php echo anchor('crud/tambah','Tambah Data');?></center>
               
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
                     <center><h1>Selamat datang, <?php echo $this->session->userdata('nama');?></h1></center>
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
                     foreach($user as $u)
                     {
                        ?>
                           <td><?php echo $no++; ?></td>
                           <td><?php echo $u->nama; ?></td>
                           <td><?php echo $u->alamat; ?></td>
                           <td><?php echo $u->pekerjaan; ?></td>
                           <td>
                              <?php echo anchor('crud/edit'.$u->id,'Edit');?>
                              <?php echo anchor('crud/edit'.$u->id,'Hapus')?>
                           </td>
                        <?php
                     }
                  ?>
               </table>
            </body>
         </html>
      ```
   3. Setelah selesai mengetikkan kode, maka akan muncul tampilan seperti ini :
      
      ![ImageDokumentasi7](https://github.com/bagoesihsant/E41181277_Praktikum_3/blob/master/img_dokumentasi/Screenshot_Dokumentasi_010.png)
   
   4. Fungsi dari **_$this->session->userdata('status') != 'login'_** adalah memeriksa apakah kita sudah terlogin atau belum, apabila belum terlogin maka akan muncul tampilan seperti pada nomor 3. Apabila sudah terlogin maka akan muncul tampilan :
      
      ![ImageDokumentasi8](https://github.com/bagoesihsant/E41181277_Praktikum_3/blob/master/img_dokumentasi/Screenshot_Dokumentasi_013.png)
   
   
