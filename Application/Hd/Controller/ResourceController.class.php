<?php

/**
 * 控制器：单一资源
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class ResourceController extends CommonController {
    
    public function playAct() {
        $areacode = C('AREA_CODE');
        
        $template = 'play'.$areacode;
        $this->assign(array(
            'areacode' => $areacode,
        ));
        $this->display($template);
    }
    
}