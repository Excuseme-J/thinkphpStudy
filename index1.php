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
}
$car = new Car("a","劳斯莱斯");
$car->carName = "劳斯莱斯";
echo $car->carName;
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

