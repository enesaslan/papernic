<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dashboard;
use AppBundle\Entity\User;
use AppBundle\Entity\Customer\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Bundle\DoctrineBundle;

class DashboardController extends Controller
{

    /**
     * @Route("/dashboard/messages", name="dashboard_messages")
     */
    public function messageList(Request $request) {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        return new Response($this->getDoctrine()->getManager('default')->getRepository('AppBundle:Dashboard')->getMessages($request, $this, true));
    }

    /**
     * @Route("/dashboard/add", name="dashboard_add")
     */
    public function addDashboard(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $man = $this->getDoctrine()->getManager('default');

        $dashboard = new Dashboard();
        $dashboard->setMessage(htmlspecialchars($request->request->get('message'), ENT_QUOTES, 'UTF-8'));
        $dashboard->setUserId($request->getSession()->get('user_id'));
        $dashboard->setTimestamp(time());

        $man->persist($dashboard);
        $man->flush();

        return $this->messageList($request);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $session = $request->getSession();

        $messages = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Dashboard')->getMessages($request, $this);
        $activities = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Dashboard')->getActivities($request, $this);

        return $this->render('other/dashboard.html.twig',
            array(
                'messages' => $messages,
                'activities' => $activities
            ));
    }
}
