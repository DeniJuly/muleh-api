<?php

class tb_daerah_lintasan extends CI_Model
{
    public $table = 'tb_daerah_lintasan';

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
    public function upd($where,$data)
    {
        $this->db->where($where);
        return $this->db->update($this->table,$data);
    }
}
