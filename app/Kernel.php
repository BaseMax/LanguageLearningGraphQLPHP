<?php

namespace App;

use App\Database\Database;
use App\Config\Config;
use App\Request\Request;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

use PDO;

class Kernel
{
    private PDO $db;
    private array $config;
    private $data;
    private $request;
    private $variables;
    private $schema;
    private $rootValue = null;
    private $json_header = "Content-Type: application/json";

    public function __construct()
    {
        $this->db = Database::getDB();
        $this->config = Config::env();
        $this->data = Request::data();
        $this->schema = new Schema([
            "query" => (include "./Queries/query.php")["query"],
            "mutation" => (include "./Mutations/mutation.php")["mutation"]
        ]);
        $this->request = $this->data["query"];
        $this->variables = isset($this->data['variables']) ? $this->data['variables'] : null;
    }

    public function handle(): string
    {
        $result = GraphQL::executeQuery($this->schema, $this->request, $this->rootValue, ["db" => $this->db], $this->variables);
        $output = $result->toArray();
        header($this->json_header);
        return json_encode($output);
    }
}
