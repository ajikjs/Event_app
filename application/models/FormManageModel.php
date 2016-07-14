<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FormManageModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		$this->load->model('mastermodel');
    }

	
	function get_form_fields($function_allot_id,$user_id) {
			$content = array();
			$query = $this->db->query("select ff.*,ft.field_name from functions_allot fa left join function_fields ff on(fa.function_id=ff.function_id) left join field_types ft on(ff.field_type_id=ft.field_type_id) where fa.function_allot_id=".$this->db->escape($function_allot_id)." and ff.status = '1' and fa.user_id = '".$user_id."' order by ff.field_order ");
			foreach ($query->result_array() as $row)
						{
						$content[] = $row;
						}
			return $content;
    }	
	function insert_form_values($function_allot_id,$fields,$postdata,$user_id) {
			//$query = $this->db->query("delete from field_values where function_allot_id = '".$function_allot_id."'");
			foreach($fields as $field)
			{
			$query = $this->db->query("select field_value_id from field_values where function_allot_id = '".$function_allot_id."' and function_field_id = '".$field['function_field_id']."'");
			if(!empty($postdata[$field['function_field_id']]))
			{
				if(is_array($this->db->escape($postdata[$field['function_field_id']])))
				{
					$value = implode(',',$postdata[$field['function_field_id']]);
					$value = $this->db->escape($value);
				}
				else
					$value = $this->db->escape($postdata[$field['function_field_id']]);
			}
			else
				$value = "''";
			if(!empty($query->row()))
			{
				$query = $this->db->query("update field_values set function_allot_id = '".$function_allot_id."', function_field_id = '".$field['function_field_id']."', value=".$value." where function_allot_id = '".$function_allot_id."' and function_field_id = '".$field['function_field_id']."'");
			}
			else
			{
				$query = $this->db->query("insert into  field_values set function_allot_id = '".$function_allot_id."', function_field_id = '".$field['function_field_id']."', value=".$value."");
			}
			}
			
			return 1;
    }
	function get_field_value($function_allot_id,$function_field_id) {
			$query = $this->db->query("select value from field_values where function_allot_id = '".$function_allot_id."' and function_field_id = '".$function_field_id."'");
			return $query->row();
    }
	function get_function_details($function_allot_id)
	{
			$query = $this->db->query("select f.function_name from functions_allot fa left join functions f on (fa.function_id=f.function_id) where fa.function_allot_id = '".$function_allot_id."'");
			return $query->row();
	}
	function get_input_fields($array,$value)
	{
			switch ($array['field_name']) {
			  case "textbox":
				return $this->textbox($array['name'], $array['required'],$array['function_field_id'],$value);
				break;
			  case "dropdown":
				return $this->dropdown($array['name'], $array['required'],$array['function_field_id'],$value,$array['options']);
				break;
			  case "radio":
				return $this->radio($array['name'], $array['required'],$array['function_field_id'],$value,$array['options']);
				break;
			  case "file":
				return $this->file($array['name'], $array['required'],$array['function_field_id'],$value,$array['options']);
				break;
			  case "textarea":
				return $this->textarea($array['name'], $array['required'],$array['function_field_id'],$value);
				break;
			  case "checkbox":
				return $this->checkbox($array['name'], $array['required'],$array['function_field_id'],$value,$array['options']);
				break;
			  case "multiselect":
				return $this->multiselect($array['name'], $array['required'],$array['function_field_id'],$value,$array['options']);
				break;
			  case "date":
				return $this->date($array['name'], $array['required'],$array['function_field_id'],$value,$array['options']);
				break;
			  case "time":
				return $this->time($array['name'], $array['required'],$array['function_field_id'],$value,$array['options']);
				break;
			}
	}

	function textbox($name="", $required="", $id,$value) {
			$req = '';
			if($required == 1)
			$req = 'required';
			return "<input type=\"text\" name=\"$id\" value=\"$value\" placeholder=\"Type $name\" class=\"form-control\" $req />\n";
	}
	function dropdown($name="", $required="", $id,$value,$options) {
			$req = '';
			$op = '';
			if($required == 1)
			$req = 'required';
			$op = "<select name=\"$id\"  placeholder=\"Choose $name\" class=\"select2\" $req >";
			$options = explode(',',$options);
			$op .= '<option value="">Choose One</option>';
			foreach($options as $option)
			{
				if($option!='')
				{
				$op.='<option ';
				($option == $value)?$op.=' selected ':'';
				$op.='value='.$option.'>'.$option.'</option>';
				}
			}
			$op.='</select>';
			return $op;
	}
	function radio($name="", $required="", $id,$value,$options) {
			$req = '';
			$op = '';
			if($required == 1)
			$req = 'required';
			$options = explode(',',$options);
			$i=0;
			foreach($options as $option)
			{
				if($option!='')
				{
				$op .= '<div class="rdio rdio-success">';
				$checked = ($option == $value)?' checked ':'';
				$op .='<input type="radio" name="'.$id.'" value="'.$option.'" id="radio'.$i.'" '.$req.$checked.'/>';
				$op .='<label for="radio'.$i.'">'.$option.'</label>
		                  </div>';
				$i++;
				}
				
			}
			return $op;
	}
	function file($name="", $required="", $id,$value,$options) {
			$req = '';
			$op ='';
			if($required == 1 && $value=='')
			$req = 'required';
			$op .= "<input type=\"file\" name=\"$id\"";
			if($options!='') { 
				$o='[';
				$options  = explode(',',$options);
				foreach($options as $option)
				{
					$o.= "'".$option."',";
				}
				$o.=']';
				$op.= "onchange=\"extesion_check(this.id,$o)\" ";
			}
			$op.="value=\"$value\" placeholder=\"Type $name\" class=\"form-control fle\" $req />\n";
			$op .='<div class="col-sm-3">';
			if($value!='')
			{
				$op .='<div class="thmb-prev">
		              <a data-rel="prettyPhoto" href="'.base_url().'uploads/user_images/'.$value.'">
		                <img alt="" class="img-responsive" src="'.base_url().'uploads/user_images/'.$value.'">
		              </a>
		            </div>';
			}
				$op.='</div>';
			return $op;
					
	}
	function textarea($name="", $required="", $id,$value) {
			$req = '';
			if($required == 1)
			$req = 'required';
			return "<textarea name=\"$id\" placeholder=\"Type $name\" rows=\"5\" class=\"form-control txtarea\" $req>$value</textarea>\n";
	}
	function checkbox($name="", $required="", $id,$value,$options) {
			$req = '';
			$op = '';
			if($required == 1)
			$req = 'required';
			$options = explode(',',$options);
			$values = explode(',',$value);
			$i=0;
			foreach($options as $option)
			{
				if($option!='')
				{
				$op .= '<div class="ckbox ckbox-success">';
				$checked = in_array($option,$values)?' checked ':'';
				$op .='<input type="checkbox" name="'.$id.'[]" value="'.$option.'" id="chkbox'.$i.'" '.$req.$checked.'/>';
				$op .='<label for="chkbox'.$i.'">'.$option.'</label>
		                  </div>';
				$i++;
				}
				
			}
			return $op;
	}
	function multiselect($name="", $required="", $id,$value,$options) {
			$req = '';
			$op = '';
			if($required == 1)
			$req = 'required';
			$op = "<select name='".$id.'[]'."'  placeholder=\"Choose $name\" class=\"select2\" $req multiple>";
			$options = explode(',',$options);
			$values = explode(',',$value);
			$op .= '<option value="">Choose One</option>';
			foreach($options as $option)
			{
				if($option!='')
				{
				$op.='<option ';
				$selected = in_array($option,$values)?' selected ':'';
				$op.='value='.$option.' '.$selected.' >'.$option.'</option>';
				}
			}
			$op.='</select>';
			return $op;
	}
	function date($name="", $required="", $id,$value,$options) {
			$req = '';
			$fn = '';
			if($required == 1)
			$req = 'required';
			if($options!='') { 
			$fn = 'onclick="formatdate(this.id,\''.trim($options).'\');"';
			}
			return "<input type=\"text\" name=\"$id\" value=\"$value\" $fn placeholder=\"Type $name\" class=\"form-control datepicker\" $req />\n";
	}
	function time($name="", $required="", $id,$value,$options) {
			$req = '';
			$fn = '';
			if($required == 1)
			$req = 'required';
			return "<input type=\"text\" name=\"$id\" value=\"$value\" placeholder=\"Type $name\" class=\"form-control timepicker\" $req />\n";
	}
}	
