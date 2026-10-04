<?php
namespace blog\controllers\mdpoublie;
 
use blog\views\MdpOublie as MdpOublieView;
 
class MdpOublie {
    public function execute(): void {
        (new MdpOublieView())->show();
    }
}
