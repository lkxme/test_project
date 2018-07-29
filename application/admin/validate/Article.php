<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate{
    //定义验证规则
    protected $rule = [
        'title' => 'require|unique:article',
        'cat_id' => 'require'
    ];
    //定义验证错误提示信息
    protected $message =[
        'title.require' => '标题不能为空',
        'title.unique' => '标题不能重复',
        'cat_id.require' => '需要选择一个文章分类',
    ];
    //验证场景
    protected $scene = [
        //场景名=>['规则name的名称'=>'规则1|规则2']
        //在add场景验证cat_name和pid的元素的所有的规则
        'add' => ['title','cat_id'],
        //在upd场景验证只cat_name的require规则和经验pid元素的所有规则
        'upd' => ['title' =>'require','cat_id']
    ];


}