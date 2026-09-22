<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminActivityLogModel extends Model
{
    protected $table            = 'admin_activity_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'admin_id',
        'admin_name',
        'action',
        'description',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected $useTimestamps = false;

    /**
     * Record an administrative activity log entry.
     */
    public static function record(string $action, string $description, ?int $adminId = null, ?string $adminName = null): bool
    {
        try {
            $request = service('request');
            $session = session();

            $adminId   = $adminId ?? (int) ($session->get('admin_id') ?? 0);
            $adminName = $adminName ?? (string) ($session->get('admin_name') ?? 'System');

            $ipAddress = '';
            if ($request instanceof \CodeIgniter\HTTP\RequestInterface) {
                $ipAddress = $request->getIPAddress();
            }

            $userAgent = '';
            if ($request instanceof \CodeIgniter\HTTP\RequestInterface) {
                $ua = $request->getUserAgent();
                $userAgent = $ua ? (string) $ua->getAgentString() : '';
            }

            $logModel = new self();
            return (bool) $logModel->insert([
                'admin_id'    => $adminId > 0 ? $adminId : null,
                'admin_name'  => $adminName,
                'action'      => strtoupper(trim($action)),
                'description' => $description,
                'ip_address'  => substr($ipAddress, 0, 45),
                'user_agent'  => substr($userAgent, 0, 255),
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'AdminActivityLogModel::record error: ' . $e->getMessage());
            return false;
        }
    }
}
