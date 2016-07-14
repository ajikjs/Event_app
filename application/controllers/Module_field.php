<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class module_field extends CI_Controller {

	    function __construct() {
        parent::__construct();

		$this->load->model('ModuleFieldModel');
		$this->load->model('mastermodel');
		$this->load->helper('encryption');
    }

	public function get_fields()
	{
		$fields=$this->ModuleFieldModel->get_fields();
		print_r($fields);
	}

	public function add_fields($function_id='')
	{
		$postdata = $this->mastermodel->get_post_values();
		$function_id = (isset($function_id) && $function_id!='') ? decrypt($function_id): ''; 
		if($function_id == '')
			$function_id = isset($postdata['function_id'])?$postdata['function_id']:'';
			
		if(!isset($_SESSION['userid']) || $function_id == '' || $_SESSION['userid']!=1)
			{
				redirect('event_app/home_admin');
			}
		
		$data['msg'] = '';
			
			if(isset($postdata['function_id']) && decrypt($postdata['function_id']) !='')
			{
				$function_id = decrypt($postdata['function_id']);
				$result = $this->ModuleFieldModel->modify_function_fields($postdata,$function_id);
				if($result)
				{
					$data['msg'] = 'Function Fields Modified';
					$data['class'] = 'success';
				}
				else
				{
					$data['msg'] = 'Function already Exists';
					$data['class'] = 'danger';
				}
			}
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Functions";
		$data['fields']=$this->ModuleFieldModel->get_fields();
		$data['function'] = $this->mastermodel->get_data_srow('functions',$function_id,'function_id','true');
		$data['function_fields'] = $this->ModuleFieldModel->get_function_fields($function_id);
		if(empty($data['function']))
			redirect('event_app/home_admin');
		else
			$this->load->view('admin/function_fields/add_fields', $data);
	}
	public function add_row()
	{
			$fields=$this->ModuleFieldModel->get_fields();
			echo '<tr class="t_rw" id="t_rw">
                        <td><input type="text" name="name[]" class="form-control nm" placeholder="Type name..." required=""></td> 
						<td><select name="function_fields[]" id="type" class="select2 sl" required placeholder="Choose One" onchange="get_options(this.id)">
					 <option value="">Select Field</option>';		
					 foreach($fields as $field)
						{		      
					  echo '<option value="'.$field['field_type_id'].'">'.$field['field_name'].'</option>';   
						}
                    echo '</select>
						<input type="text" name="options[]" class="form-control opt" placeholder="Type options by coma seperated..." required="">
						</td>
						<td><input type="text" name="order[]" class="form-control" placeholder="Type Order..." required=""></td>
						<td><div class="ckbox ckbox-primary">
                      <input type="checkbox" name="required[]" value="1" class="t_chkk" id="t_chkk">
                      <label class="t_chk_lbl" for="t_chkk"></label>
                   </div></td>
						<td><div class="ckbox ckbox-success">
                      <input type="checkbox" name="status[]" checked value="1" class="t_chkk1" id="t_chkk1">
                      <label class="t_chk1_lbl" for="t_chkk1"></label>
                   </div></td>
						<td>
						<input type="hidden" class="fid" name="function_field_id[]" value="">
						<button type="button" class="btn btn-danger rw_rmv" onclick="remove_rw(this.id)">Delete</button></td>   
					</tr>'; 
	
	}

}

