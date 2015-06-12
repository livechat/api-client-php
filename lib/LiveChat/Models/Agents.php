<?php
namespace LiveChat\Models;

class Agents extends BaseModel
{
    public function get($login = null)
    {
        $url = 'agents' . (null !== $login ? '/'.$login : '');

        return parent::get($url);
    }

    public function add($vars)
    {
        $url = 'agents';

        return parent::post($url, $vars);
    }

    public function update($login, $vars)
    {
        $url = 'agents/'.$login;
        return parent::put($url, $vars);
    }

    public function delete($login)
    {
        $url = 'agents/'.$login;

        return parent::delete($url);
    }
}
