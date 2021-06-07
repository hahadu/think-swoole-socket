<?php


namespace Hahadu\ThinkSwooleSocket\subscribe;


use Hahadu\ThinkSwooleSocket\interfaces\WebsocketInterface;
//use Swoole\Server;
use Swoole\WebSocket\Frame;
use think\cache\driver\Redis;
use think\Config;
use think\Request;
use think\swoole\Websocket;
use think\swoole\websocket\socketio\Packet;
use Swoole\Lock;


abstract class Swooleable implements WebsocketInterface
{
    /****
     * @var Websocket
     */
    protected $websocket;    //websocket对象
    /****
     * @var Server
     */
    protected $server;    //server对象
    /*****
     * @var Config
     */
    protected $config;
    /****
     * @var \Redis
     */
    protected $redis;
    /****
     * @var int
     */
    protected $fd;

    /*****
     * @var Lock
     */
    protected $lock;

    public function __construct(Websocket $websocket, Config $config){
        $this->websocket = $websocket;//依赖注入的方式
    //    $this->server = $server;
        $this->config = $config;
        $this->redis = new Redis();
        $this->lock = new Lock();
    }


    /**
     * "onOpen" listener.
     * @param Request $request
     */
    public function onOpen($request)
    {
        $this->fd = $this->websocket->getSender();

    }

    /**
     * "onMessage" listener.
     *
     * @param Frame $frame
     */
    public function onMessage($frame){

    }

    /**
     * "onClose" listener.
     *
     * @param int $fd
     * @param int $reactorId
     */
    public function onClose($fd)
    {
        //主动断开连接使用disconnect()
    //    $this->server->reload();
    }
    /*****
     * 推送数据
     * @param mixed $data
     * @return bool
     */
    public function push($data){
        $data = Packet::create(Packet::CONNECT,['data'=>$data]);
        return $this->websocket->push($data);
    }

    /*****
     * 推送数据
     * @param $message
     * @param string $value
     * @param int $code
     * @return bool
     */
/*    protected function wsPush($message, $value = '', $code = 1)
    {

        $type = ($code == 1) ? 'success' : 'error';
        $_data = wrap_msg_array($code, $message, [
            'fd' => $this->fd,
            'type' => $type,
            "value" => $value
        ]);

        return $this->push($_data);
    }*/


}