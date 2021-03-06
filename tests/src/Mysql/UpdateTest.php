<?php
namespace Aura\Sql_Query\Mysql;

use Aura\Sql_Query\Common;

class UpdateTest extends Common\UpdateTest
{
    protected $db_type = 'mysql';

    protected $expected_sql_with_flag = "
        UPDATE%s <<t1>>
            SET
                <<c1>> = :c1,
                <<c2>> = :c2,
                <<c3>> = :c3,
                <<c4>> = NULL,
                <<c5>> = NOW()
            WHERE
                foo = :auto_bind_0
                AND baz = :auto_bind_1
                OR zim = gir
            LIMIT 5
    ";

    public function testLowPriority()
    {
        $this->query->lowPriority()
                    ->table('t1')
                    ->cols(['c1', 'c2', 'c3'])
                    ->set('c4', null)
                    ->set('c5', 'NOW()')
                    ->where('foo = ?', 'bar')
                    ->where('baz = ?', 'dib')
                    ->orWhere('zim = gir')
                    ->limit(5);

        $actual = $this->query->__toString();
        $expect = sprintf($this->expected_sql_with_flag, ' LOW_PRIORITY');

        $this->assertSameSql($expect, $actual);
    }

    public function testIgnore()
    {
        $this->query->ignore()
                    ->table('t1')
                    ->cols(['c1', 'c2', 'c3'])
                    ->set('c4', null)
                    ->set('c5', 'NOW()')
                    ->where('foo = ?', 'bar')
                    ->where('baz = ?', 'dib')
                    ->orWhere('zim = gir')
                    ->limit(5);

        $actual = $this->query->__toString();
        $expect = sprintf($this->expected_sql_with_flag, ' IGNORE');

        $this->assertSameSql($expect, $actual);
    }
}
