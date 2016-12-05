<?php
  class Subject extends CI_Model{
    public function _construct(){
      parent::_construct();
    }
    public function create($data = null){
      $this->db->set($data);
      $this->db->insert("materia");
    }
    public function get(){
        $this->db->limit(20);
        $query = $this->db->get("materia");
        foreach($query->result_array() as $row){
          $data[] = $row;
        }
        return $data;
    }
    public function getById(int $id){
        $this->db->where("id",$id);
        $query = $this->db->get("lista_de_exercicio");
        $data = $query->result_array();
        return $data;
    }
  }
?>
