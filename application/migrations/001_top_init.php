<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Top_init extends CI_Migration {

    public function up()
    {        
        $this->add_redirects();
        $this->add_nonces();
        $this->add_documents();
        $this->add_permissions();
        $this->add_roles();
        $this->add_sessions();
        $this->add_users();
        $this->add_articles();
        $this->add_events();
    }

    // --------------------------------------------------------------------

    /**
     * add articles table
     *
     * @param void
     *
     * @return void
     **/
    private function add_articles()
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
                'constraint'    => '120',
            ),
            'slug' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '120',
            ),
            'content'   => array(
                'type'          => 'TEXT',
            ),
            'published_at'  => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'created_at'  => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'updated_at'  => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('articles');
    }

    // --------------------------------------------------------------------

    /**
     * add events table
     *
     * @param void
     *
     * @return void
     **/
    private function add_events()
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
                'constraint'    => '120',
            ),
            'slug' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '120',
            ),
            'content'   => array(
                'type'          => 'TEXT',
            ),
            'start'  => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'end'  => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'published_at'  => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'created_at'  => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
            'updated_at'  => array(
                'type'          => 'DATETIME',
                'null'          => TRUE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('events');
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
            'created_at'    => array(
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
     * add documents table
     *
     * @param void
     *
     * @return void
     **/
    private function add_documents()
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
            'description'   => array(
                'type'          => 'TEXT'
            ),
            'keywords'   => array(
                'type'          => 'TEXT',
                'null'          => TRUE
            ),
            'body'   => array(
                'type'          => 'TEXT'
            ),
            'view'   => array(
                'type'          => 'VARCHAR',
                'constraint'    => '60',
                'default'       => 'default'
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
        $this->dbforge->create_table('documents');
        // create root document
        $doc = new Document();
        $doc->uri = '/';
        $doc->title = 'Welcome to Topkit';
        $doc->slug = 'home';
        $doc->body = "<p>The page you are looking at is being generated dynamically by CodeIgniter, using the <strong>topkit</strong> framework.</p><p>This page is beign rendered from the database by the <code>pages</code> Controller. It uses the default layout and the <code>views/pages/default.php</code> view.</p>";
        $doc->published_at = date_create();
        $doc->save();
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
