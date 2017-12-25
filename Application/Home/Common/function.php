<?php
/**
 * 密码随机数
 * @return string
 */
function make_password($length = 6)
{
    // 密码字符集，可任意添加你需要的字符
    $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
        't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!',
        '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_',
        '[', ']', '{', '}', '<', '>', '~', '`', '+', '=', ',',
        '.', ';', ':', '/', '?', '|');

    // 在 $chars 中随机取 $length 个数组元素键名
    $keys = array_rand($chars, $length);

    $password = '';
    for ($i = 0; $i < $length; $i++) {
        // 将 $length 个数组元素连接成字符串
        $password .= $chars[$keys[$i]];
    }

    return $password;
}
/*
 * 返回JSON格式
 * @return json
*/
function renderJson($data = array(), $errMsg = '', $err = 0)
{
    echo json_encode(array('data' => $data, 'errno' => $err, 'errmsg' => $errMsg));
    exit;
}
function sendSMS($phoneNumber){
    header("Content-type: text/html; charset=utf-8");
    Vendor("SmsSender.SmsSender");
    $appid = 1400048305;
    $appkey = "ffedc047ffcc86aa5a4d5089acd5955b";
//    $phoneNumber = "13522807353";
    $templId = 53514;
    $singleSender = new \Vendor\SmsSender\SmsSingleSender($appid, $appkey);
    // 指定模板单发
    // 假设模板内容为：测试短信，{1}，{2}，{3}，上学。
    $rand = rand(1000,9999);
    $data = [
        "vcode"=>$rand,
        "phone"=>$phoneNumber,
        "ctime"=>time()
    ];
    M("vcode")->add($data);
    $params = array($rand);
    $result = $singleSender->sendWithParam("86", $phoneNumber, $templId, $params, "快手资讯","","");
    $rsp = json_decode($result,true);
    return $rsp['result'];
}
function validate_phone($tel){
    if(strlen($tel) == "11") {
        //上面部分判断长度是不是11位
        $n = preg_match_all("/13[0-9]\d{8}|14[0-9]\d{8}|15[0-9]\d{8}|18[0-9]\d{8}|17[0-9]\d{8}/",$tel,$array);
        /*接下来的正则表达式("/131,132,133,135,136,139开头随后跟着任意的8为数字 '|'(或者的意思)
        * 151,152,153,156,158.159开头的跟着任意的8为数字
        * 或者是188开头的再跟着任意的8为数字,匹配其中的任意一组就通过了
        * /")*/
        if( $n ){
            return true;
        }else{
            return false;
        }
    }else
    {
        return false;
    }
}
function addLogs($param,$file_name='logs'){
    if( is_array($param) ){
        $param = var_export($param,true);
    }
    $url = "/item/Logs/".$file_name.".txt";
    file_put_contents($url,$param);
}
function get_cate($field='',$sort = 0){
    $cate = M("category");
    if( $sort>0 ){
        $sql = "select * from category where id in($field) order by field(id,$field)";
        $data = $cate->query($sql);
    }else{
        $data = $cate->select();
    }
    return $data;
}
/**
 * total  总条数
 * limit  单页显示数量
 * page   获取到的页码
 */

function pagination($total = 0, $limit = 10, $page = 1)

{
    if (!$total) {
        $total = 0;
    }
    if (!$page) {
        $page = intval(I('post.page'));
    }
    if ($total == 0) {
        $totalpage = 1;
    } else {
        $totalpage = ceil($total / $limit);
    }
    $pageary = array();
    if ($page >= $totalpage) {
//        $currentpage = $totalpage;
        $currentpage = $page;
        $next = $totalpage;
        $prev = $totalpage - 1;
    } elseif ($page < 1) {
        $currentpage = 1;
        $next = $currentpage + 1;
        $prev = 1;
    } else {
        $currentpage = $page;
        $next = $page + 1;
        $prev = $page - 1;
    }
    $offset = ($currentpage - 1) * $limit;
    $pageary['start'] = $offset;
    $pageary['end'] = $offset + $limit;
    $pageary['total'] = $total;
    $pageary['offset'] = $offset;
    return $pageary;
}
function get_admin($admin_id){
    if( !$admin_id ) return '';
    return M("admin")->where("id=".$admin_id)->getField("username");
}
function get_company()
{
    $company = [
        "baidu" => "百度",
        "ali" => "阿里",
        "tengxun" => "腾讯",
        "xinlang" => "新浪",
        "huawei" => "华为",
        "jingdong" => "京东",
        "xiaomi" => "小米",
        "wangyi" => "网易",
        "360" => "360",
        "souhu" => "搜狐",
        "meituan" => "美团",
        "leshi" => "乐视",
        "lianxiang" => "联想",
        "weiruan" => "微软",
        "IBM" => "IBM",
        "weipinhui" => "唯品会",
        "qunaer" => "去哪儿",
        "xiecheng" => "携程",
        "58tongcheng" => "58同城",
        "sougou" => "搜狗",
        "youku" => "优酷",
        "didi" => "滴滴",
        "jumeiyoupin" => "聚美优品",
        "dazhongdianping" => "大众点评",
        "huanjushidai" => "欢聚时代",
        "liebao" => "猎豹",
        "jinshan" => "金山"
    ];
    return $company;
}
function get_classification(){
    $data = [
        0=>"技术",
        1=>"产品",
        2=>"设计",
        3=>"运营",
        4=>"咨询",
        5=>"其他"
    ];
    return $data;
}
function get_subclass(){
    $data = [
        0=>array("前端开发","后端开发","iOS/Android","微信开发","直播/小视频","爬虫","SEO/ASO","插件开发","性能优化","其他"),
        1=>array("产品原型","竞品分析","用户体验","其他"),
        2=>array("logo","海报/宣传册/PPT","UI设计","交互设计","活动页","视频制作","其他"),
        3=>array("文章写作","用户运营","活动策划","产品推销","其他"),
        4=>array("创业方法","团队培训","行业经验","融资","团队搭建","其他"),
        5=>'',
    ];
    return $data;
}