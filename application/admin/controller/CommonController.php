<?php
namespace app\admin\controller;
use think\Controller;
class CommonController extends Controller{
    public function uploadImg($fileName)
    {
        $ori_img ='';
        $thumb_img ='';
        //判断是否上传文件
        if($file = request()->file($fileName)){
            //定义文件上传的目录
            $uploadDir = './upload/';
            //定义上传文件的验证规则
            $condition = [
                'size' => 1024*1024*4,
                'ext' =>'png,jpg,jpeg,gif'
            ];
            // 上传经验并进行上传文件
            $info = $file->validate($condition)->move($uploadDir);
            //判断是否长传成功
            if($info){
                //成功,获取上传的目录文件信息,用于存储到数据库中
                $ori_img = $info->getSaveName();
                $image = \think\Image::open("./upload/".$ori_img);
                $arr_path = explode('\\',$ori_img);
                $thumb_img = $arr_path[0] . 'thumb_' . $arr_path[1];
                // 2生成缩列图并进行保存起来
                $image->thumb(150,150,2)->save('./upload/'.$thumb_img);
                return ['ori_img'=>$ori_img,'thumb_img'=>$thumb_img];
            }else{
                //上传失败,提示上传的错误信息
                $this->error( $file->getError());
            }
        }

    }
    public function _initialize()
    {
        if(!session('user_id')){
            //没有则提示用户登录之后才操作
            $this->success("登录后再试",url('/login'));
        }
    }

    public function top(){
        return $this->fetch();
    }
}
