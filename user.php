<?php
class user{
    public $con;
    private static $instance = null;

    public function insertUser($user){
        $bulk = new MongoDB\Driver\BulkWrite;
        $data =['_id' => new MongoDB\BSON\ObjectId,
                'name' => $user['name'],
                'email' => $user['email'],
                'image' => $user['image']
            ];
        $bulk->insert($data);
        $this->con->executeBulkWrite('users.user', $bulk);
    }

    private function __construct()
    {
        $this->con = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new user();
        }
        return self::$instance;
    }
}
/*require_once 'connection.php';
$bulk = new MongoDB\Driver\BulkWrite;
if(isset($_POST["submit"])){
    $target = "./image/".md5(uniqid(time())).basename($_FILES['image']['name']);
    $data =['_id' => new MongoDB\BSON\ObjectId,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'image' => $target
    ];
    $bulk->insert($data);
}
$client->executeBulkWrite('users.user', $bulk);
if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
    header('location:index.php');
}
else{
    $msg = "Error";
}*/
