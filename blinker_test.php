<?PHP
include('src/GPIO.php');

$gpio = new \a15lam\RpiGpio\GPIO();
$gpio->mode(0, 'out');
$gpio->mode(2, 'out');

while(true)
{
	$gpio->write(0, 1);
	
	sleep(1);

	$gpio->write(0, 0);
	$gpio->write(2, 1);

	sleep(1);

	$gpio->write(2, 0);
}
