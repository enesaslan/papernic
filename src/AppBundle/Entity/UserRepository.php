<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * UserRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function pingUser(Request $request, Controller $controller) {
        $controller->get('appbundle.utils')->setCustomerConnection($request, $controller);
        $this->getEntityManager('customer')->createQuery("UPDATE AppBundle:User u SET u.session_timestamp = :ts, u.session_id = :sid WHERE u.user_id = :uid")
            ->setParameter('ts', time())
            ->setParameter('sid', $request->getSession()->getId())
            ->setParameter('uid', $request->getSession()->get('user_id'))
            ->getResult();
    }

    public function canAddUser(Request $request, Controller $controller) {
        $controller->get('appbundle.utils')->setCustomerConnection($request, $controller);
        $man = $this->getEntityManager('customer');
        $user_count = $man->createQueryBuilder()
            ->select('COUNT(u.user_id)')
            ->from('AppBundle:User', 'u')
            ->where('u.is_deleted = false')
            ->getQuery()
            ->getSingleScalarResult();

        if ($user_count < $request->getSession()->get('customer_user_limit')) {
            return true;
        } else {
            return false;
        }
    }

    public function userList(Request $request, Controller $controller) {
        $controller->get('appbundle.utils')->setCustomerConnection($request, $controller);
        $man = $this->getEntityManager('customer');
        $users = $man->getRepository('AppBundle:User')->findBy(
            array('is_deleted'=> false),
            array('full_name' => 'ASC')
        );

        foreach ($users as $u) {

            if (time() <= $u->getSessionTimestamp() + 60) {
                $u->setIsOnline(true);
            } else {
                $u->setIsOnline(false);
            }

            if ($u->getOptions()['is_admin']) {
                $u->setIsAdmin(true);
            } else {
                $u->setIsAdmin(false);
            }

        }

        return $users;
    }
}