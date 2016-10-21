<?php declare(strict_types=1);
/**
 * Ion
 *
 * Building blocks for web development
 *
 * PHP version 7
 *
 * @package     Ion
 * @author      Timothy J. Warren <tim@timshomepage.net>
 * @copyright   2015 - 2016 Timothy J. Warren
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version     1.0.0
 * @link        https://git.timshomepage.net/timw4mail/ion
 */

namespace Aviat\Ion\View;

use Zend\Diactoros\Response\SapiEmitter;

use Aviat\Ion\Exception\DoubleRenderException;
use Aviat\Ion\View as BaseView;

/**
 * Base view class for Http output
 */
class HttpView extends BaseView {

	/**
	 * Response mime type
	 *
	 * @var string
	 */
	protected $contentType = '';

	/**
	 * Do a redirect
	 *
	 * @codeCoverageIgnore
	 * @param string $url
	 * @param int    $code
	 * @return void
	 */
	public function redirect(string $url, int $code)
	{
		ob_start();
		$message = $this->response->getReasonPhrase($code);
		$this->setStatusCode($code);
		$this->response->withHeader('Location', $url);

		if (PHP_SAPI !== 'cli')
		{
			header("HTTP/1.1 ${code} ${message}");
			header("Location: {$url}");
		}

		$this->hasRendered = TRUE;
		ob_end_clean();
	}

	/**
	 * Set the status code of the request
	 *
	 * @param int $code
	 * @return HttpView
	 */
	public function setStatusCode(int $code): HttpView
	{
		$this->response = $this->response->withStatus($code)
			->withProtocolVersion('1.1');
		return $this;
	}

	/**
	 * Send output to client. As it renders the view,
	 * any attempt to call again will result in a DoubleRenderException.
	 *
	 * @throws DoubleRenderException
	 * @return void
	 */
	public function send()
	{
		$this->output();
	}

	/**
	 * Send the appropriate response
	 *
	 * @codeCoverageIgnore
	 * @throws DoubleRenderException
	 * @return void
	 */
	protected function output()
	{
		if ($this->hasRendered)
		{
			throw new DoubleRenderException();
		}

		$this->response = $this->response->withHeader('Content-type', "{$this->contentType};charset=utf-8")
			->withHeader('Content-Security-Policy', "script-src 'self'")
			->withHeader('X-Content-Type-Options', 'nosniff')
			->withHeader('X-XSS-Protection', '1;mode=block')
			->withHeader('X-Frame-Options', 'SAMEORIGIN');

		$sender = new SapiEmitter($this->response);
		$sender->emit($this->response);

		$this->hasRendered = TRUE;
	}
}