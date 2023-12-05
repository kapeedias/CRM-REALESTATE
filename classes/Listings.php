<?php

class Listing{

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
    public function update($fields = array(), $id = null){
        if(!$this->_db->update('listings',$id, $fields)) {
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

?>