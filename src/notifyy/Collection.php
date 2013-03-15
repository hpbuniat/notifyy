<?php
/**
 * notifyy
 *
 * Copyright (c) 2011-2013, Hans-Peter Buniat <hpbuniat@googlemail.com>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 * * Redistributions of source code must retain the above copyright
 * notice, this list of conditions and the following disclaimer.
 *
 * * Redistributions in binary form must reproduce the above copyright
 * notice, this list of conditions and the following disclaimer in
 * the documentation and/or other materials provided with the
 * distribution.
 *
 * * Neither the name of Hans-Peter Buniat nor the names of his
 * contributors may be used to endorse or promote products derived
 * from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package notifyy
 * @author Hans-Peter Buniat <hpbuniat@googlemail.com>
 * @copyright 2011-2013 Hans-Peter Buniat <hpbuniat@googlemail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */
namespace notifyy;

/**
 * Adapter-Collection as wrapper for multiple adapters
 *
 * @author Hans-Peter Buniat <hpbuniat@googlemail.com>
 * @copyright 2011-2013 Hans-Peter Buniat <hpbuniat@googlemail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version Release: @package_version@
 * @link https://github.com/hpbuniat/notifyy
 */
class Collection implements Notifyable {

    /**
     * Stack of adapter-instances
     *
     * @var array
     */
    protected $_aAdapter = array();

    /**
     * Add an adapter to the stack
     *
     * @param  Notifyable $oAdapter
     *
     * @return $this
     */
    public function add(Notifyable $oAdapter) {
        $this->_aAdapter[get_class($oAdapter)] = $oAdapter;
        return $this;
    }

    /**
     * Get the number of registered adapter
     *
     * @return int
     */
    public function count() {
        return count($this->_aAdapter);
    }

    /**
     * (non-PHPdoc)
     * @see \notifyy\NotifyAble::notify()
     */
    public function notify($sStatus, $sText, $sContext = \notifyy\Builder::NAME) {
        foreach ($this->_aAdapter as $oAdapter) {

            /* @var $oAdapter \notifyy\Notifyable */
            $oAdapter->notify($sStatus, $sText, $sContext);
        }
    }

    /**
     * (non-PHPdoc)
     * @see \notifyy\NotifyAble::setConfig()
     */
    public function setConfig(\stdClass $oConfig = null) {
        /* nop */

        return $this;
    }
}
