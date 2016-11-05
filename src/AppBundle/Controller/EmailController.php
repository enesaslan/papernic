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

class EmailController extends Controller
{
    private $success = null;

    /**
     * @Route("email/send", name="email_send")
     * @Method({"POST"})
     */
    public function sendEmail(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($this->getRequest()) == false) {
            return new Response();
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $session = $request->getSession();

        $me = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:User')->find($session->get('user_id'));
        $opt = $me->getOptions();

        $transport = \Swift_SmtpTransport::newInstance($opt['smtp_host_name'], $opt['smtp_port'])
            ->setUsername($opt['smtp_user_name'])
            ->setPassword($opt['smtp_password']);

        if ($opt['smtp_auth_mode'] != '') {
            $transport->setAuthMode($opt['smtp_auth_mode']);
        }

        if ($opt['smtp_encryption'] != '') {
            $transport->setEncryption($opt['smtp_encryption']);
        }

        $this->mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance()
            ->setSubject($request->get('email_subject'))
            ->setFrom($opt['smtp_email'], $session->get('user_full_name'))
            ->setTo($request->get('email_to'))
            ->setBody($request->get('email_message'));

        if (trim($request->get('file_ids') != '')) {
            $fa = explode("-", $request->get('file_ids'));
            foreach ($fa as $f) {
                $file = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentFile')->find($f);
                if ($file) {
                    $message->attach(\Swift_Attachment::fromPath('PFS/' . $file->getPath() . $file->getFileName()));
                }
            }
        }

        try {
            $this->mailer->send($message);
            return new Response('email_sent');
        } catch (\Swift_TransportException $e) {
            return new Response($e->getMessage());
        }

    }

    /**
     * @Route("email/compose/{type}/{entity_id}", name="compose_email", defaults={"type" = null, "entity_id" = null})
     * @Method({"GET"})
     */
    public function composeEmail(Request $request, $type = null, $entity_id = null)
    {
        if ($this->get('appbundle.utils')->checkSession($this->getRequest()) == false) {
            return new Response();
        }

        $this->get('appbundle.utils')->setCustomerConnection($this->getRequest(), $this);

        $me = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:User')->find($request->getSession()->get('user_id'));

        $opt = $me->getOptions();

        if ($opt['smtp_email'] == '' || $opt['smtp_host_name'] == '' || $opt['smtp_user_name'] == '' || $opt['smtp_password'] == '' || $opt['smtp_port'] == '') {
            $smtp_ok = false;
        } else {
            $smtp_ok = true;
        }

        $files = null;
        $file_ids = null;
        $subject = null;
        $to = null;
        $show_files = false;

        if ($type == 'file') {
            $file = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentFile')->find($entity_id);
            $subject = $file->getFileName();
            $files = array($file);
            $show_files = true;
        }

        if ($type == 'document') {
            $document = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Document')->find($entity_id);
            $files = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentFile')->findBy(
                array(
                    'document_id' => $entity_id
                ));
            if ($files) {
                foreach ($files as $f) {
                    $file_ids .= $f->getFileId() . '-';
                }
                $file_ids = rtrim($file_ids, '-');
            }
            $subject = $document->getDocumentSubject();
            $show_files = true;
        }

        if ($type == 'contact') {
            $contact = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Contact')->find($entity_id);
            $to = $contact->getEmail();
        }

        return $this->render('other/compose_email.html.twig',
            array(
                'files'      => $files,
                'file_ids'   => $file_ids,
                'show_files' => $show_files,
                'smtp_ok'    => $smtp_ok,
                'subject'    => $subject,
                'to'         => $to
            ));
    }
}
