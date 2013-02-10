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
 * Adapter-Abstract
 *
 * @author Hans-Peter Buniat <hpbuniat@googlemail.com>
 * @copyright 2011-2013 Hans-Peter Buniat <hpbuniat@googlemail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version Release: @package_version@
 * @link https://github.com/hpbuniat/notifyy
 */
abstract class Builder {

    /**
     * notifyy's name
     *
     * @var string
     */
    const NAME = 'notifyy';

    /**
     * Init a Adapter
     *
     * @param  mixed $mAdapter
     * @param  mixed $mConfig
     *
     * @return Notifyable
     *
     * @throws Exception
     */
    public static function build($mAdapter, $mConfig = null) {

        $sClass = $mAdapter;
        if (is_string($mAdapter) === true and class_exists($mAdapter) !== true) {
            $sClass = sprintf('\\notifyy\\Adapter\\%s', ucfirst(strtolower($mAdapter)));
        }

        $oNotifier = null;
        if (is_string($mAdapter) === true and class_exists($sClass) === true) {
            $oReflection = new \ReflectionClass($sClass);
            if ($oReflection->implementsInterface('\notifyy\Notifyable') === true) {
                $oNotifier = new $sClass();

                /* @var $oNotifier AbstractAdapter */
                if ($oReflection->hasMethod('setConfig') === true) {
                    $oNotifier->setConfig(self::_buildConfig($mConfig));
                }
            }
        }
        else {
            $oNotifier = $mAdapter;
        }

        if (($oNotifier instanceof Notifyable) !== true) {
            throw new Exception(Exception::UNKNOWN_ADAPTER);
        }

        return $oNotifier;
    }

    /**
     * Create the notifyy-config
     *
     * @param  mixed $mConfig
     *
     * @return \stdClass
     */
    protected static function _buildConfig($mConfig) {
        $oConfig = new \stdClass();
        if (is_array($mConfig) === true) {
            foreach($mConfig as $sKey => $mValue) {
                $oConfig->$sKey = $mValue;
            }
        }
        elseif ($mConfig instanceof \stdClass) {
            $oConfig = $mConfig;
        }

        return $oConfig;
    }

}
