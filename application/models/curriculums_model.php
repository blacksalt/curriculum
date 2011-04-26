<?php

class Curriculums_model extends Model
{
    function get_subjects($id, $sem){
		$this->db->from('subject');
		$this->db->where(array('course_id'=> $id, 'sem'=>$sem));
		$query = $this->db->get();
	   	return $query->result_array();
    
    }
    function getprereq($array){
    		$this->db->select('
    			prereq.prereq as prereq,
    			subject.alias as alias,
    			subject.name as name,
    				');
    		$this->db->from('prereq');
		$this->db->where('parent', $array['subject_id']);
		$this->db->join('subject','prereq.prereq = subject.subject_id');
		$query = $this->db->get();
		$array['prereqs'] = $query->result_array();
	   	return $array;
    }

}
