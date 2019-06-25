<?php
//var_dump($_FILES['userName']);
//move_uploaded_file($_FILES['updata']['tmp_name'],'D:\壁纸\18031.jpg');
$userName = $_POST['userName'];
echo $userName;
$num = rand(1,5);
echo $num;
echo __DIR__;
echo __FILE__;
$hob = '杀人,放火,烫头';
//字符串切割为数组
$arr = explode(',',$hob);//explode
var_dump($arr);
//数组转换为字符串
$hob = implode(",",$arr);//implode
var_dump($hob);
//字符串替换
$str = 'admin';
//echo $str;
$root = substr_replace($str,'admin888',0);
echo $root;
$num1 = 1;
//强制转换
var_dump((string)$num1);
define(ROOT,str_replace('\\','/',__DIR__).'/');
$url = include_once(ROOT.'index.php');
var_dump($url);

$arr1 = array(3,5,56,677,655);
$arr1[] = 333;
var_dump($arr1);
$arr2 = array(2,5,4,8,12,34);
for ($i=0; $i < count($arr2); $i++) { 
    $arr1[] = $arr2[$i];
}
var_dump($arr1);
$arr4 = array('name'=>'关羽','age'=>600);
var_dump($arr4);
echo $arr4['name'];
$a1 = each($arr4);
var_dump($a1);
$a2 = each($arr4);
var_dump($a2);
// $arr5 = array('name'=>'马超','age'=>600);
// list($a1) = $arr5;
// var_dump($a1);
// echo '<hr>';
$my_array = array('name'=>'马超','age'=>600);

list($a, $b) = $my_array;
while(list($key,$value)=each($my_array)){
    echo '下标为：' . $key . '值为:' . $value .'<br>';
}
$arr6 = array(3,4,2,6,49,30,22,1,34);
for ($i=0; $i < count($arr6); $i++) { 
    
    for ($j=0; $j < count($arr6)-1-$i; $j++) { 
        
        if($arr6[$j] > $arr6[$j+1]){
            $temp = $arr6[$j];
            $arr6[$j] = $arr6[$j+1];
            $arr6[$j+1] = $temp;
        }
    }
}
var_dump($arr6);
class Car
{
    public $name;
    protected $carName;
    public function __construct($val1,$val2)
    {
        $this->name = $val1;
        $this->carName = $val2;
    }
    public function __set($key,$val)
    {
        var_dump(property_exists($this,$key)) ;
       if( property_exists($this,$key) )
       {
           $this->$key = $val; 
       }else{
           echo "没有这个键";
       }
    }
    public function __get($key)
    {
        if(property_exists($this,$key)){
            return $this->$key;
        }else{
            echo "没有这个键";
        }
    }
    public function __isset($key)
    {
        if(property_exists($this,$key))
        {
            return true;
        }else{
            return false;
        }
    }
    public function __unset($key)
    {
        if(property_exists($this,$key))
        {
            unset($this->$key);
        }else{
            echo "属性不存在，无法unset";
        }
    }
    public function __toString()
    {
        return '<br>名字：' . $this->name . '车标：' . $this->carName;
    }
}
$car = new Car("a","劳斯莱斯");
// $car->carName = "劳斯莱斯";
// echo $car->carName;

if(isset($car->carName)){
    echo '<br> name属性存在'; 
}
echo $car;
class Cat{
    private $name;
    private $age;
    private $sex;
    public function __construct($val1,$val2,$val3)
    {
        $this->name = $val1;
        $this->age = $val2;
        $this->sex = $val3;
    }
    public function __toString()
    {
        return '<br>名字：' . $this->name . '年龄：' . $this->age . "性别：" . $this->sex;
    }
}
$cat = new Cat('大白','5','公');
echo $cat;
class Monk{

    public $name;
    private $hobby;

    public function __construct($val1,$val2)
    {
        $this->name = $val1;
        $this->hobby = $val2;
    }
    public function showInfo(){
        echo '名字：'. $this->name;
        foreach ($this->hobby as $key => $value) {
            echo '<br>爱好有:' . $value;
        }
    }
    private function getSun($num1,$num2)
    {
        return $num1 + $num2;
    }
    public function __call($methodName,$parameters)
    {  

        if(method_exists($this,$methodName)){
            return $this->$methodName($parameters[0],$parameters[1]);
        }else{
            echo "没有这个函数";
        }
    }
}
$monk = new Monk('小明',array('抽烟','喝酒'));
$monk->showInfo();
echo $monk->getSun(1,2);

class Child{
    public $name;
    public static $num;
    public function __construct($val1)
    {
        //$this->name = $val1;
    }
    public function jsonGame($val)
    {
        echo $val . "加入游戏";
        self::$num++;
    }
    public function getNum()
    {
        echo "共有：".self::$num;
    }
}
$child = new Child();
$child->jsonGame("小白");
$child->getNum();
$child->jsonGame("小小黑");
$child->getNum();

class Student
{
    public $name;
    public $age;
    public function __construct($val1,$val2)
    {
        $this->name = $val1;
        $this->age = $val2;
    }
    public function setInfo($val1)
    {
        $this->name = $val1;
    }
    public function getInfo()
    {
        return $this->name;
    }
}
class Puli extends Student
{
    public function testing()
    {
        echo "测试1";
    }
}
class Puli1 extends Student
{
    public function testing2()
    {
        echo "测试2";
    }
}
$s1 = new Puli();
$s1->setInfo("小明");
echo $s1->getInfo();
$s2 = new Puli1();
$s2->setInfo("小黑");
echo $s2->getInfo();
echo $s1->getInfo();
echo $s2->getInfo();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="userName"/>
        <input type="submit" value="上传">
    </form>
</body>
</html>

