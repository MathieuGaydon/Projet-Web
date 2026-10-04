<?php
namespace blog\controllers;

use blog\views\SiteMap as SiteMapView;

class SiteMap {
    public function execute(): void {
        (new SiteMapView())->show();
    }
}