<?php
// k近邻算法，归一化
$a = [ 
    [179, 42, 1],
    [178, 43, 1],
    [165, 36, 2],
    [177, 42, 1],
    [160, 35, 2],
];

$M1 = 19;
$M2 = 8;

$f = [167, 43];
foreach ($a as $k => $v) {
    $squa[$k] = sqrt(pow($v[0] - $f[0], 2) + pow($v[1] - $f[1], 2));
}
foreach ($a as $k => $v) {
    $squares[$k] = sqrt(pow($v[0]/$M1 - $f[0]/$M1, 2) + pow($v[1]/$M2 - $f[1]/$M2, 2));
}
var_dump($squa);
var_dump($squares);
exit;


$a = [
    '445985134043502816' => '111',
    '439798657391574176' => '222',
];
$b = [
    '439798657391574176' => [
        'aa1' => '1234',
        'aa2' => '4566',
    ],
];
$c = array_merge($a, $b);
var_dump($c);
exit;

var_dump(false === false);
exit;

$a = 12324;
$a = (string)$a;
var_dump($a);
exit;

$course = [
    '1857' => [
        '1' => ['number' => '1', 'par' => '4'],
        '2' => ['number' => '2', 'par' => '4'],
        '3' => ['number' => '3', 'par' => '4'],
        '4' => ['number' => '4', 'par' => '4'],
        '5' => ['number' => '5', 'par' => '4'],
        '6' => ['number' => '6', 'par' => '4'],
        '7' => ['number' => '7', 'par' => '4'],
        '8' => ['number' => '8', 'par' => '4'],
        '9' => ['number' => '9', 'par' => '4'],
        '10' => ['number' => '10', 'par' => '4'],
        '11' => ['number' => '11', 'par' => '4'],
        '12' => ['number' => '12', 'par' => '4'],
        '13' => ['number' => '13', 'par' => '4'],
        '14' => ['number' => '14', 'par' => '4'],
        '15' => ['number' => '15', 'par' => '4'],
        '16' => ['number' => '16', 'par' => '4'],
    ]
];
foreach ($course as $key => $value) {
var_dump($value);
    $value = array_values($value);
var_dump($value);
}
exit;

$a = "<font color='red'></font>";
$a = strip_tags($a);
var_dump($a);
exit;

$a = strtotime("2016-08-12T10:00:00+01:00");
var_dump($a);
exit;

function checkNum($number) {
    if ($number > 1) {
        throw new Exception("Value must be 1 or below");
    }
    return true;
}

try {
    checkNum(2);
    echo "if you see this, the number is 1 or below";
} catch (Exception $e) {
    echo 'Message:' . $e->getMessage(); 
}

exit;

interface Logger {
    public function log(string $msg);
}

class Application {
    private $logger;

    public function getLogger(): Logger {
        return $this->logger;
    }

    public function setLogger(Logger $logger) {
        $this->logger = $logger;
    }
}

$app = new Application();
$app->setLogger(new class implements Logger {
    public function log(string $msg) {
        print($msg);
    }
});
$app->getLogger()->log("我的第一条日志");

exit;


// curlMulti请求
$ch = array();
$res = array();
$conn = array();

$urls = array(
    'baidu' => 'http://www.baidu.com/',
    'cheyun' => 'http://auto.jrj.com.cn/',
    'w3c' => 'http://www.w3cschool.cc/',
);

// 创建批处理curl句柄
$mh = curl_multi_init();

foreach ($urls as $i => $url) {
    $conn[$i] = curl_init();    // 初始化各个子链接
    
    curl_setopt($conn[$i], CURLOPT_URL, $url);
    curl_setopt($conn[$i], CURLOPT_HEADER, 0);
    curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($conn[$i], CURLOPT_TIMEOUT, 10);

    curl_setopt($conn[$i], CURLOPT_FOLLOWLOCATION, 1);

    curl_multi_add_handle($mh, $conn[$i]);
}

$active = null;

do{
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);

while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) != -1) {
        do{
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
}

foreach ($urls as $i => $url) {
    $info = curl_multi_info_read($mh);
    $heards = curl_getinfo($conn[$i]);
    var_dump($heards);
    $res[$i] = curl_multi_getcontent($conn[$i]);
    curl_multi_remove_handle($mh, $conn[$i]);
    curl_close($conn[$i]);
}

curl_multi_close($mh);
//var_dump($res);
exit;


// 根据order值分组，同一个order中时间不能交叉
$a = [
    ['st' => '100', 'et' => '120', 'order' => 1],
    ['st' => '100', 'et' => '120', 'order' => 2],
    ['st' => '100', 'et' => '120', 'order' => 3],
    ['st' => '120', 'et' => '130', 'order' => 1],
    ['st' => '120', 'et' => '150', 'order' => 4],
    ['st' => '90',  'et' => '100', 'order' => 1],
];
foreach ($a as $key => $value) {
    $b['order'.$value['order']][] = $value;
}

foreach ($b as $key => $value) {
    array_multisort(
        array_column($value, 'st'),
        SORT_ASC,
        $value
    );
    
    $num = count($value);
    for ($i = 1; $i < $num; $i++) {
        $pre = $value[$i - 1];
        $current = $value[$i];
        if ($pre['st'] < $current['et'] && $pre['et'] > $current['st']) {
            echo '有重复';
            exit;
        }
    }
}
echo '无重复';
exit;

array_multisort(
    array_column($a, 'st'),
    SORT_ASC,
    $a
);
var_dump($a);
exit;

$num = count($a);
for ($i = 1; $i <= $num; $i++) {
    $pre = $a[$i - 1];
    $current = $a[$i];
    if ($pre['st'] < $current['et'] && $pre['et'] > $pre['st']) {
        echo false;
    }
}

echo true;
exit;




var_dump($b);
exit;

foreach ($a as $key => $value) {
    $col[$key] = $value['order'];
}

array_multisort($col, SORT_ASC, $a);

var_dump($a);
exit;



$a = [
    'a', 'b', 'c', 'a',
];
$b = array_unique($a);
var_dump(count($a));
exit;


array_unshift($a, 'e');
var_dump($a);
exit;

$a = 7;
$b = 7;
$c = $a%$b;
echo $c;
exit;


$input1 = array('a' => 'green', 'B' => 'brown', 'c' => 'blue', 'red');
//$input1 = array('a' => 'green', 'B' => 'brown', 'c1' => 'blue');
$input2 = array('a' => 'Green', 'B' => 'brown', 'yellow');
// $input3 = array('a' => 'Green', 'B' => 'brown');

//$input1 = ['a', 'b', 'c'];
//$input2 = ['b', 'c', 'c'];

$res = array_intersect_uassoc($input1, $input2, "myfunction");
//$res = array_intersect_uassoc($input1, $input2, "strcasecmp");
function myfunction($str1, $str2) {
    if ($str1 === $str2) {
        return 0;
    }
    return ($str1>$str2) ? 1 : -1;
}
var_dump($res);
exit;


$arr =  array('13', 11, 5);
$res = in_array(13, $arr, true);
var_dump($res);
exit;



$a = [123, 321, 111];
var_dump(in_array(123, $a));
exit;

$arr = [
'url' => 'aa',
    'matchid' => 'bb',
    'mid' => 'cc',
    'type' => 'dd',
    ];
$url = $arr['url'];
unset($arr['url']);
$query = http_build_query($arr);
$url = $url . '?' . $query;
echo $url;
exit;

preg_match_all('/(foo)(bar)(baz)/', 'foobarbaz', $matchs);
preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matchs2);
var_dump($matchs);
var_dump($matchs2);
exit;

function king($n, $m) {
    $monkey = range(1, $n);
    $i = 0;
    while (count($monkey) > 1) {
        $i++;
        $head = array_shift($monkey);
        if ($i%$m != 0) {
            array_push($monkey, $head);
        }
    }
    return $monkey[0];
}
echo '剩余' . king(3, 4) . '号猴子';
exit;

$a = intval(time());
var_dump($a);
exit;

$url = 'https://ab.youku.com/videos/player/file?data=WcEl5oEuRdXhNRFF3TVRBMk5BPT18MHwwfDEwMDg3MTR8MAO0O0OO0O0O';
$a = preg_match('/^(http[s]?:\/\/(.*?).youku.com)\/(.*)/', $url, $matchs);
var_dump($matchs);
exit;



$video_id = 0;
var_dump(empty($video_id));
exit;

$a = 0;
for ($i =1 ; $i<= 5; $i++) {
    for ($j = 1; $j <= $i; $j++){
        $a++; 
    }
}
echo $a;
exit;

function quicksort($a, $left, $right, $k) {
    $temp = $a[$left];

    if ($left > $right) {
        return $a;
    }

    $i = $left;
    $j = $right;
    while($i != $j) {
        while ($a[$j] >= $temp && $i < $j) {
            $j--;
        }

        while ($a[$i] <= $temp && $i < $j) {
            $i++;
        }

        if ($i < $j) {
            $t = $a[$j];
            $a[$j] = $a[$i];
            $a[$i] = $t;
        }
    }
    $a[$left] = $a[$i];
    $a[$i] = $temp;
    var_dump($a);
    $k++;
    if ($k > 11) exit;

    quicksort($a, $left, $i, $k);
    quicksort($a, $i+1, $right, $k);
    return $a;
}

$a = array(6, 1, 2, 7, 9, 3, 4, 5, 10, 8);
$a = quicksort($a, 0, 9, 0);
var_dump($a);
exit;


phpinfo();
exit;

$str = 123.9;
$str=strval($str);   //转换后字符串："123.9"    
var_dump($str);
exit;

phpinfo();
exit;

$goo = [
'bar' => [
'baz' => 100,
    'cug' => 900,
    ],
    ];
$foo = "goo";
print_r($$foo["bar"]['baz']);
