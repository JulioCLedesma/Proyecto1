<?php namespace App\Controllers;
use App\Models\UserModel;
class User extends BaseController
{
    public function login()
    {
        $model = new UserModel();
    
        if ($this->request->getMethod() === 'post' && $this->validate(['login' => 'required', 'password' => 'required'])) {
            $user = $model->login(['login' => $this->request->getPost('login'), 'password' => $this->request->getPost('password')]);
    
            if (isset($user)) {
                $cookieData = [
                    'name'   => 'user_id',
                    'value'  => $user['id'],
                    'expire' => 3600,
                    'secure' => false,
                ];
    
                $this->response->setCookie($cookieData); // Aquí se establece la cookie
    
                session()->set(['user' => $user['id'], 'name' => $user['name']]);
                return redirect()->to(site_url('publication'));
            }
    
            session()->setFlashdata('login_error', 'Los datos ingresados no son correctos.');
        } else {
            session()->setFlashdata('login_error', 'Por favor, completa todos los campos.');
        }
    
        return redirect()->to(base_url());
    }
    
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
    
}
