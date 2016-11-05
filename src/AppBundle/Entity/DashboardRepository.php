<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class DashboardRepository extends EntityRepository
{
    public function getMessages(Request $request, Controller $controller, $json = false)
    {
        $controller->get('appbundle.utils')->setCustomerConnection($request, $controller);

        $qb = $this->getEntityManager('customer')->createQueryBuilder()->from('AppBundle:Dashboard', 'dashboard')->select('dashboard, user.user_name, user.full_name');

        $list = $qb->leftJoin("AppBundle:User", "user", "WITH", "dashboard.user_id = user.user_id");
        $list = $qb->orderBy('dashboard.timestamp',  'DESC');
        $list = $qb->setMaxResults(20);
        $list = $qb->getQuery()->getResult(Query::HYDRATE_SCALAR);

        if ($json) {
            $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
            $list = $serializer->serialize($list, 'json');
        }

        return $list;
    }

    public function getActivities(Request $request, Controller $controller, $json = false)
    {
        $controller->get('appbundle.utils')->setCustomerConnection($request, $controller);

        $qb = $this->getEntityManager('customer')->createQueryBuilder()->from('AppBundle:Document', 'document')->select('document.document_id, document.document_subject, document.date_added, user.user_name, user.full_name');

        $list = $qb->leftJoin("AppBundle:User", "user", "WITH", "document.user_id = user.user_id");
        $list = $qb->andWhere('document.is_deleted = false');
        $list = $qb->andWhere('document.is_temp = false');
        $list = $qb->orderBy('document.document_id',  'DESC');
        $list = $qb->setMaxResults(20);
        $list = $qb->getQuery()->getResult(Query::HYDRATE_SCALAR);

        if ($json) {
            $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
            $list = $serializer->serialize($list, 'json');
        }

        return $list;
    }
}
