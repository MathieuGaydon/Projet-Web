<?php
namespace Blog\Controllers\Auth;

use Blog\Views\Login as AuthView;

class Login {
    public function execute(): void {
        (new AuthView())->show();
    }
}