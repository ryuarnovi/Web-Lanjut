<?php

namespace Modules\Auth\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['form', 'url']);
    }

    // ============ VIEW METHODS (existing) ============

    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('Modules\Auth\Views\login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->db->query("SELECT id, username, password_hash, full_name, role, is_active FROM users WHERE username = ? AND is_active = 1", [$username])->getRowArray();

        if ($user && password_verify($password, $user['password_hash'])) {
            $sessionData = [
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'name'      => $user['full_name'],
                'role'      => $user['role'],
                'logged_in' => true,
            ];
            session()->set($sessionData);

            switch ($user['role']) {
                case 'resepsionis': return redirect()->to(base_url('resepsionis/pendaftaran'));
                case 'dokter':      return redirect()->to(base_url('dokter/antrean'));
                case 'apoteker':    return redirect()->to(base_url('apoteker/resep'));
                case 'kasir':       return redirect()->to(base_url('kasir/data'));
                default:            return redirect()->to(base_url('dashboard'));
            }
        }

        return redirect()->back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    // ============ USER API (port from user_handler.go) ============

    private function validRole($role)
    {
        $validRoles = ['admin', 'dokter', 'apoteker', 'kasir', 'resepsionis', 'perawat', 'pasien'];
        return in_array(strtolower($role), $validRoles);
    }

    private function validEmail($email)
    {
        if (empty($email)) return true;
        if (strlen($email) < 5 || strlen($email) > 100) return false;
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function createUser()
    {
        $input = $this->request->getJSON(true);

        if (!$this->validRole($input['role'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid role']);
        }
        if (!$this->validEmail($input['email'] ?? null)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid email']);
        }
        if (strlen($input['password']) < 6) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Password too short']);
        }

        $hashedPassword = password_hash($input['password'], PASSWORD_BCRYPT);

        $this->db->query("INSERT INTO users (username, password_hash, full_name, email, phone, nip, specialization, license_number, role, is_active, profile_picture_url, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, NOW(), NOW())", [
            $input['username'],
            $hashedPassword,
            $input['full_name'],
            $input['email'] ?? null,
            $input['phone'] ?? null,
            $input['nip'] ?? null,
            $input['specialization'] ?? null,
            $input['license_number'] ?? null,
            $input['role'],
            $input['profile_picture_url'] ?? null,
        ]);

        $id = $this->db->insertID();
        $this->logActivity('CREATE', 'users', $id, 'Membuat user baru ' . $input['username']);
        return $this->response->setStatusCode(201)->setJSON(['message' => 'User created', 'data' => $id]);
    }

    public function updateUser($id)
    {
        $id = (int) $id;
        $input = $this->request->getJSON(true);

        $set = [];
        $params = [];

        if (isset($input['full_name'])) {
            $set[] = "full_name = ?";
            $params[] = $input['full_name'];
        }
        if (isset($input['email'])) {
            if (!$this->validEmail($input['email'])) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid email']);
            }
            $set[] = "email = ?";
            $params[] = $input['email'];
        }
        if (isset($input['phone'])) {
            $set[] = "phone = ?";
            $params[] = $input['phone'];
        }
        if (!empty($input['password'])) {
            if (strlen($input['password']) < 6) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Password too short']);
            }
            $set[] = "password_hash = ?";
            $params[] = password_hash($input['password'], PASSWORD_BCRYPT);
        }
        if (isset($input['nip'])) {
            $set[] = "nip = ?";
            $params[] = $input['nip'];
        }
        if (isset($input['specialization'])) {
            $set[] = "specialization = ?";
            $params[] = $input['specialization'];
        }
        if (isset($input['license_number'])) {
            $set[] = "license_number = ?";
            $params[] = $input['license_number'];
        }
        if (isset($input['role'])) {
            $set[] = "role = ?";
            $params[] = $input['role'];
        }
        if (isset($input['is_active'])) {
            $set[] = "is_active = ?";
            $params[] = $input['is_active'] ? 1 : 0;
        }
        if (isset($input['profile_picture_url'])) {
            $set[] = "profile_picture_url = ?";
            $params[] = $input['profile_picture_url'];
        }

        if (empty($set)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'No data to update']);
        }

        $set[] = "updated_at = NOW()";
        $params[] = $id;

        $this->db->query("UPDATE users SET " . implode(', ', $set) . " WHERE id = ?", $params);
        $this->logActivity('UPDATE', 'users', $id, 'Memperbarui profil user');
        return $this->response->setJSON(['message' => 'Profile updated']);
    }

    public function deleteUser($id)
    {
        $this->db->query("DELETE FROM users WHERE id = ?", [(int) $id]);
        return $this->response->setJSON(['message' => 'User deleted']);
    }

    public function getUser($id)
    {
        $user = $this->db->query("SELECT id, username, full_name, email, phone, nip, specialization, license_number, role, is_active, profile_picture_url, created_at, updated_at FROM users WHERE id = ?", [(int) $id])->getRowArray();

        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'User not found']);
        }
        return $this->response->setJSON(['data' => $user]);
    }

    public function listUsers()
    {
        $query = $this->db->query("SELECT id, username, full_name, email, phone, nip, specialization, license_number, role, is_active, profile_picture_url, created_at, updated_at FROM users");
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function listStaff()
    {
        $query = $this->db->query("SELECT id, username, full_name, email, phone, nip, specialization, license_number, role, is_active, profile_picture_url, created_at, updated_at FROM users WHERE role != 'pasien'");
        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function getMe()
    {
        $userID = session()->get('user_id');
        if (!$userID) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'User not authenticated']);
        }

        $user = $this->db->query("SELECT id, username, full_name, email, phone, nip, specialization, license_number, role, is_active, profile_picture_url, created_at, updated_at FROM users WHERE id = ?", [$userID])->getRowArray();

        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'User not found']);
        }
        return $this->response->setJSON(['data' => $user]);
    }

    public function updateMe()
    {
        $userID = session()->get('user_id');
        if (!$userID) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'User not authenticated']);
        }

        $input = $this->request->getJSON(true);
        // Don't allow changing role or is_active from profile
        unset($input['role'], $input['is_active']);

        $set = [];
        $params = [];

        if (isset($input['full_name'])) {
            $set[] = "full_name = ?";
            $params[] = $input['full_name'];
        }
        if (isset($input['email'])) {
            if (!$this->validEmail($input['email'])) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid email']);
            }
            $set[] = "email = ?";
            $params[] = $input['email'];
        }
        if (isset($input['phone'])) {
            $set[] = "phone = ?";
            $params[] = $input['phone'];
        }
        if (!empty($input['password'])) {
            if (strlen($input['password']) < 6) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Password too short']);
            }
            $set[] = "password_hash = ?";
            $params[] = password_hash($input['password'], PASSWORD_BCRYPT);
        }
        if (isset($input['nip'])) {
            $set[] = "nip = ?";
            $params[] = $input['nip'];
        }
        if (isset($input['specialization'])) {
            $set[] = "specialization = ?";
            $params[] = $input['specialization'];
        }
        if (isset($input['license_number'])) {
            $set[] = "license_number = ?";
            $params[] = $input['license_number'];
        }
        if (isset($input['profile_picture_url'])) {
            $set[] = "profile_picture_url = ?";
            $params[] = $input['profile_picture_url'];
        }

        if (empty($set)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'No data to update']);
        }

        $set[] = "updated_at = NOW()";
        $params[] = $userID;

        $this->db->query("UPDATE users SET " . implode(', ', $set) . " WHERE id = ?", $params);
        $this->logActivity('UPDATE', 'users', $userID, 'Memperbarui profil sendiri');
        return $this->response->setJSON(['message' => 'Profile updated']);
    }

    public function uploadProfilePicture()
    {
        $userID = session()->get('user_id');
        if (!$userID) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'User not authenticated']);
        }

        $file = $this->request->getFile('image');
        if (!$file || !$file->isValid()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Failed to get image']);
        }

        $uploadPath = FCPATH . 'uploads';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $ext = $file->getExtension();
        $filename = 'user_' . $userID . '_' . time() . '.' . $ext;
        $file->move($uploadPath, $filename);

        $photoURL = base_url('uploads/' . $filename);
        $this->db->query("UPDATE users SET profile_picture_url = ?, updated_at = NOW() WHERE id = ?", [$photoURL, $userID]);

        $this->logActivity('UPDATE', 'users', $userID, 'Mengunggah foto profil');
        return $this->response->setJSON(['message' => 'Photo uploaded successfully', 'url' => $photoURL]);
    }

    public function register()
    {
        $input = $this->request->getJSON(true);

        if (!$this->validRole($input['role'] ?? 'pasien')) {
            $input['role'] = 'pasien';
        }
        if (!$this->validEmail($input['email'] ?? null)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid email']);
        }
        if (strlen($input['password']) < 6) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Password too short']);
        }

        $hashedPassword = password_hash($input['password'], PASSWORD_BCRYPT);

        $this->db->query("INSERT INTO users (username, password_hash, full_name, email, phone, nip, specialization, license_number, role, is_active, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, NOW(), NOW())", [
            $input['username'],
            $hashedPassword,
            $input['full_name'],
            $input['email'] ?? null,
            $input['phone'] ?? null,
            $input['nip'] ?? null,
            $input['specialization'] ?? null,
            $input['license_number'] ?? null,
            $input['role'],
        ]);

        $userID = $this->db->insertID();
        $user = $this->db->query("SELECT id, username, role, is_active FROM users WHERE id = ?", [$userID])->getRowArray();

        // Auto-login after register (like the Go handler)
        $sessionData = [
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => true,
        ];
        session()->set($sessionData);

        return $this->response->setStatusCode(201)->setJSON([
            'message' => 'User registered',
            'data' => $user,
        ]);
    }

    // ============ API LOGIN (JSON) ============

    public function loginApi()
    {
        $input = $this->request->getJSON(true);
        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        $user = $this->db->query("SELECT id, username, password_hash, full_name, role, is_active FROM users WHERE username = ? AND is_active = 1", [$username])->getRowArray();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Invalid credentials']);
        }

        $sessionData = [
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'name'      => $user['full_name'],
            'role'      => $user['role'],
            'logged_in' => true,
        ];
        session()->set($sessionData);

        return $this->response->setJSON([
            'message' => 'Login success',
            'data' => [
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'name' => $user['full_name'],
                    'role' => $user['role'],
                    'is_active' => (bool) $user['is_active'],
                ],
            ],
        ]);
    }

    // ============ ACTIVITY LOG HELPER ============

    private function logActivity($action, $entity, $entityID, $description)
    {
        $userID = session()->get('user_id') ?? 0;
        $ip = $this->request->getIPAddress();
        $this->db->query("INSERT INTO activity_logs (user_id, action, entity, entity_id, description, ip_address, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())", [
            $userID, $action, $entity, $entityID, $description, $ip,
        ]);
    }
}
