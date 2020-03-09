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
