<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
use think\Validate;

class CategoryController extends CommonController{
    public function ajaxdel()
    {
        if(request()->isAjax()){
            //1接受参数cat_id
            $cat_id = input('cat_id');
            //2判断分类下是否有子分类
            $where = [
                //'pid'=>['=',$cat_id]
                'pid' => $cat_id
            ];
            $result1 = Category::where($where)->find();
            if($result1){
                //说明有子分类i
                $response = ['code'=>-1,'message'=>'分类下有子分类,无法删除'];
                return json($response);die;//等价于echo json_encode($response);
            }
            //判断分类下面的是否有文章
            $result2 = Article::where(["cat_id"=>$cat_id])->find();
            if($result2){
                //说明有文章
                $response = ['code'=>-2,'message'=>'分类下有文章,无法删除'];
                return json($response);
            }
            //只有上面两个条件满足才能删除
            if(Category::destroy($cat_id)){
                $response = ['code'=>200,'message'=>'删除成功'];
                return json($response);
            }else{
                $response = ['code'=>-3,'message'=>'删除失败'];
                return json($response);
            }
        }
    }
    public function upd()
    {
        $catModel = new Category();
        //判断post请求
        // $postData = input('post.');
        if(request()->isPost()){
            //1.接受参数
            $postData = input('post.');
            //2验证器验证
            $result = $this->validate($postData,'Category.upd',[],true);
            if($result !==true){
                $this->error( implode(',','$result') );
            }
            //3/判断是否验证成功
            //判断是否编辑入库成功
        // var_dump($postData);die;
            if( $catModel->update($postData)){
                $this->success('编辑成功',url('admin/category/index'));
            }else{
                $this->error('编辑失败');
            }
        }


        //接受参数cat_id,取得当前分类的数据
        $cat_id = input('cat_id');
        $catData = $catModel->find($cat_id);

        $data = $catModel->select();
        //无极限分类处理
        $cats = $catModel->getSonCat($data);
        return $this->fetch('',[
            'cats'=>$cats,
            'catData'=>$catData
            ]);
    }
    public function add()
    {
        $catModel = new Category();
        //判断post参数
        if(request()->isPost()){
            //接受post数据
           $postData = input('post.');
           //验证器验证数据 unique:category unique:表名
            $result = $this->validate($postData,'Category.add',[],true);
            if($result !==true){
                //提示错误信息
                $this->error( implode(',',$result) );
            }
           //验证是否通过
           $result = $validate->batch()->check($postData);
           if(!$result){
                //没有验证通过$validate->getError() ==>[err1,err2]
                $this->error(imlode(',',$validate->getError()));
           }
           if($catModel->save($postData)){
                $this->success('入库成功',url('admin/category/index'));
           }else{
                $this->error("入库失败");
           }
        }
        //取出所有的分类,分配到模板中;
        $data = $catModel->select()->toArray();
        //对分类数据进行递归处理
        $cats = $catModel->getSonCat($data);
        //halt($cats);
        return $this->fetch('',['cats'=>$cats]);
    }

    public function index()
    {
        $catModel = new Category();
        $data = $catModel
                ->field('t1.*,t2.cat_name as p_name')
                ->alias('t1')
                ->join('tp_category t2','t1.pid=t2.cat_id','left')
                ->select();
        //进行无限极分类处理(找子孙分类)
        $cats = $catModel->getSonCat($data);
        //输出模板视图
        return $this->fetch('',['cats'=>$cats]);
    }
}