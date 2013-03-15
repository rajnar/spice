<?php if (!defined('BASEPATH')) die();
class Models extends Main_Controller {
    public function index() {
        $header_data['active_tab'] = 'models';
		$header_data['user_details'] = $this->user_details;
        $data['header'] = $this->load->view('include/my_header',$header_data,true);
        $this->load->view('models/index',$data);
    }

    public function getModelsGrid()
    {
        $sql = 'SELECT id,name,model_number,price FROM models';
        $data_flds = array('name','model_number','price',"<a class='cmodel_edit' id='{%id%}'>Edit</a>");
	echo $this->models_model->display_grid($_POST,$sql,$data_flds);
    }

    public function saveModel()
    {
       $this->models_model->saveModel();
    }

    public function getModelDetails()
    {
        $model_data = $this->models_model->getModelDetails($_POST);
        $return_data = array('id'=>$model_data->id,'name'=>$model_data->name,'model_number'=>$model_data->model_number,'price'=>$model_data->price);
        echo json_encode($return_data);
    }
}