<?php
namespace Blog\Controllers\Plan;

use Blog\Views\Plan as PlanView;

class Plan {
    public function execute(): void {
        (new PlanView())->show();
    }
}