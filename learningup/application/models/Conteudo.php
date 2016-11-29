<?php
  class Conteudo extends CI_Model{
    public function _construct(){
      parent::_construct();
    }

    function get_list($rows, $offset=null, $materia){
        $this->db->limit($rows, $offset);
        $this->db->from('conteudo');
        $this->db->where('materia_id', $materia);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

    function get($conteudo){
        $this->db->from('conteudo')->where("id", $conteudo);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data[0];
    }
  }
?>
