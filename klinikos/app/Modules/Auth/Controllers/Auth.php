<?php
namespace App\Modules\Auth\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ============ WEB ============
    public function login()
    {
        if (session()->get('isLoggedIn')) return redirect()->to($this->roleHome(session()->get('role')));
        return view('App\Modules\Auth\Views\login', ['title' => 'Login']);
    }

    public function doLogin()
    {
        $username = trim($this->request->getPost('username') ?? '');
        $password = $this->request->getPost('password') ?? '';

        $user = $this->db->table('users')->where('username', $username)->where('is_active', 1)->get()->getRowArray();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            session()->setFlashdata('error', 'Username atau password salah.');
            return redirect()->back()->withInput();
        }

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'full_name'  => $user['full_name'],
            'role'       => $user['role'],
        ]);

        $this->logActivity($user['id'], 'LOGIN', 'users', $user['id'], "User {$user['username']} login");

        return redirect()->to($this->roleHome($user['role']));
    }

    public function logout()
    {
        $uid = session()->get('user_id');
        if ($uid) $this->logActivity($uid, 'LOGOUT', 'users', $uid, 'User logout');
        session()->destroy();
        return redirect()->to('/login');
    }

    // ============ API: User CRUD (admin only) ============
    public function apiList()
    {
        if (session()->get('role') !== 'admin') return $this->response->setStatusCode(403)->setJSON(['status'=>'error','message'=>'Forbidden']);
        $users = $this->db->table('users')->select('id, username, full_name, email, phone, role, specialization, is_active, created_at')->orderBy('created_at','DESC')->get()->getResultArray();
        return $this->response->setJSON(['status'=>'success','data'=>$users]);
    }

    public function apiCreate()
    {
        if (session()->get('role') !== 'admin') return $this->response->setStatusCode(403)->setJSON(['status'=>'error','message'=>'Forbidden']);
        $in = $this->request->getJSON(true) ?: $this->request->getPost();
        $required = ['username','password','full_name','role'];
        foreach ($required as $f) if (empty($in[$f])) return $this->response->setStatusCode(422)->setJSON(['status'=>'error','message'=>"Field $f wajib diisi"]);

        $data = [
            'username'       => $in['username'],
            'password_hash'  => password_hash($in['password'], PASSWORD_BCRYPT),
            'full_name'      => $in['full_name'],
            'email'          => $in['email'] ?? null,
            'phone'          => $in['phone'] ?? null,
            'role'           => $in['role'],
            'specialization' => $in['specialization'] ?? null,
            'nip'            => $in['nip'] ?? null,
            'license_number' => $in['license_number'] ?? null,
            'is_active'      => 1,
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];
        try {
            $this->db->table('users')->insert($data);
            $id = $this->db->insertID();
            $this->logActivity(session()->get('user_id'), 'CREATE', 'users', $id, "Buat user {$data['username']}");
            return $this->response->setJSON(['status'=>'success','data'=>['id'=>$id]]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

    public function apiUpdate($id)
    {
        if (session()->get('role') !== 'admin') return $this->response->setStatusCode(403)->setJSON(['status'=>'error','message'=>'Forbidden']);
        $in = $this->request->getJSON(true) ?: [];
        $data = array_filter([
            'full_name'      => $in['full_name'] ?? null,
            'email'          => $in['email'] ?? null,
            'phone'          => $in['phone'] ?? null,
            'role'           => $in['role'] ?? null,
            'specialization' => $in['specialization'] ?? null,
            'is_active'      => isset($in['is_active']) ? (int)$in['is_active'] : null,
        ], fn($v) => $v !== null);
        if (!empty($in['password'])) $data['password_hash'] = password_hash($in['password'], PASSWORD_BCRYPT);
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->table('users')->where('id', $id)->update($data);
        $this->logActivity(session()->get('user_id'), 'UPDATE', 'users', $id, "Update user #$id");
        return $this->response->setJSON(['status'=>'success']);
    }

    public function apiDelete($id)
    {
        if (session()->get('role') !== 'admin') return $this->response->setStatusCode(403)->setJSON(['status'=>'error','message'=>'Forbidden']);
        $this->db->table('users')->where('id', $id)->delete();
        $this->logActivity(session()->get('user_id'), 'DELETE', 'users', $id, "Hapus user #$id");
        return $this->response->setJSON(['status'=>'success']);
    }

    public function apiMe()
    {
        $uid = session()->get('user_id');
        $u = $this->db->table('users')->select('id, username, full_name, email, phone, role, specialization, profile_picture_url')->where('id', $uid)->get()->getRowArray();
        return $this->response->setJSON(['status'=>'success','data'=>$u]);
    }

    // ============ Helpers ============
    private function roleHome(string $role): string
    {
        return match ($role) {
            'admin'       => '/dashboard',
            'resepsionis' => '/resepsionis',
            'dokter'      => '/dokter',
            'perawat'     => '/perawat',
            'apoteker'    => '/apoteker',
            'kasir'       => '/kasir',
            default       => '/login',
        };
    }

    private function logActivity(?int $uid, string $action, ?string $entity = null, ?int $entityId = null, ?string $desc = null): void
    {
        try {
            $this->db->table('activity_logs')->insert([
                'user_id'     => $uid,
                'action'      => $action,
                'entity'      => $entity,
                'entity_id'   => $entityId,
                'description' => $desc,
                'ip_address'  => $this->request->getIPAddress(),
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) { /* ignore */ }
    }
}
