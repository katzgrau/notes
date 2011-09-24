<?php 

class Help extends Controller
{
	function Help()
	{
		parent::Controller();
	}
	function index ()
	{
		$this->load->view('help/index');
	}
	
	function introduction( $tutorial_name )
	{
		$data['content'] = $this->load->view("help/tutorials/$tutorial_name", '', true);
		$this->load->view('help/tutorial', $data);
	}
	
	function edit( $tutorial_name )
	{
		$data['content'] = $this->load->view("help/tutorials/$tutorial_name", '', true);
		$this->load->view('help/tutorial', $data);
	}
	
	function site( $tutorial_name )
	{
		$data['content'] = $this->load->view("help/tutorials/$tutorial_name", '', true);
		$this->load->view('help/tutorial', $data);
	}
	
	function account( $tutorial_name )
	{
		$data['content'] = $this->load->view("help/tutorials/$tutorial_name", '', true);
		$this->load->view('help/tutorial', $data);
	}
	
	function video( $video_name )
	{
		$data['content'] = $this->load->view("help/videos/$video_name", '', true);
		$this->load->view('help/tutorial', $data);
	}
	
	function support()
	{
		if( ! $this->session->userdata('user_id') )
		{
			$this->load->helper('url');
			
			$this->session->set_flashdata('next', 'help/support');
			redirect('home/login');
			return;
		}
		else
		{
			$subject = $this->input->post('subject');
			$message = $this->input->post('message');
			
			if( $subject && $message )
			{
				$site_name = $this->session->userdata('site_name');
				
				$this->load->library('mailer');
				
				$this->mailer->SendSupportRequest( $site_name , $subject, $message );
				
				$this->load->view('help/support-ticket-sent');
				return;
			}
			elseif( $subject XOR $message )
			{
				$data['warning'] = "Please supply both a subject and a message.";
				$data['subject'] = $subject;
				$data['message'] = $message;
				$this->load->view('help/support', $data);
				return;
			}
			else
			{
				$this->load->view('help/support');
			}
		}
	}
}

?>