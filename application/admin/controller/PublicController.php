<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\User;
use think\Validate;

class PublicController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function login()
    {
        //判断是否为post请求
       if(request()->isPost()){
        //接受参数input
            $postData = input('post.');
            //验证数据是否合法(验证器去验证)
            //1.验证规则
            $rule = [
                'username' => 'require|length:4,8',
                'password' => 'require'
            ];

            //2.验证的错误信息
            $message = [
                'username.require' => '用户名不能为空',
                'username.length' => '用户名长度为4-8之间',
                'password' => '密码不能为空',
            ];
            //3.实例化验证器对象,开始验证
            $validate = new Validate($rule,$message);
            //4.判断是否验证成功
            $result = $validate->batch()->check($postData);
            //成功 $result true    失败 $result false
            if(!$result){
                //提示错误的信息
                //halt($validate->getError());
                $this->error( implode(',',$validate->getError()) );
            }

            //实例化一个用户表模型
            $userModel = new User();
            $flag  = $userModel->checkUser($postData['username'], $postData['password']);
            // dump($postData['password']);die;
            if($flag){
                $this->redirect('admin/index/index');
            }else{
                $this->error('用户名或者密码错误');
            }
       }
       return $this->fetch('login');
    }
    /**
     * 退出单页.
     *
     * @return \think\Response
     */
    public function logout()
    {
        //清除session信息
        //session('user_id',null);//清除其中某个session信息
        session(null);
        $this->redirect('/login');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
