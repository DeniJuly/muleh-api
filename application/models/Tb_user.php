<?php

class tb_user extends CI_Model
{
    public $table = 'tb_user';

    public function ins($data)
    {
        return $this->db->insert($this->table,$data);
    }
    public function cek_user($email,$username)
    {
        $this->db->where('email',$email);
        $this->db->or_where('username',$username);
        return $this->db->get($this->table);
    }
    public function some($where)
    {
        $this->db->where($where);
        return $this->db->get($this->table);
    }
    public function get_data_user($where)
    {
        $this->db->join('tb_penumpang','tb_penumpang.id_user = tb_user.id_user');
        $this->db->where($where);
        $this->db->select('
                            tb_penumpang.nama_penumpang,
                            tb_penumpang.nomor_penumpang,
                            tb_penumpang.foto_penumpang,
                            tb_user.*');
        return $this->db->get($this->table);
    }
    public function get_data_transportasi($where)
    {
        $this->db->join('tb_transportasi','tb_transportasi.id_user = tb_user.id_user');
        $this->db->where($where);
        $this->db->select('
                            tb_transportasi.nama_transportasi,
                            tb_transportasi.nomor_transportasi,
                            tb_transportasi.foto_transportasi,
                            tb_user.*');
        return $this->db->get($this->table);
    }
}
