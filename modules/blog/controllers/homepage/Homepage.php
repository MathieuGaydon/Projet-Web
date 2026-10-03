<?php
namespace blog\controllers\homepage;

use blog\views\Homepage as HomepageView;

class Homepage {
    public function execute(): void {
        (new HomepageView())->show();
    }
}