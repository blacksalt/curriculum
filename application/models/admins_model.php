<?php

class Admins_model extends Model
{
    # TODO: Used by gate/auth and $this->change_password
    function auth ( $data )
    {
        if ( ! isset($data) ) return NULL;
        $this->db->where('username',$data['username']);
        $query = $this->db->get('admin');
        $result = $query->row();
        $hash = $result->password;
        $salt = $result->salt;
        if ( sha1 ($data['password'] . $salt) != $hash ) return NULL;
        else 
        {
            unset($result->password);
            return $result;
        }
    }

    # TODO: Used by admin/change_password
    function change_password( $user )
    {
        $user['password'] = $user['current'];
        $r = $this->auth($user);
        if (!empty( $r )) # auth function returned something
        {
            $r->password = sha1($user['new'].$r->salt);
            return $this->db->where('id',$r->id)->update('admin',$r);
        }
        return NULL;
    }

}
