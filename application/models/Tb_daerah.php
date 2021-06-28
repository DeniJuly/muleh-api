<?php

class tb_daerah extends CI_Model
{
    public $table = 'tb_daerah';

    public function all()
    {
        return $this->db->get($this->table);
    }
    public function ins($data)
    {
        return $this->db->insert($this->table,$data);
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
    public function get_nama_daerah($where)
    {
        $this->db->where($where);
        $this->db->select('nama_daerah');
        return $this->db->get($this->table);
    }
}
