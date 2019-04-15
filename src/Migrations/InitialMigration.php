<?php
namespace Psa\Invoicing;

/**
 * Initial Migration
 */
class InitialMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('invoice_lines', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', ['null' => false])
            ->addColumn('article_id', 'string', ['length' => 100, 'null' => false])
            ->addColumn('article_name', 'string', ['length' => 255, 'null' => false])
            // Indexes
            ->addIndex(['article_id', 'price'], ['unique' => true])
            ->create();

        $this->table('invoices', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', ['null' => false])
            ->addColumn('user_id', 'uuid', ['null' => true])
            ->addColumn('currency_code', 'char', ['null' => true, 'length' => 2, 'null' => false])
            // Indexes
            ->addIndex(['user_id'])
            ->create();

        $this->table('invoice_numbers')
            ->create();
    }
}
