<?php
namespace blog\controllers\mdpoublie;
 
use blog\views\Reset as ResetView;
 
class Reset {
    public function execute(): void {
        (new ResetView())->show();
    }
}
