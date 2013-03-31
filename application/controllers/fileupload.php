<?php

class FileUpload extends Controller
{
	public function __construct()
	{
		parent::Controller();

		// Load libraries
		$this->load->database();

		// Load helpers
		$this->load->helper('url');

		// Load models
		$this->load->model('fileupload_model', 'fileupload');
	}

	public function index()
	{
		// Get data from model
		$data['fileuploads'] = $this->fileupload->getAll();

		// Load views
		$this->load->view('header');
		$this->load->view('index', $data);
		$this->load->view('footer');
	}

	//Read file an versions
	public function read()
	{
		if ($_POST)
		{
			// Build object
			$fileupload = new FileUpload_model();
			$fileupload->filename = $this->input->post('filename', TRUE);
			$fileupload->description = $this->input->post('description', TRUE);
			$fileupload->ref_id = $this->input->post('ref_id', TRUE);

			//If not error in load file
			if ($_FILES["uploaded"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["uploaded"]["error"] . "<br>";
			}
			else
			{
				$fileupload = $this->fileControl($fileupload);

				// Save to database
				if ($fileupload->save()) {
					redirect(base_url(), 'location');
				}
			}
		}

		// Get id from uri
		$refid = $this->uri->segment(4);
		$list['fileuploads'] = $this->fileupload->getByRefId($refid);
		$id = $this->uri->segment(3);
		$fileupload = $this->fileupload->getById($id);

		// Initialize form
		$this->load->helper('form');
		$data['action'] = site_url('fileupload/read/'.$id.'/'.$refid);
		$data['id'] =  $fileupload->id;
		$data['filename'] = $fileupload->filename;
		$data['description'] = $fileupload->description;
		$data['created'] = $fileupload->created;
		$data['ref_id'] = $fileupload->ref_id;
		$data['ref_file'] = $fileupload->ref_file;

		// Load views
		$this->load->view('header');
		$this->load->view('read', $data);
		$this->load->view('list', $list);
		$this->load->view('footer');
	}

	//Create file version
	public function create()
	{
		if($_POST)
		{
			$this->loadfile();
			// Build object

			$fileupload = new FileUpload_model();

			$fileupload->filename = $this->input->post('filename', TRUE);
			$fileupload->description = $this->input->post('description', TRUE);

			if ($_FILES["uploaded"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["uploaded"]["error"] . "<br>";
			}
			else
			{
				$fileupload = $this->fileControl($fileupload);

				// Save database
				if ($fileupload->save()) {
					$fileupload->id = mysql_insert_id();
					$fileupload->ref_id = mysql_insert_id();
					if ($fileupload->save()) {
						redirect(base_url(), 'location');
					}
				}
			}
		}

		// Load helpers
		$this->load->helper('form');

		// Initialize form
		$data['action'] = site_url('fileupload/create');
		$data['id'] = NULL;
		$data['filename'] = NULL;
		$data['description'] = NULL;
		$data['ref_id'] = NULL;
		$data['ref_file'] = NULL;

		// Load views
		$this->load->view('header');
		$this->load->view('upsert', $data);
		$this->load->view('footer');
	}

	//Update Falie Version and File
	public function update()
	{
		if ($_POST)
		{
			// Build post object
			$fileupload = new FileUpload_model();
			$fileupload->id = $this->input->post('id', TRUE);
			$fileupload->filename = $this->input->post('filename', TRUE);
			$fileupload->description = $this->input->post('description', TRUE);
			$fileupload->ref_id = $this->input->post('ref_id', TRUE);

			if ($_FILES["uploaded"]["error"] > 0)
			{
				if($_FILES["uploaded"]["error"] = 4)
				{
					// Save post to database
					if ($fileupload->save()) {
						redirect(base_url(), 'location');
					}
				}
				echo "Return Code: " . $_FILES["uploaded"]["error"] . "<br>";
			}
			else
			{
				$fileupload = $this->fileControl($fileupload);

				// Save post to database
				if ($fileupload->save()) {
					redirect(base_url(), 'location');
				}
			}
		}

		// Get post from database
		$id = $this->uri->segment(3);
		$fileupload = $this->fileupload->getById($id);

		// Initialize form
		$this->load->helper('form');
		$data['action'] = site_url('fileupload/update/'.$id);
		$data['id'] =  $fileupload->id;
		$data['filename'] = $fileupload->filename;
		$data['description'] = $fileupload->description;
		$data['ref_id'] = $fileupload->ref_id;
		$data['ref_file'] = $fileupload->ref_file;

		// Load views
		$this->load->view('header');
		$this->load->view('upsert', $data);
		$this->load->view('footer');
	}

	//Delete file version
	public function delete()
	{
		$fileupload = new FileUpload_model();
		$fileupload->id = $this->uri->segment(3);
		if ($fileupload->delete()) {
			redirect(base_url(), 'location');
		}
	}

	//Delete file complete
	public function deleteAll()
	{
		$fileupload = new FileUpload_model();
		$fileupload->id = $this->uri->segment(3);
		if ($fileupload->deleteAll()) {
			redirect(base_url(), 'location');
		}
	}

	//Load file in server
	private function loadfile($filename)
	{
		if ($_FILES["uploaded"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["uploaded"]["error"] . "<br>";
		}
		else
		{
			if (file_exists($filename))
			{
				echo $_FILES["uploaded"]["name"] . " already exists. ";
			}
			else
			{
				move_uploaded_file($_FILES["uploaded"]["tmp_name"], $filename);
			}
		}

	}

	//Control file in server.
	private function fileControl($fileupload)
	{
		//Generate File Name
		$file_info = pathinfo($_FILES['uploaded']['name']);
		$folder = "Archivos/";
		$filecomplete = $folder . uniqid() . "." . $file_info['extension'];
		$fileupload->ref_file = $filecomplete;

		//Load File to folder in server
		$this->loadfile($filecomplete);

		return $fileupload;
	}
}