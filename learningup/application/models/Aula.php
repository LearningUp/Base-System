<?php
  class Aula extends CI_Model{
    public function _construct(){
      parent::_construct();
    }

    function get_list($rows, $offset=null, $conteudo){
        $this->db->limit($rows, $offset);
        $this->db->from('aula');
        $this->db->where('conteudo_id', $conteudo);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }
  }
?>
