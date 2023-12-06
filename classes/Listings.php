<?php

class Listing
{

    private $_db, $_data, $_sessionName, $_cookieName, $_isLoggedIn;
    

    public function __construct($listing = null)
    {
        $this->_db = DB::getInstance();

        if (!$listing) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                if ($this->find($listing)) {
                    $this->_isLoggedIn = true;
                } else {
                    //process logout
                }
            }
        } else {
            $this->find($listing);
        }
    }
    public function update($fields = array(), $id = null)
    {
        if (!$this->_db->update('listings', $id, $fields)) {
            throw new Exception('There was a problem updating listing');
        }
    }

    public function find($listing = null)
    {
        if ($listing) {
            $field = (is_numeric($listing)) ? 'id' : 'mlsid';
            $data = $this->_db->get('listings', array($field, '=', $listing));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }


    public function getlisting($id = null){
        if ($id) {
            $field = (is_numeric($id)) ? 'id' : 'mlsid';
            $listing_data = $this->_db->get('listings', array($field, '=', $id));

            if ($listing_data->count()) {
                return $listing_data->first(); // Assuming you are using a class that has a 'first' method to retrieve the first result
            }
        }

    }


    private function getColumnNames($table)
    {
        $columns = [];
        $result = $this->_db->query("SHOW COLUMNS FROM $table");

        foreach ($result->results() as $column) {
            $columns[] = $column->Field;
        }

        return $columns;
    }

    

    public function create($fields = array())
    {
        if ($this->_db->insert('listings', $fields)) {
            throw new Exception('There was a problem creating a new listings');
        }
    }

    public function data()
    {
        return $this->_data;
    }
}
