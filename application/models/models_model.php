<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Models_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }

    function display_grid($postvals,$sql,$array_fields) {
        return $this->jqgrid($postvals,$sql,$array_fields);
    }

    public function getModels()
    {
        $sql = 'SELECT id,name FROM models';
        $data = $this->getDBResult($sql, 'object');
        return $data;
    }

    public function getModelsAssoc()
    {
        $sql = 'SELECT id,name FROM models';
        $data = $this->getDBResult($sql, 'object');
        $retdata = array();
        foreach($data as $model_details)
        {
            $retdata[$model_details->id] = $model_details->name;
        }
        return $retdata;
    }

    public function getModelDetails($post)
    {
        $sql = 'SELECT * FROM models where id = '.$post['model_id'];
        $data = $this->getDBResult($sql, 'object');
        return $data[0];
    }

    function saveModel() {
        echo $this->saveRecord(conversion($_POST,'models_lib'),'models');
    }
}

?>
