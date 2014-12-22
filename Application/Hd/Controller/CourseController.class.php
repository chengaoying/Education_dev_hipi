<?php

/**
 * 控制器：课程首页
 *
 */

namespace Hd\Controller;
use Common\Controller\CommonController;

class CourseController extends CommonController {
    
    /*
     * 某一具体课程
     */
    public function detailAct() {
        //先判断是什么学龄阶段
        $learnType = 2;
        switch ($learnType) {
            case 1: //早教
                $url = U('SectionList/early');
                break;
            
            case 2: //幼儿园
                $url = U('SectionList/preschool');
                break;
            
            case 3: //小学
                $url = U('SectionList/primaryschool');
                break;
            
            default:
                break;
        }
        header("location:".$url);
    }
    
    
}