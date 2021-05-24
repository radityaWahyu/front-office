<?php
    namespace App\Interfaces;

    Interface BaseInterface
    {
        public function create(array $attributes);
        public function get($data, array $columns);
        public function find($id, $column = array('*'));
        public function update($id, array $attributes);
        public function delete($id);
    }
