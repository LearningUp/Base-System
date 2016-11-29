<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Controller {
	public function index(){
		$this->load->view("Aluno/dashboard", array('option' => 'Home', 'userdate' => $this->session->user));
	}

	public function Aulas(){
		$this->load->library('pagination');
		$this->load->model('Materia');

		$config['base_url'] = 'http://127.0.0.1/index.php/Aluno/Aulas';
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
		
		$page = ($this->uri->segment(3, 0)) ;
		$materias = $this->Materia->get_list($config["per_page"], $page);

		$this->load->view("Aluno/dashboard", array('option' => 'Aulas', 'userdate' => $this->session->user, 'materias' => $materias));
	}

	public function Materia(){
		$this->load->library('pagination');
		$this->load->model('Conteudo');
		$this->load->model('Materia');

		$config['base_url'] = 'http://127.0.0.1/index.php/Aluno/Materia';
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
		
		$page = ($this->uri->segment(4, 0)) ;
		$materiaID = ($this->uri->segment(3, 0)) ;

		$materia = $this->Materia->get($materiaID);
		$conteudos = $this->Conteudo->get_list($config["per_page"], $page, $materiaID);
		$this->load->view("Aluno/dashboard", array('option' => 'Materia', 'userdate' => $this->session->user, 'materia' => $materia, 'conteudos' => $conteudos));
	}

	public function Conteudo(){
		$this->load->library('pagination');
		$this->load->model('Conteudo');
		$this->load->model('Materia');
		$this->load->model('Aula');

		$config['base_url'] = 'http://127.0.0.1/index.php/Aluno/Materia';
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
		
		$page = ($this->uri->segment(4, 0)) ;
		$conteudoID = ($this->uri->segment(3, 0)) ;

		$conteudo = $this->Conteudo->get($conteudoID);
		$aulas = $this->Aula->get_list($config["per_page"], $page, $conteudoID);
		$this->load->view("Aluno/dashboard", array('option' => 'Conteudo', 'userdate' => $this->session->user, 'conteudo' => $conteudo, 'aulas' => $aulas));
	}

	public function AssistindoAula(){
		$this->load->library('pagination');
		$this->load->model('Conteudo');
		$this->load->model('Materia');
		$this->load->model('Aula');

		$config['base_url'] = 'http://127.0.0.1/index.php/Aluno/Materia';
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
		
		$page = ($this->uri->segment(4, 0)) ;
		$conteudoID = ($this->uri->segment(3, 0)) ;

		$conteudo = $this->Conteudo->get($conteudoID);
		$aulas = $this->Aula->get_list($config["per_page"], $page, $conteudoID);
		$this->load->view("Aluno/assistirAula", array('option' => 'Conteudo', 'userdate' => $this->session->user, 'conteudo' => $conteudo, 'aulas' => $aulas));
	}

	public function Simulados(){
		$this->load->view("Aluno/dashboard", array('option' => 'Simulados', 'userdate' => $this->session->user));
	}

	public function Exercicios(){
		$this->load->view("Aluno/dashboard", array('option' => 'Exercicios', 'userdate' => $this->session->user));
	}

	public function Grupos(){
		$this->load->view("Aluno/dashboard", array('option' => 'Grupos', 'userdate' => $this->session->user));
	}

	public function Opcoes(){
		$this->load->view("Aluno/dashboard", array('option' => 'Opcoes', 'userdate' => $this->session->user));
	}



	public function startSimulate(){
		$this->load->view("Simulate/simulateAwser");
	}
	public function formQuestion(){
		$this->load->view("Aluno/FormQuestion");
	}
	public function createQuestion(){
		$this->load->library("form_validation");
		$this->load->model("Questions");
		$regras = array(
			array(
				'field' => 'nome',
				'label' => 'Nome',
				'rules' => 'required'
			),
			array(
				'field' => 'titulo',
				'label' => 'titulo',
				'rules' => 'required'
			),
			array(
				'field' => 'texto',
				'label' => 'texto',
				'rules' => 'required'
			),
			array(
				'field' => 'fonte',
				'label' => 'fonte',
				'rules' => 'required'
			),
			array(
				'field' => 'tag',
				'label' => 'tag',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($regras);
		if($this->form_validation->run() != false){
			echo "error";
		}else{
			$dados = $arrayName = array(
				'fonte' => $this->input->post('fonte'),
				'titulo' => $this->input->post('titulo'),
				'texto' => $this->input->post('texto'),
				'tag' => $this->input->post('tag')
			);
			$this->Questions->create($dados);
		}
	}
}
