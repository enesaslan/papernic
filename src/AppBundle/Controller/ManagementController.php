<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Entity\Document;
use AppBundle\Entity\Country;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\HttpFoundation\Request;

class ManagementController extends Controller
{

    public $success = null;

    /**
     * @Route("admin/user/view/{user_id}", name="admin_user_view")
     */
    public function adminViewUser(Request $request, $user_id)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $man = $this->getDoctrine()->getManager('default');

        $user = $man->getRepository('AppBundle:User')->find($user_id);

        if (!$user) {
            $this->success = false;
            return $this->adminListUser($request);
        } else {

            if ($request->get('btn_user_update') && $request->get('user_name') != '' && $request->get('full_name') != '' && $request->get('password1') != '' && $request->get('password2') != '' && $request->getSession()->get('demo') == false && $request->getSession()->get('user_options')['is_admin'] == true) {
                $user->setUserName($request->get('user_name'));
                $user->setFullName($request->get('full_name'));

                if ($request->get('password1') != 'temppass') {
                    $user->setPassword(md5($request->get('password1')));
                }

                if ($request->get('role') == 'user') {
                    $is_admin = false;
                } else {
                    $is_admin = true;
                }

                $opt = array(
                    'is_admin'             => $is_admin,
                    'smtp_email'           => $request->get('email'),
                    'smtp_host_name'       => $request->get('smtp_host'),
                    'smtp_user_name'       => $request->get('smtp_user_name'),
                    'smtp_password'        => $request->get('smtp_password'),
                    'smtp_port'            => $request->get('smtp_port'),
                    'smtp_auth_mode'       => $request->get('smtp_auth_mode'),
                    'smtp_encryption'      => $request->get('smtp_encryption'),
                    'priv_document_edit'   => $request->get('priv_document_edit'),
                    'priv_document_delete' => $request->get('priv_document_delete'),
                    'priv_contact_edit'    => $request->get('priv_contact_edit'),
                    'priv_contact_delete'  => $request->get('priv_contact_delete'),
                    'priv_file_upload'     => $request->get('priv_file_upload'),
                    'priv_file_download'   => $request->get('priv_file_download'),
                    'priv_file_delete'     => $request->get('priv_file_delete'),
                );

                try {
                    $user->setOptions($opt);
                    $man->flush();
                    $this->success = true;
                    return $this->adminListUser($request);
                } catch (Exception $e) {
                    $this->success = false;
                    return $this->adminListUser($request);
                }

            }

            $opt = $user->getOptions();
            return $this->render('management/user_view.html.twig',
                array(
                    'user' => $user,
                    'opt'  => $opt
                ));

        }
    }

    /**
     * @Route("admin/user/add/", name="admin_user_add")
     */
    public function adminAddUser(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $man = $this->getDoctrine()->getManager('default');

        if ($request->get('btn_user_add') && $request->get('user_name') != '' && $request->get('full_name') != '' && $request->get('password1') != '' && $request->get('password2')) {
            $user = new User();
            $user->setUserName($request->get('user_name'));
            $user->setFullName($request->get('full_name'));
            $user->setPassword(md5($request->get('password1')));
            $user->setIsDeleted(false);

            if ($request->get('role') == 'user') {
                $is_admin = false;
            } else {
                $is_admin = true;
            }

            $opt = array(
                'is_admin'             => $is_admin,
                'smtp_email'           => $request->get('email'),
                'smtp_host_name'       => $request->get('smtp_host'),
                'smtp_user_name'       => $request->get('smtp_user_name'),
                'smtp_password'        => $request->get('smtp_password'),
                'smtp_port'            => $request->get('smtp_port'),
                'smtp_auth_mode'       => $request->get('smtp_auth_mode'),
                'smtp_encryption'      => $request->get('smtp_encryption'),
                'priv_document_edit'   => $request->get('priv_document_edit'),
                'priv_document_delete' => $request->get('priv_document_delete'),
                'priv_contact_edit'    => $request->get('priv_contact_edit'),
                'priv_contact_delete'  => $request->get('priv_contact_delete'),
                'priv_file_upload'     => $request->get('priv_file_upload'),
                'priv_file_download'   => $request->get('priv_file_download'),
                'priv_file_delete'     => $request->get('priv_file_delete'),
            );

            try {
                $user->setOptions($opt);
                $man->persist($user);
                $man->flush();
                $this->success = true;
                return $this->adminListUser($request);
            } catch (Exception $e) {
                $this->success = false;
                return $this->adminListUser($request);
            }
        }

        if ($man->getRepository('AppBundle:User')->canAddUser($request, $this) == false) {
            $this->success = false;
            return $this->adminListUser($request);
        } else {

            return $this->render('management/user_add.html.twig',
                array());

        }
    }

    /**
     * @Route("/admin/user/delete/{user_id}", name="admin_user_delete")
     * @Method("GET")
     */
    public function deleteUser(Request $request, $user_id)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $man = $this->getDoctrine()->getManager('default');

        try {
            $user = $man->getRepository('AppBundle:User')->find($user_id);
            if ($user && $request->getSession()->get('user_options')['is_admin'] == true && $user_id != $request->getSession()->get('user_id') && $request->getSession()->get('demo') == false) {
                $user->setIsDeleted(true);
                $man->flush();
                $this->success = true;
            } else {
                $this->success = false;
            }
        } catch (Exception $e) {
            $this->success = false;
        }

        return $this->adminListUser($request);
    }

    /**
     * @Route("/admin/user/list/", name="admin_user_list")
     */
    public function adminListUser(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $session = $request->getSession();

        if ($session->get('user_options')['is_admin'] == false) {
            return new Response('unauth_access');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $users = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:User')->userList($request,
            $this);
        $can_add = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:User')->canAddUser($request,
            $this);

        return $this->render('management/user_list.html.twig',
            array(
                'users'   => $users,
                'success' => $this->success,
                'can_add' => $can_add
            ));
    }
}