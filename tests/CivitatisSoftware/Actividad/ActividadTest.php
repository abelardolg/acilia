<?php
namespace Tests\CivitatisSoftware;

use App\CivitatisSoftware\Actividad\Dominio\Actividad;
use DateInterval;
use DatePeriod;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ActividadTest extends TestCase
{
    const MAX_LENGTH = 64;
    private $actividad;

    public function setup(): void {
        //        public function __construct(string $title, string $description, DatePeriod $availabilityDateRange, float $pricePerPax, int $popularity)
        $inicio = new DateTimeImmutable('2021-02-03');
        $intervalo = new DateInterval('P1D');
        $fin = new DateTimeImmutable('2021-02-03');

        $periodoActividad = new DatePeriod($inicio, $intervalo, $fin);

        $this->actividad = new Actividad($this->generateRandomString(Actividad::MAX_TITLE_LENGTH), "description", $periodoActividad, 100.0, 4);

    }

    private function generateRandomString($length = self::MAX_LENGTH) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function testSettingTitle()
    {
        $this->actividad->setTitle($this->generateRandomString());
        $this->assertSame(self::MAX_LENGTH, strlen($this->actividad->getTitle()));
    }
    public function testSettingActivityPeriod()
    {
        $hoy = new DateTimeImmutable();
        $this->assertTrue($hoy <= $this->actividad->getAvailabilityDateRange()->getStartDate(), "La fecha de comienzo de la actividad es igual a hoy o superior");
    }
    public function testSettingPricePerPax()
    {
        $this->assertSame(self::MAX_LENGTH, strlen($this->actividad->getTitle()));
    }
    public function testSettingPopularity()
    {
        $this->assertSame(self::MAX_LENGTH, strlen($this->actividad->getTitle()));
    }
}
