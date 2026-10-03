<?php
namespace Blog\Controllers\Homepage;

use Blog\Views\Homepage as HomepageView;

class Homepage {
    public function execute(): void {
        (new HomepageView())->show();
    }
}