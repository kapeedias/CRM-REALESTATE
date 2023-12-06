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

    private function getColumnNames($table)
    {
        $columns = [];
        $result = $this->_db->query("SHOW COLUMNS FROM $table");

        foreach ($result->results() as $column) {
            $columns[] = $column->Field;
        }

        return $columns;
    }

    public function listingsView($id = null, $status = null)
    {
        $conditions = array();
        if ($id !== null) {
            $conditions[] = array('id', '=', $id);
        }
        if ($status !== null) {
            $conditions[] = array('status', '=', $status);
        }
    
        try {
            $data = $this->_db->get('listings', $conditions);
    
            $listingsList = [];
    
            if ($data && $data->count() > 0) {
                foreach ($data->results() as $listing) {
                    $listingsList[] = (array)$listing; // Convert the object to an array
                }
            }
            return $listingsList;
        } catch (Exception $e) {
            // Log or handle the exception as needed
            echo 'Error: ' . $e->getMessage();
            return [];  // Return an empty array or handle it differently based on your requirements
        }
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
