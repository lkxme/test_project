<?php
namespace app\admin\model;

use think\Model;

class Category extends Model
{
    //指定当前模型表的主键字段
    protected $pk = 'cat_id';

    //时间戳自动维护
    protected $autoWriteTimestamp = true;

    //当时间字段不为create_time和update_time, 通过以上属性指定
    protected $createTime = 'create_time';
    // protected $table = 'tp_category';

    public function getSonCat($data,$pid=0,$level=1)
     {
        static $result = [];
        foreach($data as $v){
            //第一次循环一定先找到pid=0的顶级
            if($v['pid'] == $pid){
                $v['level'] =$level;  //加一层级关系
                $result[] = $v; //存放在$result中去
                $this->getSonCat($data,$v['cat_id'],$level+1);
            }
        }
        //返回递归处理好的数据
        return $result;
     }


}