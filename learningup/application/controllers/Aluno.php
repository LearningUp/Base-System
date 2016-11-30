<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Controller {
	public function index(){
		$this->load->view("Aluno/dashboard", array('option' => 'Home', 'userdate' => $this->session->user));
	}

	public function CancelarListaExercicios(){
		//ToDo: Apagar dados da lista de exercicios da session
	}

	public function RealizarExercicio(){
		//ToDo: Mostrar exercicios
		//Está no formato ID Exercicio/ID Lista << talvez seja interessante remover a lista
	}

	public function RealizarListaExercicios(){
		$this->load->model('ListaExercicio');
		$this->load->model('Exercicio');
		
		$listaID = ($this->uri->segment(3, 0)) ;

		if(isset($this->session->lista_exercicio)){
			$l = $this->session->lista_exercicio["exercicios"];
			$atual = $this->session->lista_exercicio['exercicio_atual'];
			if($atual >= 0){
				$atual = $l[$atual];
				redirect("Aluno/RealizarExercicio/".$atual['id']."/".$this->session->lista_exercicio['dados_lista']['id']);
			}

		}
		if(!isset($this->session->lista_exercicio) || $this->session->lista_exercicio['dados_lista']['id'] != $listaID){
			$lista_exercicio = $this->ListaExercicio->get($listaID);
			$exercicios = $this->Exercicio->get_titles($listaID, 10);

			$this->session->lista_exercicio = array('exercicios' => $exercicios, 'exercicio_atual' => -1, 'lista_ID' => $listaID, 'iniciou' => date("Y-m-d H:i:s"), 'dados_lista' => $lista_exercicio);

			$respostas = array();
			for($i = 0; $i < count($this->session->lista_exercicio['exercicios']); ++$i)
				$respostas[] = NULL;

			$this->session->respostas = $respostas;
		}

		$this->load->view("Aluno/listaExercicios", array('option' => 'BemVindo', 'userdate' => $this->session->user, 'lista_exercicio' => $this->session->lista_exercicio['dados_lista'], "outros_exercicios" => $this->session->lista_exercicio['exercicios'], "qntExercicios" => count($this->session->lista_exercicio['exercicios']), 'exercicio_atual' => $this->session->lista_exercicio['exercicio_atual']));
	}

	public function Simulados(){
		$this->load->library('pagination');
		$this->load->model('ListaExercicio');

		$config['base_url'] = site_url().'/Aluno/Simulados';
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
		$listas_exercicios = $this->ListaExercicio->get_list($config["per_page"], $page, 2);

		$this->load->view("Aluno/dashboard", array('option' => 'Simulados', 'userdate' => $this->session->user, 'listas_exercicios' => $listas_exercicios));
	}

	public function Exercicios(){
		$this->load->library('pagination');
		$this->load->model('ListaExercicio');

		$config['base_url'] = site_url().'/Aluno/Exercicios';
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
		$listas_exercicios = $this->ListaExercicio->get_list($config["per_page"], $page, 1);

		$this->load->view("Aluno/dashboard", array('option' => 'Exercicios', 'userdate' => $this->session->user, 'listas_exercicios' => $listas_exercicios));
	}


	public function Aulas(){
		$this->load->library('pagination');
		$this->load->model('Materia');
		$config = array();
		$config['base_url'] = site_url().'/Aluno/Aulas';
		$config['per_page'] = 4;

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

		$config['total_rows'] = count(40); // << Problemas

		$this->load->view("Aluno/dashboard", array('option' => 'Aulas', 'userdate' => $this->session->user, 'materias' => $materias));
	}

	public function Materia(){
		$this->load->library('pagination');
		$this->load->model('Conteudo');
		$this->load->model('Materia');

		$config['base_url'] = site_url().'/Aluno/Materia';
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

		$config['base_url'] = site_url().'/Aluno/Conteudo';
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
		/*	ToDO */
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
