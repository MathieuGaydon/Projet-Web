<?php
namespace blog\controllers;

use blog\views\LegalNotice as LegalNoticeView;

class LegalNotice {
    public function execute(): void {
        (new LegalNoticeView())->show();
    }
}