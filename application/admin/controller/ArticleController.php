<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
use think\Validate;

class ArticleController extends CommonController{
    public function upd()
    {
        $artModel = new Article();
        if(request()->isPost()){
            //1接受post数据
            $postData = input('post.');
            //验证器验证
            $result = $this->validate($postData,'Article.upd',[],true);
            if($result !== true){//返回时一个数组集合
                $this->error(implode(',',$result));
            }
            //验证成功之后,进行文件上传和缩列图的缩放
            $path = $this->uploadImg('img');
            if($path){
                //删除原来文章的原因和缩列图
                //获取到图片的原路径和缩列图路径
                $oldData = $artModel->find($postData['article_id']);
                // if($old['ori_img']){
                //     unlink('./upload/'.$oldData['ori_img']);
                //     unlink('./upload/'.$oldData['thumb_img']);
                // }
                $postData['ori_img'] = $path['ori_img'];
                $postData['thumb_img'] = $path['thumb_img'];
            }
            //编辑入库
            if($artModel->update($postData)){
                $this->success('编辑成功',url('admin/article/index'));
            }else{
                $this->error('编辑失败');
            }
        }
        $catModel = new Category();
        //接受get提交过来的id
        $article_id = input('article_id');
        //取出当前文章的数据,分配到模板
        $art = $artModel->find($article_id);
        //取出所有的分类(无极限)
        $cats = $catModel->getSonCat($catModel->select());
        return $this->fetch('',['art'=>$art,'cats'=>$cats]);
    }

    public function add(){
        $catModel = new Category();
        $artModel = new Article();
        //1判断是否为post请求
        if(request()->isPost()){
            //2接受post数据
            $postData = input('post.');
            //3验证数据信息
            $result = $this->validate($postData,'Article.add',[],true);
            if($result !== true){
                //提示错误信息
                $this->error( implode(',',$result) );
            }
            //判断是否有文件上传
        if( $file = request()->file('img')){
            $uploadDir = "./upload";
            $condition = [
                'size' => 1024*1024*4,
                'ext' => 'png,jpg,gif,jpeg'
            ];
            //上传验证并进行上传文件
            $info = $file->validate($condition)->move($uploadDir);
            //判断是否上传成功
            if($info){
                //成功,获取上传的目录文件信息,用于存储到数据中
                $postData['ori_img'] = $info->getSaveName();
                //进行缩列图生成
                //$postData['ori_img'] 20180728/dfhuehfhhff.png
                //$postData['ori_img'] 20180728/thumb_dfhuehfhhff.png
                //1 实例化图像类,打开出来处理的原图图片路径
                $image = \think\Image::open("./upload/" . $postData['ori_img'] );
                // dump($image);die;
                $arr_path = explode('\\',$postData['ori_img']);//[20180728,34354.png]
                $thumb_path = $arr_path[0].'/thumb_'.$arr_path[1];
                //2生成缩列图并进行保存起来
                $image->thumb(150,150,2)->save('./upload/' .$thumb_path);
                //保存缩列图的路劲到数据库表字段
                $postData['thumb_img'] = $thumb_path;
            }else{
                //上传失败,提示上传的错误的信息
                $this->error( $file->getError() );
            }
        }
            //4判断是否入库成功
            if($artModel->save($postData)){
                $this->success('入库成功',url('admin/article/index'));
            }else{
                $this->error('入库失败');
            }
        }
        $data = $catModel->select();
        $cats = $catModel->getSonCat( $data );
        return $this->fetch('',['cats'=>$cats] );
    }
    public function index(){
        //获取所有文章
        $arts = Article::alias('a')
        ->field('a.*,c.cat_name')
        ->join('tp_category c','a.cat_id = c.cat_id','left')
        ->paginate(3);//分页查询数据条数
        //halt($arts);
        return $this->fetch('',['arts'=>$arts]);
    }
}