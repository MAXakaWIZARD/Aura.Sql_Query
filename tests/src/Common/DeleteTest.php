<?php
namespace Aura\Sql_Query\Common;

use Aura\Sql_Query\AbstractQueryTest;

class DeleteTest extends AbstractQueryTest
{
    protected $query_type = 'delete';
    
    public function testCommon()
    {
        $this->query->from('t1')
                    ->where('foo = ?', 'bar')
                    ->where('baz = ?', 'dib')
                    ->orWhere('zim = gir');
                    
        $actual = $this->query->__toString();
        $expect = "
            DELETE FROM <<t1>>
            WHERE
                foo = :auto_bind_0
                AND baz = :auto_bind_1
                OR zim = gir
        ";
        
        $this->assertSameSql($expect, $actual);
    }
}
