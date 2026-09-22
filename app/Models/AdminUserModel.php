<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table            = 'admin_users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'email',
        'password_hash',
        'name',
        'role',
        'is_active',
        'last_login',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|max_length[150]',
        'name'     => 'required|min_length[2]|max_length[150]',
    ];

    /**
     * Verify admin credentials.
     */
    public function verifyCredentials(string $usernameOrEmail, string $password): ?array
    {
        $user = $this->groupStart()
            ->where('username', $usernameOrEmail)
            ->orWhere('email', $usernameOrEmail)
            ->groupEnd()
            ->first();

        if (! $user) {
            return null;
        }

        // Inactive accounts cannot log in
        if (isset($user['is_active']) && (int) $user['is_active'] !== 1) {
            return null;
        }

        if (password_verify($password, $user['password_hash'])) {
            // Update last_login
            $this->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);
            return $user;
        }

        return null;
    }
}
