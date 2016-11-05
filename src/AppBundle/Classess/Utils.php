<?php

namespace AppBundle\Classess;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Utils extends Controller
{
    public function checkSession(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('user_id') == null) {
            return false;
        } else {
            return true;
        }
    }

    public function setCustomerConnection(Request $request, Controller $controller)
    {
        // Deprecated
    }
}