# think-swoole-socket
thinkphp swoole socket client&amp;server subscribe

### install
```text
composer require hahadu/think-swoole-socket
```

### main class
create class
Swoole.php
```php
namespace app;
use Hahadu\ThinkSwooleSocket\subscribe\Swooleable;
class Swoole extends Swooleable{
    public function onConnect($data){
       $this->push($data);
    }
}
```

### config
edit swoole.php for thinkphp config path  
```php
 [
 ...
  'websocket' => [
  ...
  'handler'       => Handler::class, //default
  ...
  'subscribe'     => [
            app\Swoole::class //
        ],
]
];
```

run console 
```textmate
php think swoole start
```

if you console show
````text
Starting swoole http server...
Swoole http server started: <http://127.0.0.1:9502> 
You can exit with `CTRL-C`

````

browser going
```text
http://127.0.0.1:9502
```