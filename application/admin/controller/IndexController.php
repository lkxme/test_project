<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class IndexController extends Controller
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
}