<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: StudentModel
 * 
 * Automatically generated via CLI.
 */
class StudentModel extends Model {
    protected $table = 'students';
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

    public function truncate()
    {
        return $this->db->raw("TRUNCATE TABLE {$this->table}");
    }

    public function get_paginated($limit, $offset)
    {
        return $this->db->table($this->table)->order_by('id', 'ASC')->limit($limit, $offset)->get_all();
    }

    public function count_all()
    {
        return $this->db->table($this->table)->count();
    }

    public function create_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE
        )";
        return $this->db->raw($sql);
    }

    public function seed()
    {
        if ($this->count_all() == 0) {
            for ($i = 1; $i <= 20; $i++) {
                $this->insert([
                    'first_name' => 'First' . $i,
                    'last_name' => 'Last' . $i,
                    'email' => 'email' . $i . '@example.com'
                ]);
            }
        }
    }

    public function get_paginated_with_search($limit, $offset, $search = '')
    {
        if ($search) {
            $sql = "SELECT * FROM {$this->table} WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? ORDER BY id ASC LIMIT ? OFFSET ?";
            $params = ["%" . $search . "%", "%" . $search . "%", "%" . $search . "%", $limit, $offset];
            return $this->db->raw($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $this->db->table($this->table)->order_by('id', 'ASC')->limit($offset, $limit)->get_all();
        }
    }

    public function count_all_with_search($search = '')
    {
        if ($search) {
            $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ?";
            $params = ["%" . $search . "%", "%" . $search . "%", "%" . $search . "%"];
            $result = $this->db->raw($sql, $params)->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } else {
            return $this->db->table($this->table)->count();
        }
    }


}
