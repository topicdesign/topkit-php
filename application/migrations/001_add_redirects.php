<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_redirects extends CI_Migration {

    public function up()
    {
        // create roles table
        $this->dbforge->add_field(array(
            'request'  => array(
                'type'          => 'VARCHAR',
                'constraint'    => '120',
            ),
            'target'  => array(
                'type'          => 'VARCHAR',
                'constraint'    => '120',
            ),
            'status_code'  => array(
                'type'          => 'INT',
                'constraint'    => '11',
                'default'       => 302,
            ),
        ));
        $this->dbforge->add_key('request', TRUE);
        $this->dbforge->create_table('redirects');
    }

}
