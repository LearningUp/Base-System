<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index(){
		$this->load->view("admin/admin");
	}

	public function logs(){
		$this->load->library('pagination');
		$this->load->model('mylog');

		$config['base_url'] = 'http://127.0.0.1/learningup/index.php/Admin/logs';
		$config['per_page'] = 20;

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['next_tag_open'] = '<li class="waves-effect">';
		$config['next_link'] = '<i class="material-icons">chevron_right</i>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="waves-effect">';
		$config['prev_link'] = '<i class="material-icons">chevron_left</i>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';
		$config['reuse_query_string'] = TRUE;

		$this->pagination->initialize($config);
		
		if($this->uri->segment(3) == "search"){
			$page = ($this->uri->segment(4, 0)) ;
			$logList = $this->mylog->get_filtered_list($config["per_page"], $page, $this->input->get('search_bar'));
		}else{
			$page = ($this->uri->segment(3, 0)) ;
			$logList = $this->mylog->get_list($config["per_page"], $page);
		}
		$config['total_rows'] = count($logList);

		//$logs = $this->log->
		$this->load->view("admin/admin", array('option' => 'logs', 'logs' => $logList));
	}

	public function apagarLog($id, $base){
			$this->load->model('mylog');
			$this->mylog->delete($id);
			$segs = $this->uri->segment_array();

			$foundStart = false;
			$redir = "";
			foreach ($segs as $segment)
			{
				if($foundStart)
					$redir .= $segment . "/";
				if($segment == $id)
					$foundStart = true;
			}
			redirect($redir);
	}

	public function apagarLogs(){
		$this->load->model('mylog');
		$this->mylog->deleteAll();
		redirect('Admin/logs');
	}

	public function users($type='', $id = null){
		$this->load->library('pagination');
		$this->load->model('user');

		if(($this->uri->segment(3) == "view" || $type == "view") && ($this->uri->segment(4, -1) != -1 || $id != null)){
			$user = $this->user->get_by_id($this->uri->segment(4, $id));
			$this->load->view("admin/admin", array('option' => 'userView', 'user' => $user));
			return;
		}

		$config['base_url'] = 'http://127.0.0.1/learningup/index.php/Admin/users';
		$config['per_page'] = 20;

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['next_tag_open'] = '<li class="waves-effect">';
		$config['next_link'] = '<i class="material-icons">chevron_right</i>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="waves-effect">';
		$config['prev_link'] = '<i class="material-icons">chevron_left</i>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';
		$config['reuse_query_string'] = TRUE;

		$this->pagination->initialize($config);
		
		if($this->uri->segment(3) == "search"){
			$page = ($this->uri->segment(4, 0));
			$userList = $this->user->get_filtered_list($config["per_page"], $page, $this->input->get('search_bar'));
		}else{
			$page = ($this->uri->segment(3, 0)) ;
			$userList = $this->user->get_list($config["per_page"], $page);
		}
		$config['total_rows'] = count ($userList);

		$this->load->view("admin/admin", array('option' => 'users', 'users' => $userList));
	}

	public function updateUser(){
		$this->form_validation->set_error_delimiters('<li>', '</li>'); 
		$this->load->model('user');
		
		//Executa a validação dos campos
		$this->form_validation->set_rules('nome', 'nome', 'trim|required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('sobrenome', 'sobrenome', 'trim|required|min_length[4]|max_length[45]');
		$this->form_validation->set_rules('dt_nascimento', 'data de nascimento', 'required');
		$this->form_validation->set_rules('sexo', 'sexo', 'required');
		$this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('tipo', 'tipo', 'trim|required|is_natural');

		 if ($this->form_validation->run() == FALSE){
		 	//Caso não seja valido, volta ao formulario
		 	$this->users('view', $this->input->post('id'));
		 	return;
		 }
		$data = array(
			'email' => $this->input->post('email'),
			'nome' => $this->input->post('nome'),
			'sobrenome' => $this->input->post('sobrenome'),
			'dt_nascimento' => date("Y-m-d", strtotime($this->input->post('dt_nascimento'))),
			'sexo' => $this->input->post('sexo'),
			'senha' => md5($this->input->post('senha')),
			'tipo' => $this->input->post('tipo')
		);

		$this->user->update($this->input->post('id'), $data);
		redirect('Admin/users/view/'.$this->input->post('id'));
	}

	public function apagarUser(){
		if($this->uri->segment(3, -1) != -1){
			$this->load->model('user');
			$this->load->model('mylog');
			
			$this->mylog->delete_user($this->uri->segment(3));
			$this->user->delete($this->uri->segment(3));
		}
		redirect('Admin/users');
	}
}
?>