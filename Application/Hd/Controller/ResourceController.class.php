<?php

/**
 * 控制器：单一资源
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class ResourceController extends CommonController {
	
    public function playAct() {
    	
    	$sectionId = I('sectionId','');
    	$section = D('Section','Logic')->querySectionById($sectionId);
        
    	$areacode = C('AREA_CODE');
        
    	$template = 'play'.$areacode;
        $this->assign(array(
            'areacode' 	=> $areacode,
        	'sectionId'	=> $sectionId,
        	'topicId'	=> $section['topicId'],		
        ));
        $this->display($template);
    }
    
}