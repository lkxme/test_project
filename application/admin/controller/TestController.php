<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\Category;

//定义控制器名字一定要和文件名一致
class TestController extends Controller
{
    // public function test()
    // {
    //     dump( Db::table("tp_category")->select() );
    // }

    public function test2()
    {


        echo md5("12345".config('password_salt'));die;

        // //静态方法  删除数据
        // $del = Category::get(5);
        // dump( $del->delete() );//返回修改的行数



        // // //实例化模型表  修改数据
        // $catModel = new Category();
        // // $catModel = Model('Category1');
        // $data = [
        //     'cat_name' => '修改直升机',
        //     'pid' => '1',
        //     'cat_id' => '4' //修改内容的指定的条件
        // ];
        // dump( $catModel->update($data) );
        // dump( $catModel->get(1) );//返回当前的数据对象
        // return $this->fetch('index');

        // //实例化模型表  新增数据
        // $catModel = new Category();
        // // $catModel = Model('Category1');
        // $data = [
        //     'cat_name' => '修改直升机',
        //     'pid' => '1',
        //     'cat_id' => '4' //修改内容的指定的条件
        // ];

        // dump( $catModel->save($data) );

    }
}