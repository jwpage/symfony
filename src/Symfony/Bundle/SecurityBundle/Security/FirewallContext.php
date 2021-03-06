<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\SecurityBundle\Security;

use Symfony\Component\Security\Http\Firewall\ExceptionListener;

/**
 * This is a wrapper around the actual firewall configuration which allows us
 * to lazy load the context for one specific firewall only when we need it.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class FirewallContext
{
    private $listeners;
    private $exceptionListener;
    private $config;

    public function __construct(array $listeners, ExceptionListener $exceptionListener = null, FirewallConfig $config = null)
    {
        $this->listeners = $listeners;
        $this->exceptionListener = $exceptionListener;
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @deprecated since version 3.3, will be removed in 4.0. Use {@link getListeners()} instead.
     */
    public function getContext()
    {
        @trigger_error(sprintf('Method %s() is deprecated since version 3.3 and will be removed in 4.0. Use %s::getListeners() instead.', __METHOD__, __CLASS__), E_USER_DEPRECATED);

        return $this->getListeners();
    }

    public function getListeners()
    {
        return array($this->listeners, $this->exceptionListener);
    }
}
