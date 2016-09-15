<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Controller {
	public function index(){
		$this->load->view("Aluno/dashboard");
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
