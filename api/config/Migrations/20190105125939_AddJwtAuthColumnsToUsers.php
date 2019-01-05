<?php
use Migrations\AbstractMigration;

class AddJwtAuthColumnsToUsers extends AbstractMigration
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
        $this->table('users')
            ->addColumn('sub', 'string', [
                'default' => null,
                'limit' => 128,
                'null' => false,
                'after' => 'avatar_url'
            ])
            ->addColumn('provider', 'string', [
                'default' => null,
                'limit' => 32,
                'null' => false,
                'after' => 'sub'
            ])
            ->update();
    }
}
