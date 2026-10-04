<?php
namespace blog\controllers;

use blog\views\Home as HomepageView;

class Homepage {
    public function execute(): void {
        (new HomepageView())->show();
    }
}