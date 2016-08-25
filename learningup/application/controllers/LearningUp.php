<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LearningUp extends CI_Controller {
	public function isLoged(){
		return $this->session->has_userdata('user') && $this->session->user->id != null;
	}
	public function checkLoged($redir = "LearningUp/login"){
		if(!$this->isLoged())
			redirect($redir);
		return true;
	}

	public function logout(){
		$this->load->model('mylog');
		$this->mylog->save("Usuário saiu", $this->session->user->id);
		$this->session->unset_userdata("user");
		$this->session->sess_destroy();
		redirect('LearningUp/login');
	}

	public function index($error = null){
		$this->checkLoged();
		redirect("LearningUp/main");
	}
	
	public function cadastro(){
		if($this->isLoged())
			redirect("LearningUp/main");

		$this->form_validation->set_error_delimiters('<li>', '</li>'); 

		//Executa a validação dos campos
		$this->form_validation->set_rules('nome', 'nome', 'trim|required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('sobrenome', 'sobrenome', 'trim|required|min_length[4]|max_length[45]');
		$this->form_validation->set_rules('dt_nascimento', 'data de nascimento', 'required');
		$this->form_validation->set_rules('sexo', 'sexo', 'required');
		$this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email|is_unique[user.email]', array('is_unique' => "Seu e-mail já está cadastrado em nosso sistema."));
		$this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('senha_conf', 'confirmação de senha', 'trim|required|matches[senha]');

		 if ($this->form_validation->run() == FALSE){
		 	//Caso não seja valido, volta ao formulario
            $this->load->view('registro');
        }else{
        	//Caso os valores sejam validos, cadastra no banco de dados.
        	$this->load->helper('date');
			$data = array(
				'email' => $this->input->post('email'),
				'nome' => $this->input->post('nome'),
				'sobrenome' => $this->input->post('sobrenome'),
				'dt_nascimento' => date("Y-m-d", strtotime($this->input->post('dt_nascimento'))),
				'sexo' => $this->input->post('sexo'),
				'senha' => md5($this->input->post('senha')),
				'dt_cadastro' => date('Y-m-d H:i:s'),
				'tipo' => 0
			);

			$this->load->model('user');
			$this->load->model('mylog');
			$id = $this->user->save($data);
			$this->mylog->save("Usuário cadastrado", $id);


			redirect('LearningUp/login');
        }
	}

	public function login(){
		if($this->isLoged())
			redirect("LearningUp/main");
		$this->form_validation->set_error_delimiters('<li>', '</li>'); 

		//Executa a validação dos campos
		$this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'senha', 'trim|required');
		
		 if ($this->form_validation->run() == FALSE){
		 	//Caso não seja valido, volta ao formulario
			$this->load->view('login');
        }else{
        	//Caso os valores sejam validos, verifica se existe.
			$this->load->model('user');
			$res = $this->user->select($this->input->post('email'), md5($this->input->post('senha')));
			if($res === null){
				$this->load->view('login', array('error' => "Usuário ou Senha inválidos"));
			}else{
				$this->load->model('mylog');
				$this->mylog->save("Usuário logou", $res->id);
				$this->session->set_userdata(array('user' => $res));
				redirect('LearningUp/main');
			}
        }
	}
	public function formClass(){
		$this->checkLoged();
		$this->load->view('formClass');
	}
	public function createClass(){
		$this->checkLoged();
		$this->load->view('formClass');
	}
	public function main(){
		$this->checkLoged();
        $this->load->view('main', $this->session->user);
	}
}
