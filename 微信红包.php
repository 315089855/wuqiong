<?php 
/**
* 根据个人对微信红包的理解，一个微信生成红包的方案 
* 设计思路： 
* 1、微信红包，每人最少分得1分钱;
* 2、每人分得到的金额是随机分配的 
* 3、每次生成红包就生成了对应领取红包的结果 
* @author Chris Wu (chriswu91@163.com/wuqiong.me)
* @copyright 2016-05-17
*/


/**生成红包的函数*/
function getRandMoney($totalMoney, $totalPeople=2, $miniMoney=1){
 
        $randRemainMoney = $totalMoney - $totalPeople * $miniMoney;//剩余需要随机的钱数
        return _getRandMoney($randRemainMoney, $totalPeople, $miniMoney);
    }
 
/**红包生成的逻辑代码*/
function _getRandMoney($totalMoney, $totalPeople, $miniMoney){
 
        $returnMessage = array('status'=>1, 'data'=>NULL);
        if($totalMoney > 0){
            $returnMessage['data'] = _randMoney($totalMoney, $totalPeople, $miniMoney);
        }elseif($totalMoney == 0){
            $returnMessage['data'] = array_fill(0, $totalPeople, 1);
        }else{
            $returnMessage['status'] = -1;
            $returnMessage['data'] = '参数传递有误，生成红包失败';
        }
 
        return $returnMessage;
    }
 
/*参数无误，开始生成对应的红包金额*/
function _randMoney($totalMoney, $totalPeople, $miniMoney){
 
        $data = array_fill(0, $totalPeople, $miniMoney);
        if($totalPeople > 1){
            foreach($data as $k => $v){
                if($k == $totalPeople -1){
                    $data[$k] = $totalMoney + $v;
                    break;
                }else {
                    if($totalMoney == 0) break;
                    $randMoney = rand(0, $totalMoney);
                    $totalMoney -= $randMoney;
                    $data[$k] = $randMoney + $v;
                }                
            }
        }
        return $data;
    }

 ?>