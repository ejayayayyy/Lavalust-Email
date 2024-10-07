<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_Model extends Model {
	public function registerAccounts($name, $email, $password) {
        $token = bin2hex(random_bytes(20));

        $insert = array(
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'verificationToken' => $token,
            'isVerified' => 0
        );

        if($this->db->table('users')->insert($insert)) {
            return $token;
        }

        return $this->db->table('users')->insert($insert) ? $token : false;
    }

    public function verifyAccounts($token){
        $user = $this->db->table('users')
            ->select('*')
            ->where('verificationToken', $token)
            ->get();

        if($user) {
            $verify = array(
                'isVerified' => 1,
                'verificationToken' => null
            );

            $this->db->table('users')->where('id', $user['id'])->update($verify);
        }

        return false;
             
    }

    public function isEmailExists($email) {
        return $this->db->table('users')
        ->select('email')
        ->where('email', $email)
        ->get();
    }

    public function loginCredentials($email, $password){
        return $this->db->table('users')
            ->select('*')
            ->where('email', $email)
            ->where('isVerified', 1)
            ->where('verifcationToken' === null)
            ->get();

        if($user && password_verify($password, $user['password'])){
            return $user;
        }
    }
}
