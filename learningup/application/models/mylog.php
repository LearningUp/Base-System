<?php 
class Mylog extends CI_Model {
	 public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    // get number of log in database
    function count(){
        return $this->db->count_all('log');
    }

    // get log by id
    function get_by_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('log');
        if($query->num_rows() == 1){
            $res = $query->result()[0];
            return $res;
        }
        return null;
    }

    function get_by_user($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('log');

        if($query->num_rows() == 0)
            return null;

        foreach ($query->result() as $row) {
            $data[]['id'] = $row['id'];
            $data[]['mensagem'] = $row['mensagem'];
            $data[]['time'] = $row['time'];
            $data[]['user_id'] = $row['user_id'];
        }

        return $data;
    }

    function get_list($rows, $offset=null, $user_id = null){
        $this->db->limit($rows, $offset);
        if(isset($user_id))
            $this->db->where('user_id', $user_id);
        $this->db->join('user', 'user.id = user_id');
        $this->db->from('log');
        $this->db->select('log.*, user.email');
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }

    function get_filtered_list($rows, $offset=null, $search){
        $this->db->limit($rows, $offset);
        $this->db->join('user', 'user.id = user_id');
        $this->db->from('log');
        $this->db->select('log.*, user.email');
        $this->db->or_like('user.email', $search);
        $this->db->or_like('mensagem', $search);
        $this->db->or_like('time', $search);
        $this->db->or_where('log.id = ',$search);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return null;

        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }

        return $data;
    }
    // add new log
    function save_obj($log){
        $this->db->insert('log', $log);
        return $this->db->insert_id();
    }

    function save($mensagem, $user_id = null, $time = null){
        $log  = array('mensagem' => $mensagem, 'user_id' => $user_id, 'time' => ($time == null ? date('Y-m-d H:i:s') : $time));
        $this->db->insert('log', $log);
        return $this->db->insert_id();
    }

    // delete log by id
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('log');
    }

    function delete_user($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->delete('log');
    }

    function deleteAll(){
        $this->db->empty_table('log');
    }
}

?>
