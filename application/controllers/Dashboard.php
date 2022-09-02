<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		
		//$this->load->model('model_products');
		$this->load->model('model_orders');
		// $this->load->model('model_users');
		// $this->load->model('model_stores');
	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{


		//set variable to year formet
		$today_year = date('Y');

		//get user input if got
		if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}

		//get dataset from model
		$parking_data = $this->model_orders->countTotalOrder($today_year);
		$this->data['order_years'] = $this->model_orders->getOrderYear();
		//$sales_data = $this->model_orders->countTotalOrder();

		//initialize variable
		$final_parking_data = array();
		$final_parking_data1 = array();

		//modify data
		foreach ($parking_data as $k => $v) {
			
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['gross_amount'];	//problem from database					
					}
				}
				$final_parking_data[$k] = array_sum($total_amount_earned);	
			}
			else {
				$final_parking_data[$k] = 0;	
			}
			
		}

		foreach ($parking_data as $k => $v) {
			
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['net_amount'];	//problem from database					
					}
				}
				$final_parking_data1[$k] = array_sum($total_amount_earned);	
			}
			else {
				$final_parking_data1[$k] = 0;	
			}
			
		}

		//return user information
		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

		//prepare arranged dataset
		$this->data['selected_year'] = $today_year;
		$this->data['results'] = $final_parking_data;
		$this->data['results1'] = $final_parking_data1;
		$this->data['is_admin'] = $is_admin;

		//return dataset to view
		$this->render_template('dashboard', $this->data);
	}






}