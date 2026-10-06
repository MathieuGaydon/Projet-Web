<?php
namespace blog\controllers;
 
use blog\views\MdpOublie as MdpOublieView;
 
class MdpOublie {
    public function execute(): void {
        (new MdpOublieView())->show();
    }
}