<?php
/**
 * Ion
 *
 * Building blocks for web development
 *
 * @package     Ion
 * @author      Timothy J. Warren
 * @copyright   Copyright (c) 2015 - 2016
 * @license     MIT
 */

namespace Aviat\Ion;

use Psr\Http\Message\ResponseInterface;

use Aviat\Ion\Di\ContainerInterface;
use Aviat\Ion\Exception\DoubleRenderException;
use Aviat\Ion\Type\StringType;

/**
 * Base view response class
 */
abstract class View /* partially */ implements ViewInterface {

	use Di\ContainerAware;
	use StringWrapper;

	/**
	 * HTTP response Object
	 *
	 * @var ResponseInterface
	 */
	public $response;

	/**
	 * If the view has sent output via
	 * __toString or send method
	 *
	 * @var boolean
	 */
	protected $hasRendered = FALSE;

	/**
	 * Constructor
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->setContainer($container);
		$this->response = $container->get('response');
	}

	/**
	 * Send output to client
	 */
	public function __destruct()
	{
		if ( ! $this->hasRendered)
		{
			$this->send();
		}
	}

	/**
	 * @inheritdoc
	 */
	public function __toString()
	{
		if ($this->hasRendered)
		{
			throw new DoubleRenderException();
		}
		$this->hasRendered = TRUE;
		return $this->getOutput();
	}

	/**
	 * @inheritdoc
	 */
	public function setOutput($string)
	{
		$this->response->getBody()->write($string);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function appendOutput($string)
	{
		return $this->setOutput($string);
	}

	/**
	 * @inheritdoc
	 */
	public function getOutput()
	{
		return $this->response->getBody()->__toString();
	}
}
// End of View.php