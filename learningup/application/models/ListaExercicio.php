<?php
/*
    TIPOS:
        0 - Ambos
        1 - Lista de Exercicio
        2 - Simulado 
*/
  class ListaExercicio extends CI_Model{
    public function _construct(){
      parent::_construct();
    }

    function get_list($rows, $offset=null, $tipo=null){
        $this->db->limit($rows, $offset);
        $this->db->from('lista_de_exercicio')->where("aberto", true);
        if(!is_null($tipo)){
            $this->db->where("tipo", $tipo)->or_where("tipo", 0);
        }

        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

    function get($id){
        $this->db->from('lista_de_exercicio')->where("id", $id);

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
