<?php


namespace Hahadu\ThinkSwooleSocket\interfaces;


use Swoole\WebSocket\Frame;
use think\Request;

/*****
 * subscribe Interface WebsocketInterface
 * @package Hahadu\ThinkSwooleSocket\interfaces
 */
interface WebsocketInterface
{
    /**
     * "onOpen" listener.
     * @param Request $request
     */
    public function onOpen($request);
    /**
     * "onMessage" listener.
     *
     * @param Frame $frame
     */
    public function onMessage($frame);

    public function onConnect($data);
    /**
     * "onClose" listener.
     *
     * @param int $fd
     * @param int $reactorId
     */
    public function onClose($fd);



}