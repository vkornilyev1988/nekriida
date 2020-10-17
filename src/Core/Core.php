<?php


namespace Nekrida\Core;

use Nekrida\Routing\Router;

require_once __DIR__ . '/Autoloader.php';

class Core
{
	public function prepare($root) {

		$isComposer = !!spl_autoload_functions();

		if (!$isComposer) {
			//Load autoloader
			$autoLoader = new Autoloader();
			$autoLoader->register();
			$autoLoader->addNamespace('Nekrida', __DIR__ . '/../');
		}

		//Load config
		Config::setRoot($root);
		Config::importAll();

		if (!$isComposer) {
			//Load namespaces
			foreach (Config::get('app/namespaces') as $namespace => $dir) {
				$autoLoader->addNamespace(
					$namespace,
					str_replace('{root}', Config::root(), $dir)
				);
			}
		}
	}

	public function run($root) {
		$this->prepare($root);

		//Start session
		session_start();

		//$session = new Session(isset($_COOKIE['PHP_SESS']) ? $_COOKIE['PHP_SESS'] : '');
		//$session->open();
		//$session->clearOld();

		$nekro = new Request();
		$nekro->setUrl(strtok($_SERVER["REQUEST_URI"],'?'))
			->setDomain($_SERVER['SERVER_NAME'])
			->setGet($_GET)
			->setPost($_POST)
			->setCookie($_COOKIE)
			->setServer($_SERVER)
			->setSession($_SESSION)
			//->setSession($session)
			->setFiles($_FILES);

		Response::setStatus(200);
		Response::clearHeaders();

		//Use router and get response
		$router = new Router($nekro);
		$response = $router->run();

		//FOR regular servers
		http_response_code(Response::getStatus());

		//FOR EasyWebServer
		//$_SERVER['__SRV']->status(Response::getStatus());

		foreach (Response::getHeaders() as $header => $value) {
			//FOR regular servers
			header($header.': '.$value);
			//FOR EasyWebServer
			//$_SERVER['__SRV']->header($key.': '.$value);
		}
		if ($response instanceof Response) {
			foreach ($response->getCookies() as $cookie => $array) {
				//FOR regular servers
				setcookie($cookie,$array['value'],$array['Expires'],$array['Path'],$array['Domain'],$array['Secure'],$array['HttpOnly']);
				//FOR EasyWebServer
	//			$cookieStr = 'Set-Cookie: '.$cookie. '='.$array['value'];
	//			foreach (['Expires','Path','Domain','Secure','HttpOnly'] as $option)
	//				if ($array[$option])
	//					if (is_bool($array[$option]))
	//						$cookieStr .= '; ' . $option;
	//					else
	//						$cookieStr .= '; ' . $option . '=' . $array[$option];
	//			$_SERVER['__SRV']->header($cookieStr);
			}
			if ($response->hasLink())
				$response->printLink();
			else
				echo $response->getBody();
		} else {
			echo $response;
		}

		//$session->close();

	}
}