<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// error_log(json_encode($uri));


// if ($uri[3] !== 'user') {
//     header("HTTP/1.1 404 Not Found");
//    exit();
// }

$userId = null;
if (isset($uri[4])) {
    $userId = (int) $uri[4];
}

error_log(json_encode($uri));


$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
      case 'GET':
          if ($userId) {
            error_log("userid: " . $userId);
            $response = getUser($userId);
          } else {
            error_log("Alle brukere ");
              $response = getAllUsers();
          };
          break;
      case 'POST':
          $response = createUserFromRequest();
          break;
      case 'PUT':
          $response = updateUserFromRequest($userId);
          break;
      case 'DELETE':
          $response = deleteUser($userId);
          break;
      default:
          $response = notFoundResponse();
          break;
  }
  header($response['status_code_header']);
  if ($response['body']) {
      echo $response['body'];
  }

function getAllUsers()
{
    // $result = personGateway->findAll();
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $result = "alle brukerne!";
    $response['body'] = json_encode($result);
    return $response;
}

function getUser($id)
{
    // $result = personGateway->find($id);
    $result = "en bruker!";
    if (! $result) {
        // return notFoundResponse();
    }
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = json_encode($result);
    return $response;
}

function createUserFromRequest()
{
    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    // if (! validatePerson($input)) {
    //     return unprocessableEntityResponse();
    // }
    // personGateway->insert($input);
    $response['status_code_header'] = 'HTTP/1.1 201 Created';
    $response['body'] = null;
    return $response;
}

function updateUserFromRequest($id)
{
    // $result = personGateway->find($id);
    $result = "Funnet bruker";
    if (! $result) {
        return notFoundResponse();
    }
    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    // if (! validatePerson($input)) {
    //     return unprocessableEntityResponse();
    // }
    // personGateway->update($id, $input);
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = null;
    return $response;
}

function deleteUser($id)
{
    // $result = personGateway->find($id);
    // if (! $result) {
    //     return notFoundResponse();
    // }
    // personGateway->delete($id);
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = null;
    return $response;
}

function validatePerson($input)
{
    if (! isset($input['firstname'])) {
        return false;
    }
    if (! isset($input['lastname'])) {
        return false;
    }
    return true;
}

function unprocessableEntityResponse()
{
    $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
    $response['body'] = json_encode([
        'error' => 'Invalid input'
    ]);
    return $response;
}

function notFoundResponse()
{
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = null;
    return $response;
}
