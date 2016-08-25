<?php 
class User extends CI_Model {
	 public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

    // get number of Users in database
    function count_all(){
        return $this->db->count_all('user');
    }

    // get User by id
    function get_by_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('user');
        if($query->num_rows() == 1){
            $res = $query->result_array()[0];
            $res['senha'] = "CRIPTOGRAFADA";
            return $res;
        }
        return null;
    }

    // add new User
    function save($user){
        $this->db->insert('user', $user);
        return $this->db->insert_id();
    }

    // update User by id
    function update($id, $user){
        $this->db->where('id', $id);
        $this->db->update('user', $user);
    }

    // delete User by id
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    function select($email, $senha){
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            $res = $query->result()[0];
            $res->senha = "CRIPTOGRAFADA";
            return $res;
        }
        return null;
    }

    function get_list($rows, $offset=null){
        $this->db->limit($rows, $offset);
        $this->db->from('user');
        $this->db->select('id, email, nome, sobrenome, dt_nascimento, dt_cadastro, tipo, sexo, foto');
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }
    function get_filtered_list($rows, $offset, $search){
        $this->db->limit($rows, $offset);
        $this->db->from('user');
        $this->db->select('id, email, nome, sobrenome, dt_nascimento, dt_cadastro, tipo, sexo, foto');
        $this->db->or_like('email', $search);
        $this->db->or_like('nome', $search);
        $this->db->or_like('sobrenome', $search);
        $this->db->or_like('sexo', $search);
        if(intval($search) != 0){
            $this->db->or_where('tipo =', $search);
            $this->db->or_where('id = ',$search);
        }   
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
