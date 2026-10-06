<?php
namespace blog\controllers;

use blog\views\Homepage as HomepageView;
use PDO;

class Homepage {
    private \PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function execute(): void {
        (new HomepageView($this->pdo))->show();
    }
}