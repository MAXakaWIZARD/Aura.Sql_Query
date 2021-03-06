<?php
namespace Aura\Sql_Query\Common;

use Aura\Sql_Query\AbstractQueryTest;

class InsertTest extends AbstractQueryTest
{
    protected $query_type = 'insert';
    
    public function testCommon()
    {
        $this->query->into('t1')
                    ->cols(['c1', 'c2', 'c3'])
                    ->set('c4', 'NOW()')
                    ->set('c5', null);
        
        $actual = $this->query->__toString();
        $expect = '
            INSERT INTO <<t1>> (
                <<c1>>,
                <<c2>>,
                <<c3>>,
                <<c4>>,
                <<c5>>
            ) VALUES (
                :c1,
                :c2,
                :c3,
                NOW(),
                NULL
            )
        ';
        
        $this->assertSameSql($expect, $actual);
    }
    
    public function testGetLastInsertIdName()
    {
        $this->assertNull($this->query->getLastInsertIdName('no matter'));
    }
}
