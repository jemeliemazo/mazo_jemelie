<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UserModel
 */
class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->create_table();
        $this->seed();
    }

    public function get_all()
    {
        return $this->db->table($this->table)->get_all();
    }

    public function find($id, $with_deleted = false)
    {
        $this->db->table($this->table);
        $this->apply_soft_delete($with_deleted);
        return $this->db->where($this->primary_key, $id)->get();
    }

    public function find_by_username($username)
    {
        return $this->db->table($this->table)->where('username', $username)->get();
    }

    public function insert($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function update($id, $data)
    {
        return $this->db->table($this->table)->where($this->primary_key, $id)->update($data);
    }

    public function delete($id)
    {
        return $this->db->table($this->table)->where($this->primary_key, $id)->delete();
    }

    public function count_all()
    {
        return $this->db->table($this->table)->count();
    }

    public function create_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
        )";
        return $this->db->raw($sql);
    }

    public function seed()
    {
        if ($this->count_all() == 0) {
            // Seed admin user
            $this->insert([
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'role' => 'admin'
            ]);

            // Seed regular user
            $this->insert([
                'username' => 'user',
                'password' => password_hash('user', PASSWORD_DEFAULT),
                'role' => 'user'
            ]);
        }
    }
}
