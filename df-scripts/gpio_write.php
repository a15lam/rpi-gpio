<?php
if(\Request::method() === 'POST'){
    $pin = \Request::input('pin');
    $state = \Request::input('state');

    if((empty($pin) && $pin !== 0) || (empty($state) && $state !== 0)){
        throw new \DreamFactory\Core\Exceptions\BadRequestException('Please provide pin and state data');
    }

    $gpio = new \a15lam\RpiGpio\GPIO();
    $result = $gpio->write($pin, $state);
    $result = empty($result)? ['success' => true] : $result;

    return \DreamFactory\Core\Utility\ResourcesWrapper::cleanResources($result);
} else {
    throw new \DreamFactory\Core\Exceptions\BadRequestException('Only POST is accepted');
}