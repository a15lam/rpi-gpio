<?php
if(\Request::method() === 'POST'){
    $pulse = \Request::input('pulse');

    if(empty($pulse)){
        throw new \DreamFactory\Core\Exceptions\BadRequestException('Please provide pulse data');
    }

    if($pulse < 27) $pulse = 27;
    if($pulse > 107) $pulse = 107;

    $gpio = new \a15lam\RpiGpio\GPIO();
    $gpio->setupPWM();
    $result = $gpio->pwm($pulse);
    $result = empty($result)? ['success' => true] : $result;

    return \DreamFactory\Core\Utility\ResourcesWrapper::cleanResources($result);
} else {
    throw new \DreamFactory\Core\Exceptions\BadRequestException('Only POST is accepted');
}