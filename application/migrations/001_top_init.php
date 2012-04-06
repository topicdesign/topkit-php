<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Top_init extends CI_Migration {

    /**
     * create base tables/records
     *
     * @access  public 
     * @param   void 
     * @return  void
     **/
    public function up()
    {
        $this->add_sessions();

        $this->add_pages();
        $this->add_redirects();
        $this->add_default_pages();

        $this->add_users();
        $this->add_roles();
        $this->add_permissions();
        $this->add_nonces();
        $this->add_default_users();
    }

    // --------------------------------------------------------------------

    /**
     * drop all tables
     *
     * @access  public 
     * @param   void 
     * @return  void
     **/
    public function down()
    {
        $tables = array(
            'sessions',
            'pages',
            'redirects',
            'users',
            'roles',
            'permissions',
            'nonces',
        );
        foreach ($tables as $table)
        {
            $this->dbforge->drop_table($table);
        }
    }

    // --------------------------------------------------------------------

    /**
     * add sessions table
     *
     * @access  public 
     * @param   void
     * @return  void
     **/
    private function add_sessions()
    {
        $this->dbforge->add_field(array(
            'session_id'    => array(
                'type'              => 'VARCHAR',
                'constraint'        => '40',
            ),
            'ip_address'    => array(
                'type'              => 'VARCHAR',
                'constraint'        => '16',
            ),
            'user_agent'    => array(
                'type'              => 'VARCHAR',
                'constraint'        => '120',
            ),
            'last_activity' => array(
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => TRUE,
            ),
            'user_data'     => array(
                'type'              => 'TEXT'
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
     * @access  public 
     * @param   void
     * @return  void
     **/
    private function add_users()
    {
        $this->dbforge->add_field(array(
            'id'            => array(
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ),
            'email'         => array(
                'type'              => 'VARCHAR',
                'constraint'        => '120',
                'null'              => TRUE
            ),
            'username'      => array(
                'type'              => 'VARCHAR',
                'constraint'        => '60',
                'null'              => TRUE
            ),
            'password'      => array(
                'type'              => 'CHAR',
                'constraint'        => '64',
                'null'              => TRUE
            ),
            'salt'          => array(
                'type'              => 'CHAR',
                'constraint'        => '64',
                'null'              => TRUE
            ),
            'active'        => array(
                'type'              => 'TINYINT',
                'constraint'        => '1',
                'null'              => TRUE
            ),
            'last_login'    => array(
                'type'              => 'DATETIME',
                'null'              => TRUE
            ),
            'created_at'    => array(
                'type'              => 'DATETIME',
                'null'              => TRUE
            ),
            'updated_at'    => array(
                'type'              => 'DATETIME',
                'null'              => TRUE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    // --------------------------------------------------------------------

    /**
     * add roles table
     *
     * @access  public 
     * @param   void
     * @return  void
     **/
    private function add_roles()
    {
        $this->dbforge->add_field(array(
            'id'            => array(
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ),
            'title'         => array(
                'type'              => 'VARCHAR',
                'constraint'        => '40'
            ),
            'user_id'       => array(
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => TRUE
            ),
            'permission_id' => array(
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => TRUE
            ),
            'created_at'    => array(
                'type'              => 'DATETIME'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('roles');
    }

    // --------------------------------------------------------------------

    /**
     * add permissions table
     *
     * @access  public 
     * @param   void
     * @return  void
     **/
    private function add_permissions()
    {
        $this->dbforge->add_field(array(
            'id'            => array(
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => TRUE,
                'auto_increment'    => TRUE
            ),
            'data'          => array(
                'type'              => 'TEXT'
            ),
            'created_at'    => array(
                'type'              => 'DATETIME'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('permissions');
    }

    // --------------------------------------------------------------------

    /**
     * add pages table
     *
     * @access  public 
     * @param   void
     * @return  void
     **/
    private function add_pages()
    {
        $this->dbforge->add_field(array(
            'uri'           => array(
                'type'              => 'VARCHAR',
                'constraint'        => '120'
            ),
            'title'         => array(
                'type'              => 'VARCHAR',
                'constraint'        => '120'
            ),
            'slug'          => array(
                'type'              => 'VARCHAR',
                'constraint'        => '120'
            ),
            'description'   => array(
                'type'              => 'TEXT',
                'null'              => TRUE
            ),
            'keywords'      => array(
                'type'              => 'TEXT',
                'null'              => TRUE
            ),
            'body'          => array(
                'type'              => 'TEXT',
                'null'              => TRUE
            ),
            'view'          => array(
                'type'              => 'VARCHAR',
                'constraint'        => '60',
                'default'           => 'default'
            ),
            'published_at'  => array(
                'type'              => 'DATETIME',
                'null'              => TRUE
            ),
            'created_at'    => array(
                'type'              => 'DATETIME',
                'null'              => TRUE
            ),
            'updated_at'    => array(
                'type'              => 'DATETIME',
                'null'              => TRUE
            ),
        ));
        $this->dbforge->add_key('uri', TRUE);
        $this->dbforge->create_table('pages');
    }

    // --------------------------------------------------------------------

    /**
     * add default page(s)
     *
     * @access  public 
     * @param   void 
     * @return  void
     **/
    public function add_default_pages()
    {
        // create root page
        $page = new Page();
        $page->uri = '/';
        $page->title = 'Welcome to Topkit';
        $page->slug = 'home';
        $page->body = "<p>The page you are looking at is being generated
        dynamically by CodeIgniter, using the <strong>topkit</strong>
        framework.</p><p>This page is being rendered from the database
        by the <code>pages</code> Controller. It uses the default layout
        and the <code>views/pages/default.php</code> view.</p>";
        $page->published_at = date_create();
        $page->save();
        // create markup test page
        $page = new Page();
        $page->uri = '/html';
        $page->title = 'HTML Markup Test';
        $page->slug = 'html';
        $page->view = 'example/html';
        $page->body = "<p>This document is for testing <abbr title=\"Hyper
        Text Markup Language\">HTML</abbr> markup and styles!</p>";
        $page->published_at = date_create();
        $page->save();
    }

    // --------------------------------------------------------------------

    /**
     * add nonces table
     *
     * @access  public 
     * @param   void
     * @return  void
     **/
    private function add_nonces()
    {
        $this->dbforge->add_field(array(
            'code'          => array(
                'type'              => 'CHAR',
                'constraint'        => '32',
            ),
            'user_id'       => array(
                'type'              => 'INT',
                'constraint'        => '11',
                'unsigned'          => TRUE,
            ),
            'expire_at'     => array(
                'type'              => 'DATETIME',
                'null'              => TRUE
            ),
            'created_at'    => array(
                'type'              => 'DATETIME',
                'null'              => TRUE
            )
        ));
        $this->dbforge->add_key('code', TRUE);
        $this->dbforge->create_table('nonces');
    }

    // --------------------------------------------------------------------

    /**
     * create redirects table
     *
     * @access  public 
     * @param   void
     * @return  void
     **/
    private function add_redirects()
    {
        // create roles table
        $this->dbforge->add_field(array(
            'request'       => array(
                'type'              => 'VARCHAR',
                'constraint'        => '120',
            ),
            'target'        => array(
                'type'              => 'VARCHAR',
                'constraint'        => '120',
            ),
            'status_code'   => array(
                'type'              => 'INT',
                'constraint'        => '11',
                'default'           => 302,
            ),
        ));
        $this->dbforge->add_key('request', TRUE);
        $this->dbforge->create_table('redirects');
    }
    
    // --------------------------------------------------------------------

    /**
     * add default user(s)
     *
     * @access  public 
     * @param   void
     * @return  void
     **/
    public function add_default_users()
    {
        // create root user/role/permission
        $user = User::create(array(
            'email'    => config_item('developer_email'),
            'username' => 'root',
            'password' => 'password',
            'active'   => TRUE,
        ));
        $permission = Authority\Permission::create(array(
            'data' => json_encode(array(
                'all' => array('manage' => TRUE)
            )),
        ));
        Authority\Role::create(array(
            'title'         => 'root',
            'user_id'       => $user->id,
            'permission_id' => $permission->id,
        ));
    }

    // --------------------------------------------------------------------

}
/* End of file 001_top_init.php */
/* Location: ./application/migrations/001_top_init.php */
