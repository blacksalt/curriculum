<?php

class Admin extends MY_Controller
{
	function __construct()
	{
		parent::Controller();
		$user = $this->session->userdata('username');
		if (empty($user))
		{
            $this->session->set_flashdata('message','Invalid user, please sign in');
            redirect('gate');
		}
	}

	function index()
	{
        $this->render('admin/dashboard');
	}

    function change_password()
    {
        if ($this->input->post('change'))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('current','Current Password','required');
            $this->form_validation->set_rules('new','New Password','required');
            $this->form_validation->set_rules('confirm','Confirm Password','required|matches[new]');
            if( $this->form_validation->run() == TRUE )
            {
                $this->load->model('Admins_model');
                $user['username'] = $this->session->userdata('username');
                $user['current'] = $this->input->post('current');
                $user['new'] = $this->input->post('new');
                $return = $this->Admins_model->change_password( $user );
                if ( !empty($return) )
                {
                    $this->session->set_flashdata('message','Password changed. Please login with your new password.');
                    redirect('gate/logout');
                }
                else
                {
                    $this->session->set_flashdata('message','Wrong current password entered.');
                    redirect('admin/change_password');
                }
            }
        }
        
        $this->render('admin/change_password');
    }
}
