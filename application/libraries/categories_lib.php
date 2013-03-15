<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Categories_lib {
    private $id;
    private $name;
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

}
?>
