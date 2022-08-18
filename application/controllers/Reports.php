<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->data['page_title'] = 'Stores';
		$this->load->model('model_reports');
	}

	/* 
    * It redirects to the report page
    * and based on the year, all the orders data are fetch from the database.
    */
	public function index()
	{
		if(!in_array('viewReports', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		//set variable to year formet
		$today_year = date('Y');

		//get the user input if got
		if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}


		//get dataset with selected year from model
		$parking_data = $this->model_reports->getOrderData($today_year);
		$this->data['report_years'] = $this->model_reports->getOrderYear();
		
		//modify the filtered(year) data
		$final_parking_data = array();
		foreach ($parking_data as $k => $v) {
			
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['gross_amount'];						
					}
				}
				$final_parking_data[$k] = array_sum($total_amount_earned);	
			}
			else {
				$final_parking_data[$k] = 0;	
			}
			
		}

		//prepare the arranged dataset
		$this->data['selected_year'] = $today_year;
		$this->data['company_currency'] = $this->company_currency();
		$this->data['results'] = $final_parking_data;

		//return dataset to view
		$this->render_template('reports/index', $this->data);
	}
}	