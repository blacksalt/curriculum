<?php

class Gate extends MY_Controller
{

	function __construct()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->render('gate/home');
	}

	function auth()
	{
	    $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');

	    if ( $this->form_validation->run() )
	    {
	        $this->load->model('Admins_model');
            $user['username'] = $this->input->post('username');
            $user['password'] = $this->input->post('password');

            // Admins_model->auth method returns an object on success and NULL on fail
            $authed = $this->Admins_model->auth($user);

            if ($authed != NULL)
            {
                $this->session->set_userdata('username',$authed->username);
                $this->session->set_userdata('id',$authed->id);
                redirect('admin/');
            }
        }
        $this->session->set_flashdata('message','Login failed, please check your username and/or password');
        redirect('gate/login');
	}

    function login()
    {
        $this->render('gate/login');
    }

	function logout()
	{
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id');
        $this->session->keep_flashdata('message');
        redirect('gate/login');
	}
}

/* End of file Gate.php */
/* Location: ./system/application/controllers/Gate.php */
