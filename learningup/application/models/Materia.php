<?php
  class Materia extends CI_Model{
    public function _construct(){
      parent::_construct();
    }

    function get_list($rows, $offset=null){
        $this->db->limit($rows, $offset);
        $this->db->from('materia');
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

    function get($materia){
        $this->db->from('materia')->where("id", $materia);
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
