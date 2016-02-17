<?php
namespace a15lam\RpiGpio;

class GPIO
{
    const COMMAND = 'gpio';

    const PWM = 'pwm';

    const PWM_PIN = 1;

    const MODE = 'mode';

    const READ = 'read';

    const WRITE = 'write';

    const OUT = 'out';

    const IN = 'in';

    const ON = 1;

    const OFF = 0;

    public function mode($pin, $state)
    {
        return $this->execute(self::MODE, $pin, $state);
    }

    public function write($pin, $state)
    {
        return $this->execute(self::WRITE, $pin, $state);
    }

    public function pwm($pulse)
    {
        return $this->execute(static::PWM, static::PWM_PIN, $pulse);
    }

    protected function execute($command, $pin, $state)
    {
        exec(static::COMMAND . " " . $command . " " . $pin . " " . $state, $output);

        return $output;
    }

    public function setupPWM()
    {
        exec(static::COMMAND." ".static::MODE." ".static::PWM_PIN." pwm");
        exec(static::COMMAND." pwm-ms");
        exec(static::COMMAND." pwmc 400");
        exec(static::COMMAND." pwmr 1000");
    }
}
