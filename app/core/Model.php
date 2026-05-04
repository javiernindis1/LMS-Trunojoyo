<?php
class Model
{
    protected $db;

    public function __construct()
    {
        // For demo purposes, we use static data.
        // Replace with PDO connection when database is ready.
        // $this->db = new PDO('mysql:host=localhost;dbname=lms_db', 'root', '');
    }
}
