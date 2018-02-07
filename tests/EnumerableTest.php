<?php

use PHPUnit\Framework\TestCase;
use Vleks\SDK\Enumerables\CountryCode;
use Vleks\SDK\Enumerables\Currency;
use Vleks\SDK\Enumerables\Transporter;

class EnumerableTest extends TestCase
{
    public function testGetAllEnumeableOptions()
    {
        $this->assertEquals(32, count(Currency::getAll()));
        $this->assertEquals(246, count(CountryCode::getAll()));
        $this->assertEquals(24, count(Transporter::getAll()));
    }

    public function testCurrencyEnumerable()
    {
        $this->assertEquals('EUR', Currency::EUR);
    }

    public function testCountryCodeEnumerable()
    {
        $this->assertEquals('NL', CountryCode::NL);
    }

    public function testTransporterEnumerable()
    {
        $this->assertEquals('POSTNL', Transporter::POSTNL);
    }
}
