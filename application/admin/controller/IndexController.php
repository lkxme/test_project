<?php
namespace app\admin\controller;
// use think\Controller;

use think\Request;

class IndexController extends CommonController
{
    public function login($id=0)
    {
        return $this->fetch('top');
    }

     public function user($id)
    {
        return 'admin/index/user';
    }
     public function logout($id=0)
    {
        return 'admin/index/logout';
    }
    public function index($id=0)
    {
        return $this->fetch('index');
    }
    public function top($id=0)
    {
        return $this->fetch('top');
    }
    public function left($id=0)
    {
        return $this->fetch('left');
    }
    public function main($id=0)
    {
        return $this->fetch('main');
    }
}