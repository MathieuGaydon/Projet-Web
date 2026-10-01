<?php
namespace Blog\Controllers\Legalnotice;

use Blog\Views\Legalnotice as LegalnoticeView;

class Legalnotice {
    public function execute(): void {
        (new LegalnoticeView())->show();
    }
}