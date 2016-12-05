<?php
  class Questions extends CI_Model{
    public function _construct(){
      parent::_construct();
    }
    public function create($data = null){
      $this->db->set($data);
      $this->db->insert("exercicio");
    }
    public function getById(int $id){
        $this->db->where("id",$id);
        $query = $this->db->get("lista_de_exercicio");
        $data = $query->result_array();
        return $data;
    }

  }
?>
