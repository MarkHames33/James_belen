<?php

class Add_user_names {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        if (!$this->_lava->dbforge->column_exists('users', 'firstname')) {
            $this->_lava->dbforge->add_column('users', 'firstname', [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'after'      => 'id',
            ]);
        }

        if (!$this->_lava->dbforge->column_exists('users', 'lastname')) {
            $this->_lava->dbforge->add_column('users', 'lastname', [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'after'      => 'firstname',
            ]);
        }
    }

    public function down()
    {
        $this->_lava->dbforge->drop_column('users', 'firstname');
        $this->_lava->dbforge->drop_column('users', 'lastname');
    }
}