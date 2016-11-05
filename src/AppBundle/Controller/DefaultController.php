<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Customer\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Bundle\DoctrineBundle;

class DefaultController extends Controller
{

    /**
     * @Route("/demo", name="demo")
     */
    public function demo(Request $request)
    {
        return $this->indexAction($request, true);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request)
    {
        $request->getSession()->invalidate();
        return $this->indexAction($request);
    }

    /**
     * @Route("/", name="login_form")
     */
    public function indexAction(Request $request, $demo = false)
    {
        $login_failed = null;

        $session = $request->getSession();

        $usr = new User();

        $loginForm = $this->createFormBuilder($usr)
            ->setAction($this->generateUrl('login_form'))
            ->add('user_name', TextType::Class)
            ->add('password', PasswordType::class)
            ->add('btn_login', SubmitType::class)
            ->getForm();

        $loginForm->handleRequest($request);

        if ($loginForm->isSubmitted() && $loginForm->isValid()) {

            $man = $this->getDoctrine()->getManager('default');

            $user = $man->getRepository('AppBundle:User')
                ->findOneBy(
                    array(
                        'user_name' => $loginForm->getData()->getUserName(),
                        'password'  => md5($loginForm->getData()->getPassword())
                    ));

            if ($user) {
                $opt = $user->getOptions();
                $user->setOptions($opt);
                $user->setSessionId($session->getId());
                $user->setSessionTimestamp(time());
                $man->flush();

                $session->set('customer_disk_limit', '100');
                $session->set('customer_user_limit', '100');

                $session->set('user_id', $user->getUserId());
                $session->set('user_name', $user->getUserName());
                $session->set('user_full_name', $user->getFullName());
                $session->set('user_options', $user->getOptions());

                $session->set('document_count', $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Document')->documentCount($request, $this));
                $session->set('contact_count', $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Contact')->contactCount($request, $this));
                $session->set('file_count', $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentFile')->fileCount($request, $this));

                $request->getSession()->set('document_sort_column', 'document.document_id');
                $request->getSession()->set('document_sort_dir', 'desc');

                return $this->redirectToRoute('dashboard');
            } else {
                $login_failed = true;
            }

        }

        return $this->render('other/login.html.twig',
            array(
                'loginForm'    => $loginForm->createView(),
                'login_failed' => $login_failed,
                'demo'         => $demo
            ));
    }

}
