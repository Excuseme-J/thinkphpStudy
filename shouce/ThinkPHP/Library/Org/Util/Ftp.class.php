<?php
/**
 * FTP - 操作FTP文件类.
 *
 * author     TaoTao
 * copyright  Copyright (c) 2013 TaoTao
 * license    New BSD License
 * conn       http://blog.kisscn.com/
 * version    1.0
 */
class Ftp {
    private  $host;
    private  $port=21;
    private  $user;
    private  $pwd;
    private  $conn;
    private $timeout;
    private $ssl=false;
    //传送模式{文本模式:FTP_ASCII, 二进制模式:FTP_BINARY}
    public $mode = FTP_BINARY;
    public function __construct($host,$port=21,$user,$pwd,$timeout=60,$mode=FTP_BINARY,$ssl=false){
        $this->host=$host;
        $this->port=$port;
        $this->user=$user;
        $this->pwd=$pwd;
        $this->mode=$mode;
        $this->timeout=$timeout;
        $this->ssl=$ssl;
        if($ssl){
            $this->conn=ftp_ssl_connect($this->host,$this->port,$this->timeout) or die("FTP连接失败！");
        }else{
            $this->conn=ftp_connect($this->host,$this->port,$this->timeout) or die("FTP连接失败！");
        }
        ftp_login($this->conn, $user, $pwd) or die("无法打开FTP连接");
    }

    /**
     * 返回给定目录的文件列表
     * param string $dirname  目录地址
     * return array 文件列表数据
     */
    public function nlist($dirname) {
        return ftp_nlist($this->conn, $dirname);
    }
    /**
     * 返回上级目录
     * return boolean
     */
    function back_dir()
    {
        return ftp_cdup($this->conn);
    }
    /**
     * 取得指定目录下文件的详细列表信息
     * param $dirname 目录名称
     * return ArrayObject
     */
    function get_file_info($dirname)
    {
        $list = ftp_rawlist($this->conn,$dirname);
        if(!$list) return false;
        $array = array();
        foreach($list as $l)
        {
            $l = preg_replace("/^.*[ ]([^ ]+)$/", "\\1", $l);
            if($l == '.' || $l == '..') continue;
            $array[] = $l;
        }
        return $array;
    }
    /**
     * 创建文件夹
     * param string $dirname 目录名，
     */
    public function mkdir($dirname) {
        $dirname = $this->checkDir($dirname);
        $nowdir = '/';
        foreach ($dirname as $v) {
            if ($v && !$this->cd($nowdir . $v)) {
                if ($nowdir)
                    $this->cd($nowdir);
                ftp_mkdir($this->conn, $v);
            }
            if ($v)
                $nowdir .= $v . '/';
        }
        return true;
    }
    /**
     * 文件和目录重命名
     * param $old_name 原名称
     * param $new_name 新名称
     * return boolean
     */
    function rename($old_name,$new_name)
    {
        return ftp_rename($this->conn,$old_name,$new_name);
    }
    /**
     * 上传文件
     * param string $remote 远程存放地址
     * param string $local 本地存放地址
     */
    public function put($remote, $local) {

        $dirname = pathinfo($remote, PATHINFO_DIRNAME);
        $remote = pathinfo($remote, PATHINFO_BASENAME);
        if (!$this->cd($dirname))
            $this->mkdir($dirname);
        if (ftp_put($this->conn, $remote, $local, $this->mode))
            return true;
        else
            return false;
    }
    /**
     * 获取文件的最后修改时间
     * return string $time 返回时间
     */
    public function lastUpdatetime($file){
        return ftp_mdtm($this->conn,$file);
    }

    /**
     * 删除指定文件
     * param string $filename 文件名
     */
    public function delete($filename) {
        return ftp_delete($this->conn, $filename);
    }

    /**
     * 在 FTP 服务器上改变当前目录
     * param string $dirname 修改服务器上当前目录
     */
    public function cd($dirname) {
        return ftp_chdir($this->conn, $dirname);
    }
    /**
     * 在 FTP 服务器上返回当前目录
     * return string $dirname 返回当前目录名称
     */
    public function getPwd() {
        return ftp_pwd($this->conn);

    }
    /**
     * 检测目录名
     * param string $url 目录
     * return 由 / 分开的返回数组
     */
    private function checkDir($url) {
        $url = str_replace('', '/', $url);
        $urls = explode('/', $url);
        return $urls;
    }
    /**
     * 检测是否为目录
     * param string $dir 路径
     * return boolean true为目录false为文件
     */
    public function isDir($dir) {
        return $this->cd($dir);
    }
    /**
     * 检测文件是否存在
     * param string $file 路径
     * return boolean true为存在false为否
     */
    public function fileSize($file) {
        logs('==============fileSize===============', $file. ftp_size($this->conn, $file));
        logs('=============fileSize2===============', (function_exists('ftp_size'))?'true':'false');
        return ftp_size($this->conn, $file);
    }
    /**
     * 关闭FTP连接
     */

    public function close() {
        return ftp_close($this->conn);
    }
}

