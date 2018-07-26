<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\User;

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
        session(null);
        $this->redirect('login');
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
