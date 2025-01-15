<?php
header("Content-Type: application/json");
include_once "db.php";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case "GET":
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = $db->query("SELECT * FROM tasks WHERE id = $id");
            echo json_encode($result->fetch_assoc());
        } else {
            $result = $db->query("SELECT * FROM tasks");
            $tasks = [];
            while ($row = $result->fetch_assoc()) {
                $tasks[] = $row;
            }
            echo json_encode($tasks);
        }
        break;

    case "POST":
        $title = $db->real_escape_string($input['title']);
        $db->query("INSERT INTO tasks (title) VALUES ('$title')");
        echo json_encode(["id" => $db->insert_id, "title" => $title]);
        break;

    case "PUT":
        $id = intval($_GET['id']);
        $title = $db->real_escape_string($input['title']);
        $db->query("UPDATE tasks SET title = '$title' WHERE id = $id");
        echo json_encode(["id" => $id, "title" => $title]);
        break;

    case "DELETE":
        $id = intval($_GET['id']);
        $db->query("DELETE FROM tasks WHERE id = $id");
        echo json_encode(["id" => $id]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        break;
}
?>