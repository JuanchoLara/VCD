<?php

class FileUpload_model extends Model
{
	public $id;
	public $filename;
	public $description;
	public $created;
	public $ref_id;
	public $ref_file;

	public function __construct()
	{
		parent::Model();
	}

	//Get all File, initial version
	public function getAll()
	{
		$query = $this->db->get_where('file', 'ref_id = id');
		return $query->result();
	}

	//Get file by ID
	public function getById($id)
	{
		$query = $this->db->get_where('file', array('id' => $id));
		return $query->row();
	}

	//Getl all files by Ref_Id
	public function getByRefId($id)
	{
		$queryfilter = $this->db->get_where('file', 'ref_id = '.$id.' AND id != '.$id);
		return $queryfilter->result();
	}

	//Insert 1 file
	private function insert($fileupload)
	{
		return $this->db->insert('file', $this);
	}

	//Update file info
	private function update($fileupload)
	{
		$this->db->set('filename', $this->filename);
		$this->db->set('description', $this->description);
		$this->db->set('ref_id', $this->ref_id);
		$this->db->where('id', $this->id);
		return $this->db->update('file');
	}

	//Delete file version
	public function delete()
	{
		$this->db->where('id', $this->id);
		return $this->db->delete('file');
	}

	//Delete File Complete
	public function deleteAll()
	{
		$fileuploads = $this->getByRefId($this->id);
		foreach($fileuploads as $fileupload) :
			$this->delete();
		endforeach;
		return true;
	}

	//Save File Insert/Update
	public function save()
	{
		if (isset($this->id)) {
			return $this->update();
		} else {
			return $this->insert();
		}
	}
}