<?php
defined('BASEPATH') OR exit('No Direct script access allowed');

class berita extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('berita_model');
        $this->load->library('session');
    }
    public function index(){
        $data['berita']=$this->berita_model->get_all_berita();
        $this->load->view('templates/header');
        $this->load->view('berita/index',$data);
        $this->load->view('templates/footer');
    }
    public function tambah(){
        $data['berita']=$this->berita_model->get_all_berita();
        $this->load->view('templates/header');
        $this->load->view('berita/form_berita',$data);
        $this->load->view('templates/footer');
    }
    public function insert(){
        $judul=$this->input->post('judul');
        $kategori=$this->input->post('kategori');
        $headline=$this->input->post('headline');
        $isi=$this->input->post('isi_berita');
        $pengirim=$this->input->post('pengirim');

        $data=array(
            'judul'=>$judul,
            'kategori'=>$kategori,
            'headline'=>$headline,
            'isi_berita'=>$isi,
            'pengirim'=>$pengirim
        );
        $result=$this->berita_model->insert_berita($data);
        if($result){
            $this->session->set_flashdata('succes','berita berhasil disimpan');
            redirect('berita');
        }else{
            $this->session->set_flashdata('error','berita gagal disimpan');
            redirect('berita');
        }
    }
}