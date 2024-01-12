<?php
class StudentManager
{
    public $conn;
    public function __construct()
    {
        // Replace these database connection details with your actual credentials
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "PhpDemoAccount";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " + $this->conn->connect_error);
        }
    }
    public function getAllStudents()
    {
        $students = [];
        $sql = "SELECT * FROM students";
        $stmt = $this->conn->prepre($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }

        $stmt->close();

        return $students;
    }
    public function addStudent($id, $name, $address)
    {
        $sql = "INSERT INTO students (id, name, address) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $id, $name, $address);
        $stmt->execute();
        $stmt->close();
    }
    public function getStudentById($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
    }
}