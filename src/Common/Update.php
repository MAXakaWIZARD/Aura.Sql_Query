<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @package Aura.Sql
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Sql_Query\Common;

use Aura\Sql_Query\AbstractQuery;
use Aura\Sql_Query\Traits;

/**
 *
 * An object for UPDATE queries.
 *
 * @package Aura.Sql
 *
 */
class Update extends AbstractQuery implements UpdateInterface
{
    use Traits\ValuesTrait;
    use Traits\WhereTrait;

    /**
     *
     * The table to update.
     *
     * @var string
     *
     */
    protected $table;

    /**
     *
     * Sets the table to update.
     *
     * @param string $table The table to update.
     *
     * @return $this
     *
     */
    public function table($table)
    {
        $this->table = $this->quoteName($table);
        return $this;
    }
    
    protected function build()
    {
        $this->stm = 'UPDATE';
        $this->buildFlags();
        $this->buildTable();
        $this->buildValuesForUpdate();
        $this->buildWhere();
        return $this->stm;
    }
    
    protected function buildTable()
    {
        $this->stm .= " {$this->table}";
    }
}
