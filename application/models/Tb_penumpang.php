<?php

class tb_penumpang extends CI_Model
{
    public $table = 'tb_penumpang';

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
