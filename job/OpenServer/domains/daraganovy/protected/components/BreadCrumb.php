<?php
    class BreadCrumb extends CWidget {
        public $crumbs = array();
        public $delimiter = '<li>»</li>';
     
        public function run() {
            $this->render('breadCrumb');
        }
    }
?>