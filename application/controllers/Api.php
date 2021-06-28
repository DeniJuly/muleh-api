<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		echo md5("denijuli");
		$this->load->view('index');
	}

	public function get_data_user()
	{
		$w_user = array(
			'email'	=> $this->input->post('email'),
			'tb_user.id_user'=> $this->input->post('id_user')
		);
		$dat_user = $this->tb_user->get_data_user($w_user)->row();
		if($dat_user){
			$res = array(
				'error'		=> false,
				'id'		=> $dat_user->id_user,
				'nama'		=> $dat_user->nama_penumpang,
				'email'		=> $dat_user->email,
				'notelp'	=> $dat_user->nomor_penumpang,
				'imgProfile'		=> $dat_user->foto_penumpang
			);
		}else{
			$res = array(
				'error'	=> true,
				'message'=> 'gagal mendapatkan informasi user'
			);
		}
		echo json_encode($res);
	}
	public function get_data_transportasi()
	{
		$w_user = array(
			'email'	=> $this->input->post('email'),
			'tb_user.id_user'=> $this->input->post('id')
		);
		$dat_user = $this->tb_user->get_data_transportasi($w_user)->row();
		if($dat_user){
			$res = array(
				'error'		=> false,
				'id'		=> $dat_user->id_user,
				'nama'		=> $dat_user->nama_transportasi,
				'email'		=> $dat_user->email,
				'notelp'	=> $dat_user->nomor_transportasi,
				'foto_transportasi'	=> $dat_user->foto_transportasi
			);
		}else{
			$res = array(
				'error'	=> true,
				'message'=> 'gagal mendapatkan informasi user'
			);
		}
		echo json_encode($res);
	}

	public function masuk()
	{
		$data = array(
			'email'		=> $this->input->post('email'),
			'password'	=> md5($this->input->post('password'))
		);
		if($this->input->post('email')==''||$this->input->post('password')==''){
			$res = array(
				'error'	=> true,
				'message'	=> 'isi semua form'
			);
		}else{
			$masuk = $this->tb_user->some($data);
			if($masuk->num_rows() > 0){
				$data = $this->tb_user->get_data_user($data)->row();
				if($data){
					$res = array(
						'error'			=> false,
						'id'			=> $data->id_user,
						'nama'			=> $data->nama_penumpang,
						'email'			=> $data->email,
						'notelp'		=> $data->nomor_penumpang,
						'imgProfile'	=> $data->foto_penumpang
					);
				}else{
					$res = array(
						'error'	=> true,
						'message'	=> 'username atau password salah'
					);
				}
			}else{
				$res = array(
					'error'	=> true,
					'message'	=> 'username atau password salah'
				);
			}
		}
		
		echo json_encode($res);
	}

	public function masuk_driver()
	{
		if($this->input->post('email')==''||$this->input->post('password')==''){
			$res = array(
				'error'	=> true,
				'message'	=> 'isi semua form'
			);
		}else{
			$data = array(
				'email'		=> $this->input->post('email'),
				'password'	=> md5($this->input->post('password'))
			);
			$masuk = $this->tb_user->some($data);
			if($masuk->num_rows() > 0){
				$data = $this->tb_user->get_data_transportasi($data)->row();
				if($data){
					$res = array(
						'error'			=> false,
						'id'			=> $data->id_user,
						'nama'			=> $data->nama_transportasi,
						'email'			=> $data->email,
						'notelp'		=> $data->nomor_transportasi,
					);
				}else{
					$res = array(
						'error'	=> true,
						'message'	=> 'email atau password salah'
					);
				}
			}else{
				$res = array(
					'error'	=> true,
					'message'	=> 'email atau password salah'
				);
			}
		}
		
		echo json_encode($res);
	}

	public function daftar()
	{
		$nama 	= $this->input->post('nama');
		$email 	= $this->input->post('email');

		if($nama == '' || $email == ''){
			$res = array(
				'error'	=> true,
				'message'	=> 'isi semua form'
			);
		}else{
			$w_user	  = array(
				'email'	=> $this->input->post('email')
			);

			$cek_user = $this->tb_user->some($w_user)->num_rows();
			if($cek_user > 0){
				$res = array(
					'error'		=> true,
					'message'	=> 'email sudah terdaftar, coba dengan email lain'
				);
			}else{
				$data = array(
					'email'		=> $email,
					'password'	=> md5($this->input->post('password'))
				);
				$ins = $this->tb_user->ins($data);
				if($ins){
					$dat_user = $this->tb_user->some($data)->row();
					$dat_penumpang = array(
						'id_user'			=> $dat_user->id_user,
						'nama_penumpang'	=> $nama
					);
					$ins_penumpang = $this->tb_penumpang->ins($dat_penumpang);
					if($ins_penumpang){
						$res = array(
							'error'		=> false,
							'message'	=> 'berhasil daftar'
						);
					}else{
						$res = array(
							'error'		=> true,
							'message'	=> 'gagal daftar'
						);
					}
				}else{
					$res = array(
						'error'		=> true,
						'message'	=> 'gagal daftar'
					);
				}
			}
		}
		echo json_encode($res);
	}

	public function daftar_driver()
	{
		$nama 	= $this->input->post('nama');
		$email 	= $this->input->post('email');
		$pass   = md5($this->input->post('password'));

		if($nama == '' || $email == ''){
			$res = array(
				'error'	=> true,
				'message'	=> 'isi semua form'
			);
		}else{
			$w_user	  = array(
				'email'	=> $this->input->post('email')
			);

			$cek_user = $this->tb_user->some($w_user)->num_rows();
			if($cek_user > 0){
				$res = array(
					'error'		=> true,
					'message'	=> 'email sudah terdaftar, coba dengan email lain'
				);
			}else{
				$data = array(
					'email'		=> $email,
					'password'	=> $pass
				);

				$ins = $this->tb_user->ins($data);
				if($ins){
					$dat_user = $this->tb_user->some($data)->row();
					$dat_transportasi = array(
						'id_user'			=> $dat_user->id_user,
						'nama_transportasi'	=> $nama
					);
					$ins_penumpang = $this->tb_transportasi->ins($dat_transportasi);
					if($ins_penumpang){
						$res = array(
							'error'		=> false,
							'message'	=> 'berhasil daftar'
						);
					}else{
						$res = array(
							'error'		=> true,
							'message'	=> 'gagal daftar'
						);
					}
				}else{
					$res = array(
						'error'		=> true,
						'message'	=> 'gagal daftar'
					);
				}
			}
		}
		echo json_encode($res);
	}

	public function ubah_data_user()
	{
		$w_user = array(
			'id_user'	=> $this->input->post('id_user')
		);
		$dat_user = array(
			'nama_penumpang'	=> $this->input->post('nama'),
			'nomor_penumpang'	=> $this->input->post('nomor')
		);
		$upd_user = $this->tb_penumpang->upd($w_user,$dat_user);
		if($upd_user){
			$res = array(
				'error'		=> false,
				'message'	=> 'berhasil menyimpan data user'
			);
		}else{
			$res = array(
				'error'		=> true,
				'message'	=> 'gagal menyimpan data user'
			);
		}
		echo json_encode($res);
	}

	public function edit_data_transportasi()
	{
		$w_user = array(
			'id_user'	=> $this->input->post('id')
		);
		$dat_user = array(
			'nama_transportasi'	=> $this->input->post('nama'),
			'nomor_transportasi'=> $this->input->post('nomor')
		);
		$upd_user = $this->tb_transportasi->upd($w_user,$dat_user);
		if($upd_user){
			$res = array(
				'error'		=> false,
				'message'	=> 'berhasil menyimpan data user'
			);
		}else{
			$res = array(
				'error'		=> true,
				'message'	=> 'gagal menyimpan data user'
			);
		}
		echo json_encode($res);
	}

	public function get_daerah()
	{
		$data = $this->tb_daerah->all()->result();
		if($data){
			$res = array(
				'error'	=> false,
				'data'	=> $data
			);
		}else{
			$res = array(
				'error'	=> true,
				'message'	=> 'gagal mengambil data daerah'
			);
		}
		echo json_encode($res);
	}

	public function get_transportasi()
	{
		$w_tujuan 	= array('nama_daerah'=>$this->input->post('tujuan'));
		$dat_daerah = $this->tb_daerah->some($w_tujuan)->row();
		if($dat_daerah){
			$tujuan = $dat_daerah->id_daerah;
			$dat_transportasi = $this->tb_transportasi->get_transportasi($tujuan)->result();
			for ($i=0; $i < count($dat_transportasi); $i++) { 
				$w_daerah_tujuan =  array('id_daerah'=>$dat_transportasi[$i]->tujuan);
				$w_daerah_asal   =  array('id_daerah'=>$dat_transportasi[$i]->asal);
				$dat_transportasi[$i]->asal   = $this->tb_daerah->get_nama_daerah($w_daerah_asal)->row()->nama_daerah;
				$dat_transportasi[$i]->tujuan = $this->tb_daerah->get_nama_daerah($w_daerah_tujuan)->row()->nama_daerah;
			}
			if($dat_transportasi){
				$res = array(
					'error'		=> false,
					'data'		=> $dat_transportasi
				);
			}else{
				$res = array(
					'error'		=> true,
					'message'	=> 'transportasi tidak ditemukan'
				);
			}
		}else{
			$res = array(
				'error'		=> true,
				'message'	=> 'tujuan tidak ditemukan'
			);
		}
		echo json_encode($res);
	}
	public function get_galeri_transportasi()
	{
		$w_transportasi = array('id_transportasi'=>$this->input->post('id'));
		$data = $this->tb_transportasi->get_galeri_transportasi($w_transportasi)->result();
		if(count($data)){
			$res = array(
				'error'		=> false,
				'data'		=> $data
			);
		}else{
			$res = array(
				'error'		=> true,
				'message'	=> 'foto tidak tersedia'
			);
		}
		echo json_encode($res);
	}
	public function upload_foto_penumpang()
	{
		$dir = 'asset/foto-penumpang/';
		$img = $this->input->post('image');
		$id  = $this->input->post('id');
		$w_penumpang = array(
			'id_user'	=> $id
		);
		$get_penumpang = $this->tb_penumpang->some($w_penumpang)->row();
		if($get_penumpang){
			$filename = $get_penumpang->id_penumpang."_".time().".jpg";
			
			if($get_penumpang->foto_penumpang != 'default.png'){
				unlink($dir.$get_penumpang->foto_penumpang);
			}
			$dir = $dir.$filename;
			if(file_put_contents($dir, base64_decode($img))){
				$dat_penumpang = array(
					'foto_penumpang'	=> $filename
				);
				$this->tb_penumpang->upd($w_penumpang,$dat_penumpang);
				$res = array(
					'error'		=> false,
					'message'		=> 'berhasil ubah foto profile'
				);
			}else{
				$res = array(
					'error'		=> true,
					'message'	=> 'gagal ubah foto profile'
				);
			}
		}else{
			$res = array(
				'error'		=> true,
				'message'	=> 'user tidak ditemukan'
			);
		}
		echo json_encode($res);
	}

	public function edit_foto_transportasi()
	{
		$dir = 'asset/foto-transportasi/';
		$img = $this->input->post('image');
		$id  = $this->input->post('id');

		$w_transportasi = array(
			'id_user'	=> $id
		);
		$get_transportasi = $this->tb_transportasi->some($w_transportasi)->row();

		if($get_transportasi){
			$filename = $get_transportasi->id_transportasi."_".time().".jpg";
			
			if($get_transportasi->foto_transportasi != 'default.png'){
				unlink($dir.$get_transportasi->foto_transportasi);
			}
			$dir = $dir.$filename;
			if(file_put_contents($dir, base64_decode($img))){
				$dat_transportasi = array(
					'foto_transportasi'	=> $filename
				);
				$this->tb_transportasi->upd($w_transportasi,$dat_transportasi);
				$res = array(
					'error'		=> false,
					'message'		=> 'berhasil ubah foto profile'
				);
			}else{
				$res = array(
					'error'		=> true,
					'message'	=> 'gagal ubah foto profile'
				);
			}
		}else{
			$res = array(
				'error'		=> true,
				'message'	=> 'user tidak ditemukan'
			);
		}
		echo json_encode($res);
	}

	public function edit_status_transportasi()
	{
		$w_transportasi = array(
			'id_user'	=> $this->input->post('id')
		);
		$dat_transportasi = array(
			'status_transportasi'	=> $this->input->post('status')
		);
		$upd_transportasi = $this->tb_transportasi->upd($w_transportasi,$dat_transportasi);
		if($upd_transportasi){
			$res = array(
				'error'	=> false,
				'message'	=> 'berhasil edit status'
			);
		}else{
			$res = array(
				'error'	=> true,
				'message'	=> 'gagal edit status'
			);
		}
		echo json_encode($res);
	}
	
	public function get_data_daerah_lintasan()
	{
		$w_transportasi = array(
			'id_user'	=> $this->input->post('id')
		);
		$get_transportasi = $this->tb_transportasi->get_data_daerah_lintasan($w_transportasi);
		if($get_transportasi->num_rows() > 0){
			$dat_transportasi = $get_transportasi->result();
			$res = array(
				'error'	=> false,
				'data'	=> $dat_transportasi
			);
		}else{
			$res = array(
				'error'	=> true,
				'message'=>'gagal mendapatkan data'
			);
		}
		echo json_encode($res);
	}

	public function edit_daerah_lintasan()
	{
		$w_transportasi = array(
			'id_user'	=> $this->input->post('id')
		);
		$get_transportasi = $this->tb_transportasi->some($w_transportasi);
		if($get_transportasi->num_rows()>0){
			$dat_transportasi = $get_transportasi->row();
			$id_transportasi  = $dat_transportasi->id_transportasi;
			$w_daerah_lintasan = array(
				'id_transportasi'	=> $id_transportasi
			);
			$dat_daerah_lintasan = array(
				'asal'	=> 0,
				'tujuan'=> 0
			);

			$get_asal = $this->tb_daerah->some(['nama_daerah'=>$this->input->post('asal')])->row();
			$dat_daerah_lintasan['asal']   = $get_asal->id_daerah;

			$get_tujuan = $this->tb_daerah->some(['nama_daerah'=>$this->input->post('tujuan')])->row();
			$dat_daerah_lintasan['tujuan'] = $get_tujuan->id_daerah;

			$cek_daerah_lintasan = $this->tb_daerah_lintasan->some($w_daerah_lintasan)->num_rows();
			if($cek_daerah_lintasan >0){
				$upd_daerah_lintasan = $this->tb_daerah_lintasan->upd($w_daerah_lintasan,$dat_daerah_lintasan);
				if($upd_daerah_lintasan){
					$res = array(
						'error'	=> false,
						'message'=> 'berhasil edit daerah lintasan'
					);
				}else{
					$res = array(
						'error'	=> false,
						'message'=> 'gagal edit daerah lintasan'
					);
				}
			}else{
				$dat_daerah_lintasan['id_transportasi'] = $id_transportasi;
				$ins_daerah_lintasan = $this->tb_daerah_lintasan->ins($dat_daerah_lintasan);
				if($ins_daerah_lintasan){
					$res = array(
						'error'	=> false,
						'message'=> 'berhasil edit daerah lintasan'
					);
				}else{
					$res = array(
						'error'	=> false,
						'message'=> 'gagal edit daerah lintasan'
					);
				}
			}
		}else{
			$res = array(
				'error'	=> false,
				'message'=> 'gagal edit daerah lintasan'
			);
		}
		echo json_encode($res);
	}
}
