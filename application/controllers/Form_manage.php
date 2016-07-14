<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_manage extends CI_Controller {

	    function __construct() {
        parent::__construct();

        $this->load->model('FormManageModel');
		$this->load->model('UserFunctionsModel');
		$this->load->model('mastermodel');
		$this->load->helper('encryption');
    }


	public function form_generate($function_allot_id='') {
		$postdata = $this->mastermodel->get_post_values();
		if($function_allot_id == '')
			$function_allot_id = isset($postdata['function_allot_id'])?$postdata['function_allot_id']:'';
		if(!isset($_SESSION['userid']) || $_SESSION['user_type']!=2 || $function_allot_id == '')
			{
				redirect('event_app/my_home');
			}

		$data['msg'] = '';
		/**functions for menu**/
		$functions = $this->UserFunctionsModel->get_my_functions($_SESSION['userid']);
			$data['myfunctions'] = array();
			if(!empty($functions))
			{
				$funs = explode(',',$functions->function_ids);
				foreach($funs as $fn)
				{
					if($fn !='')
						$data['myfunctions'][] = $this->mastermodel->get_data_srow('functions',$fn,'function_id','true');
				}
			}
		/***/
		/**on submit**/
		
		if(isset($postdata['function_allot_id']) && $postdata['function_allot_id']!='')
		{
			$function_allot_id_post = decrypt($postdata['function_allot_id']);
			/**file upload***/
			if (isset($_FILES) && !empty($_FILES)) {
				foreach($_FILES as $key =>$_FILE)
				{
				if($_FILE["name"]!='')
				{
				$file_name = $this->mastermodel->generateRandomString();
				$uploaded_file = pathinfo($_FILE["name"]);
				$extension = $uploaded_file['extension'];
				$image_file = $file_name.'_'.$_FILE['name'];

				
					$_FILE['name'] = $image_file;

					if (!is_file("./uploads/user_images/" . $_FILE["name"])) {
						move_uploaded_file($_FILE["tmp_name"], "./uploads/user_images/" . $_FILE["name"]);
						$postdata[$key] = $_FILE["name"];
					} else {
						$postdata[$key] = '';
					}
				}
				else
					{/**get previous value of image**/
					$result = $this->FormManageModel->get_field_value($function_allot_id_post,$key);
					if(!empty($result))
						$postdata[$key]=$result->value;
					else
						$postdata[$key] = '';
					}
				}
			}			
			/***/

			/**insert form fields**/
			$fields = $this->FormManageModel->get_form_fields($function_allot_id_post,$_SESSION['userid']);
			$result = $this->FormManageModel->insert_form_values($function_allot_id_post,$fields,$postdata,$_SESSION['userid']);
			if($result)
				{
					$data['msg'] = 'Values Modified';
					$data['class'] = 'success';
				}
		}
		/***/
		/**get form fields**/
		$function_allot_id_d = decrypt($function_allot_id);
		$data['function_details'] = $this->FormManageModel->get_function_details($function_allot_id_d);
		$fields = $this->FormManageModel->get_form_fields($function_allot_id_d,$_SESSION['userid']);
		$i=0;
		foreach($fields as $field)
		{
			$value='';
			$result = $this->FormManageModel->get_field_value($function_allot_id_d,$field['function_field_id']);
			if(!empty($result))
			$value=$result->value;
			$data['op_fields'][$i]['field'] = $this->FormManageModel->get_input_fields($field,$value);
			$data['op_fields'][$i]['title'] = $field['name'];
			$data['op_fields'][$i]['required'] = $field['required'];
			$i++;
		} 
		$data['function_allot_id'] = $function_allot_id;
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Form";
		$this->load->view('user/forms/view', $data);
    }
	
}
