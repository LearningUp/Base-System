<?php
/*
    TIPOS:
        0 - Ambos
        1 - Lista de Exercicio
        2 - Simulado 
*/
  class Exercicio extends CI_Model{
    public function _construct(){
      parent::_construct();
    }
    
    function qntExercicios($lista_id){
        $query = $this->db->select("count(*) qnt")->where("lista_de_exercicio_id", $lista_id)->from("lista_de_exercicio_has_exercicio")->get();

        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data[0];
    }
    
    function get($id){
        $this->db->from('exercicio')->where("id", $id);

        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        $data = $data[0];

        $query = $this->db->from('exercicio_opcao')->where("exercicio_id", $id)->get();
        $opcoes = array();

        foreach ($query->result_array() as $row) {
            $opcoes[] = $row;
        }

        $data['opcoes'] = $opcoes;


        return $data;
    }
    
    function get_titles($lista_id, $lenght = 4, $concat = "..."){
        $this->db->select("concat(substring(exercicio.titulo, 1, ".$lenght."), \"".$concat."\") titulo, id")->from('learningup_db.exercicio, lista_de_exercicio_has_exercicio')->where("lista_de_exercicio_has_exercicio.lista_de_exercicio_id", $lista_id)->where("lista_de_exercicio_has_exercicio.exercicio_id = exercicio.id");

        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

    function get_from($lista_id){
        $this->db->select("exercicio.*")->from('learningup_db.exercicio, lista_de_exercicio_has_exercicio')->where("lista_de_exercicio_has_exercicio.lista_de_exercicio_id", $lista_id)->where("lista_de_exercicio_has_exercicio.exercicio_id = exercicio.id");

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
