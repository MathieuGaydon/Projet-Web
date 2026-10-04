<?php
namespace blog\controllers;

use blog\views\Homepage as HomepageView;

class Homepage {
    public function execute(): void {
        (new HomepageView())->show();
    }
}