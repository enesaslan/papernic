<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\DocumentFile;
use Doctrine\ORM\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    private $success = null;

    public function userListAction()
    {
        if ($this->get('appbundle.utils')->checkSession($this->getRequest()) == false) {
            return new Response();
        }

        $this->get('appbundle.utils')->setCustomerConnection($this->getRequest(), $this);

        $this->getDoctrine()->getManager('default')->getRepository('AppBundle:User')->pingUser($this->getRequest(), $this);

        $users = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:User')->userList($this->getRequest(), $this);

        return $this->render(
            'other/sidebar_users.html.twig',
            array('users' => $users)
        );
    }

    /**
     * @Route("/user/dateformat/update", name="user_dateformat_update")
     * @Method({"POST"})
     */
    public function dateFormatUpdate(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return new Response();
        }

        $this->get('appbundle.utils')->setCustomerConnection($this->getRequest(), $this);

        $man = $this->getDoctrine()->getEntityManager('customer');
        $user = $man->getRepository('AppBundle:User')->find($request->getSession()->get('user_id'));
        $opt = $user->getOptions();
        $opt['date_format'] = $request->get('date_format');
        $request->getSession()->set('user_options', $opt);
        $user->setOptions($opt);
        $man->flush();

        return new Response();
    }

    /**
     * @Route("/user/profile", name="user_profile_view")
     * @Method({"GET"})
     */
    public function userProfile(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($this->getRequest(), $this);

        $user = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:User')->find($request->getSession()->get('user_id'));

        return $this->render(
            'other/user_profile.html.twig',
            array('user' => $user)
        );
    }

}
