<?php
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{
    //定义验证规则
    protected $rule = [
        'cat_name' => 'require|unique:category',
        'pid' => 'require'
    ];
    //定义验证错误提示信息
    protected $message =[
        'cat_name.require' => '分类名称不能为空',
        'cat_name.unique' => '分类名称不能重复',
        'pid.require' => '需要选择一个父分类',
    ];
    //验证场景
    protected $scene = [
        //场景名=>['规则name的名称'=>'规则1|规则2']
        //在add场景验证cat_name和pid的元素的所有的规则
        'add' => ['cat_name','pid'],
        //在upd场景验证只cat_name的require规则和经验pid元素的所有规则
        'upd' => ['cat_name' =>'require','pid']
    ];


}
