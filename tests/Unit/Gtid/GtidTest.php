<?php

namespace Unit\Gtid;

use MySQLReplication\Gtid\Gtid;
use Unit\BaseTest;

/**
 * Class GtidTest
 * @package Unit\Gtid
 */
class GtidTest extends BaseTest
{
    /**
     * @param string $data
     * @return Gtid
     */
    private function getGtid($data)
    {
        return new Gtid($data);
    }

    /**
     * @test
     */
    public function shouldGetEncoded()
    {
        $this->assertSame('9b1c8d182a7611e5a26b000c2976f3f301000000000000000100000000000000b8b5020000000000', bin2hex($this->getGtid('9b1c8d18-2a76-11e5-a26b-000c2976f3f3:1-177592')->getEncoded()));
        $this->assertSame('9b1c8d182a7611e5a26b000c2976f3f3010000000000000001000000000000000200000000000000', bin2hex($this->getGtid('9b1c8d18-2a76-11e5-a26b-000c2976f3f3:1')->getEncoded()));
    }

    /**
     * @test
     */
    public function shouldGetEncodedLength()
    {
        $this->assertSame(40, $this->getGtid('9b1c8d18-2a76-11e5-a26b-000c2976f3f3:1-177592')->getEncodedLength());
    }

    /**
     * @test
     * @expectedException \MySQLReplication\Gtid\GtidException
     * @expectedExceptionMessage MySQLReplication\Gtid\GtidException::INCORRECT_GTID_MESSAGE
     * @expectedExceptionCode MySQLReplication\Gtid\GtidException::INCORRECT_GTID_CODE
     */
    public function shouldThrowErrorOnIncrrectGtid()
    {
        $this->getGtid('not gtid');
    }
}