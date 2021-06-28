<?php

class tb_transportasi extends CI_Model
{
    public $table = 'tb_transportasi';

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
    public function get_transportasi($tujuan)
    {
        return $this->db->query("
            SELECT tb_transportasi.*, tb_daerah_lintasan.asal,tb_daerah_lintasan.tujuan
            FROM tb_transportasi 
            INNER JOIN tb_daerah_lintasan ON tb_daerah_lintasan.id_transportasi = tb_transportasi.id_transportasi
            WHERE tb_transportasi.id_transportasi IN (
                SELECT id_transportasi FROM tb_daerah_lintasan WHERE tujuan = '".$tujuan."'
            )
        ");
    }
    public function get_galeri_transportasi($where)
    {
        $this->db->where($where);
        return $this->db->get('tb_foto_transportasi');
    }
    public function get_data_daerah_lintasan($where)
    {
        $this->db->join('tb_daerah_lintasan','tb_daerah_lintasan.id_transportasi=tb_transportasi.id_transportasi');
        $this->db->where($where);
        $this->db->select('
                            tb_daerah_lintasan.asal,
                            tb_daerah_lintasan.tujuan,
                            tb_transportasi.*');
        return $this->db->get($this->table);
    }
}
