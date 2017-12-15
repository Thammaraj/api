<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/room',function(Request $request, Response $response){
    
    $db = $this->db;

    $statement = $db->prepare("SELECT * FROM Room");
    $statement->execute();
    $results = $statement->fetchAll();
    echo json_encode($results);

    // echo 'rooms ok';
});

$app->post('/room/new', function (Request $request, Response $response) {

    $data = $request->getParsedBody();
    $roomName = $data['roomName'];
    $db = $this->db;
    $statement = $db->prepare('INSERT INTO room(name) VALUES (:roomName)');
    $statement->execute(array(':roomName' => $roomName));

    if($statement->rowCount() > 0){    

        $result = (object) array(
            "message" => "Insert success",
            "insert_status" => 1
        );

        echo json_encode($result);

    } else {

        $result = (object) array(
            "message" => "Insert nothing",
            "insert_status" => 0
        );

        echo json_encode($result);
    }
    

    
});

?>