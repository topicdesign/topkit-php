<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Top_init extends CI_Migration {

    public function up()
    {        
        $this->add_redirects();
        $this->add_nonces();
        $this->add_pages();
        $this->add_permissions();
        $this->add_roles();
        $this->add_sessions();
        $this->add_users();
    }

    // --------------------------------------------------------------------
    
    /**
     * add sessions table
     *
     * @param void
     *
     * @return void
     **/
    private function add_sessions()
    {
        $this->dbforge->add_field(array(
            'session_id'    => array(
                'type'          => 'VARCHAR',
                'constraint'    => '40',
            ),
            'ip_address'    => array(
                'type'          => 'VARCHAR',
                'constraint'    => '16',
            ),
            'user_agent'    => array(
                'type'          => 'VARCHAR',
                'constraint'    => '120',
            ),
            'last_activity' => array(
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => TRUE,
            ),
            'user_data' => array(
                'type'          => 'TEXT'
            )
        ));
        $this->dbforge->add_key('session_id', TRUE);
        $this->dbforge->add_key('last_activity');
        $this->dbforge->create_table('sessions');
    }

    // --------------------------------------------------------------------

    /**
     * add users table
     *
     * @param void
     *
     * @return void
     **/
    private function add_users()
    {
        $this->dbforge->add_field(array(
            'id'    => array(
                'type'          => 'INT',
                'constraint'    => '11',
                'unsigned'      => TRUE,
                'auto_increment'    => TRUE
            ),
            'email' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '120',
                'null'          => TRUE
            ),
            'username' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '60',
                'null'          => TRUE
            ),
            'password' => array(
                'type'          => 'CHAR',
                'constraint'    => '64',
                'null'          => TRUE
            ),
            'salt' => array(
                'type'          => 'CHAR',
                'constraint'    => '64',
                'null'          => TRUE
            ),
            'active' => array(
                'type'          => 'TINYINT',
                'constraint'    => '1',
                'null'          => TRUE
            ),
            'last_login'    => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'created_at'    => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'updated_at'    => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    // --------------------------------------------------------------------

    /**
     * add roles table
     *
     * @param void
     *
     * @return void
     **/
    private function add_roles()
    {
        $this->dbforge->add_field(array(
            'id'    => array(
                'type'          => 'INT',
                'constraint'    => '11',
                'unsigned'      => TRUE,
                'auto_increment'    => TRUE
            ),
            'title' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '40'
            ),
            'user_id'   => array(
                'type'          => 'INT',
                'constraint'    => '11',
                'unsigned'      => TRUE
            ),
            'permission_id'   => array(
                'type'          => 'INT',
                'constraint'    => '11',
                'unsigned'      => TRUE
            ),
            'created_ad'    => array(
                'type'          => 'DATETIME'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('roles');
    }
      
    // --------------------------------------------------------------------

    /**
     * add permissions table
     *
     * @param void
     *
     * @return void
     **/
    private function add_permissions()
    {
        $this->dbforge->add_field(array(
            'id'    => array(
                'type'          => 'INT',
                'constraint'    => '11',
                'unsigned'      => TRUE,
                'auto_increment'    => TRUE
            ),
            'data'  => array(
                'type'          => 'TEXT'
            ),
            'created_at'    => array(
                'type'          => 'DATETIME'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('permissions');
    }
    
    // --------------------------------------------------------------------

    /**
     * add pages table
     *
     * @param void
     *
     * @return void
     **/
    private function add_pages()
    {
        $this->dbforge->add_field(array(
            'uri'   => array(
                'type'          => 'VARCHAR',
                'constraint'    => '120'
            ),
            'title'   => array(
                'type'          => 'VARCHAR',
                'constraint'    => '120'
            ),
            'slug'   => array(
                'type'          => 'VARCHAR',
                'constraint'    => '120'
            ),
            'content'   => array(
                'type'          => 'TEXT'
            ),
            'view'   => array(
                'type'          => 'VARCHAR',
                'constraint'    => '60'
            ),
            'published_at' => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'created_at' => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'updated_at' => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
        ));
        $this->dbforge->add_key('uri', TRUE);
        $this->dbforge->create_table('pages');
    }

    // --------------------------------------------------------------------

    /**
     * add nonces table
     *
     * @param void
     *
     * @return void
     **/
    private function add_nonces()
    {
        $this->dbforge->add_field(array(
            'code'  => array(
                'type'          => 'CHAR',
                'constraint'    => '32',
            ),
            'user_id'   => array(
                'type'          => 'INT',
                'constraint'    => '11',
                'unsigned'      => TRUE,
            ),
            'expire_at' => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'created_at' => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            )
        ));
        $this->dbforge->add_key('code', TRUE);
        $this->dbforge->create_table('nonces');
    }

    // --------------------------------------------------------------------
    
    /**
     * create redirects table
     *
     * @param void
     *
     * @return void
     **/
    private function add_redirects()
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
