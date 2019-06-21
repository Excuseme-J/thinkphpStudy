<?php
namespace Admin\Controller;
use Think\Controller;
class SiteController extends Controller
{
    public function hello()
    {
        //分配数据
        $this -> assign('name',$_GET['name']);
        //展示模板
        $this -> display();
    }
    public function g()
    {
        G('begin');
        for ($i = 0; $i  <= 10000; $i ++) { 
            # code...
            $rand = mt_rand(0,1000);
        }
        //比较差异
        echo G('begin','end');
        echo G('begin','end',6);
    }
    public function modelAction()
    {
        $model = M('city');
         /*$data = $model -> find();
        $modelLen = count($data);
       dump( $modelLen );
        for ($i=0; $i < $modelLen; $i++) { 
            dump( $data[$i]['name'] );
            if($data[$i]['name'] == ''){
                break;
            }else{
                $data[$i](['id' => $i]);
            }
            
        }
        $result = $model -> save($data);
        $data = [
            'id' => 4,
            'area' => '300002'
        ];
        $result = $model -> save($data);

        $ip = $_SERVER['HTTP_CLIENT_IP'];
        echo $ip ;
        //$result = $model -> add($data);
        //$result = $model -> delete(3);
        //$result = $model -> where(['name' => '北京']) -> find();
        //dump($result);*/
        $rows = $model -> field('area pk','name as mingzi') -> select();
        dump($model -> getLastSQL() );
        dump($rows);
    }
    public function modelAction1()
    {
        // $model1 = D('Member');
        // dump($model1);
        $model1 = M();
        $model1 -> table('Member');//没有前缀   
        //$model1 -> table('other_member');
        $model1 -> select();
    }
   
}