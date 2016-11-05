<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Entity\Document;
use AppBundle\Entity\Country;
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

class ContactController extends Controller
{

    public $success = null;

    /**
     * @Route("/contact/search/{clear}", name="contact_search", defaults={"clear" = ""})
     */
    public function searchContact(Request $request, $clear = "")
    {
        $session = $request->getSession();

        if ($request->get('contact_filter_column') != null && $request->get('contact_filter_value') != null && $request->get('btn_quick_contact_search') != null) {

            $session->remove('contact_filter');
            $session->set('contact_filter', true);

            if ($request->get('contact_filter_column') == 'contact_filter_name') {
                $session->set('contact_filter_name', $request->get('contact_filter_value'));
            }

            if ($request->get('contact_filter_column') == 'contact_filter_email') {
                $session->set('contact_filter_email', $request->get('contact_filter_value'));
            }

            if ($request->get('contact_filter_column') == 'contact_filter_phone') {
                $session->set('contact_filter_phone', $request->get('contact_filter_value'));
            }

            if ($request->get('contact_filter_column') == 'contact_filter_gsm') {
                $session->set('contact_filter_gsm', $request->get('contact_filter_value'));
            }

            if ($request->get('contact_filter_column') == 'contact_filter_citizenship_no') {
                $session->set('contact_filter_citizenship_no', $request->get('contact_filter_value'));
            }

            if ($request->get('contact_filter_column') == 'contact_filter_tax_id') {
                $session->set('contact_filter_tax_id', $request->get('contact_filter_value'));
            }

            if ($request->get('contact_filter_column') == 'contact_filter_address') {
                $session->set('contact_filter_address', $request->get('contact_filter_value'));
            }

            if ($request->get('contact_filter_column') == 'contact_filter_notes') {
                $session->set('contact_filter_notes', $request->get('contact_filter_value'));
            }

        }

        if ($clear == "clear") {
            $session->remove('contact_filter');
            $session->remove('contact_filter_name');
            $session->remove('contact_filter_email');
            $session->remove('contact_filter_phone');
            $session->remove('contact_filter_gsm');
            $session->remove('contact_filter_citizsenship_no');
            $session->remove('contact_filter_tax_id');
            $session->remove('contact_filter_address');
            $session->remove('contact_filter_notes');
        }

        return $this->listContact($request);
    }

    /**
     * @Route("/contact/view/{contact_id}", name="contact_view")
     */
    public function viewContact(Request $request, $contact_id)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $man = $this->getDoctrine()->getManager('default');
        $contact = $man->getRepository('AppBundle:Contact')->find($contact_id);

        if ($contact->getCountryId()) {
            $country = $man->getRepository('AppBundle:Country')->find($contact->getCountryId());
            $contact->setCountryId($country);
        }

        if (!$contact || $request->getSession()->get('user_options')['priv_contact_edit'] == false) {
            $this->success = false;
            return $this->listContact($request);
        }

        $contactForm = $this->createFormBuilder($contact)
            ->setAction($this->generateUrl('contact_view', array('contact_id' => $contact_id)))
            ->add('contact_type', ChoiceType::class, array(
                'choices'                   => array(
                    '1' => 'individual',
                    '2' => 'corporate'
                ),
                'choice_translation_domain' => 'messages'
            ))
            ->add('contact_name', TextType::class)
            ->add('email', TextType::class, array('required' => false))
            ->add('phone', TextType::class, array('required' => false))
            ->add('gsm', TextType::class, array('required' => false))
            ->add('citizenship_no', TextType::class, array('required' => false))
            ->add('tax_id', TextType::class, array('required' => false))
            ->add('tax_office', TextType::class, array('required' => false))
            ->add('web', TextType::class, array('required' => false))
            ->add('im', TextType::class, array('required' => false))
            ->add('fax', TextType::class, array('required' => false))
            ->add('country_id', EntityType::class, array(
                'class'        => 'AppBundle\Entity\Country',
                'choice_label' => 'country',
                'choice_value' => 'country_id',
                'placeholder'  => $this->get('translator')->trans('choose'),
                'required'     => false
            ))
            ->add('address', TextareaType::class, array('required' => false))
            ->add('notes', TextareaType::class, array('required' => false))
            ->add('btn_save_contact', SubmitType::class)
            ->add('btn_cancel', ButtonType::class)
            ->getForm();

        if ($request->getSession()->get('user_options')['priv_contact_edit'] == false) {
            $contactForm->remove('btn_save_contact');
        }

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {

            try {
                $man->flush();
                $this->success = true;
            } catch (Exception $e) {
                $this->success = false;
            }

            return $this->listContact($request);
        }

        return $this->render('contact/view.html.twig',
            array(
                'contactForm' => $contactForm->createView()
            ));

    }

    /**
     * @Route("/contact/delete/{contact_id}", name="contact_delete")
     * @Method("GET")
     */
    public function deleteContact(Request $request, $contact_id)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $man = $this->getDoctrine()->getManager('default');

        try {
            $contact = $man->getRepository('AppBundle:Contact')->find($contact_id);
            if ($contact && $request->getSession()->get('user_options')['priv_contact_delete'] == true) {
                $contact->setIsDeleted(true);
                $man->flush();
                $this->success = true;
                $request->getSession()->set('contact_count', $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Contact')->contactCount($request, $this));
            } else {
                $this->success = false;
            }
        } catch (Exception $e) {
            $this->success = false;
        }

        return $this->listContact($request);
    }

    /**
     * @Route("/contact/list/{page}", name="contact_list", defaults={"page" = 1})
     */
    public function listContact(Request $request, $page = 1)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $session = $request->getSession();

        if ($page == 1) {
            $start = 0;
        } else {
            $start = ($page - 1) * $session->get('user_options')['contact_list_show'];
        }

        $repository = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Contact');

        $qb = $repository->createQueryBuilder('c');

        $list = $qb->andWhere('c.is_deleted = false');

        if ($session->has('contact_filter')) {
            
            if ($session->has('contact_filter_name')) {
                $list = $qb->andWhere("c.contact_name LIKE :contact_name");
                $list->setParameter('contact_name', '%' . $session->get('contact_filter_name') . '%');
            }

            if ($session->has('contact_filter_email')) {
                $list = $qb->andWhere("c.email LIKE :email");
                $list->setParameter('email', '%' . $session->get('contact_filter_email') . '%');
            }

            if ($session->has('contact_filter_phone')) {
                $list = $qb->andWhere("c.phone LIKE :phone");
                $list->setParameter('phone', '%' . $session->get('contact_filter_phone') . '%');
            }
 
            if ($session->has('contact_filter_gsm')) {
                $list = $qb->andWhere("c.gsm LIKE :gsm");
                $list->setParameter('gsm', '%' . $session->get('contact_filter_gsm') . '%');
            }

            if ($session->has('contact_filter_tax_id')) {
                $list = $qb->andWhere("c.tax_id LIKE :tax_id");
                $list->setParameter('tax_id', '%' . $session->get('contact_filter_tax_id') . '%');
            }

            if ($session->has('contact_filter_citizenship_no')) {
                $list = $qb->andWhere("c.citizenship_no LIKE :citizenship_no");
                $list->setParameter('citizenship_no', '%' . $session->get('contact_filter_citizenship_no') . '%');
            }

            if ($session->has('contact_filter_address')) {
                $list = $qb->andWhere("c.address LIKE :address");
                $list->setParameter('address', '%' . $session->get('contact_filter_address') . '%');
            }

            if ($session->has('contact_filter_notes')) {
                $list = $qb->andWhere("c.notes LIKE :notes");
                $list->setParameter('notes', '%' . $session->get('contact_filter_notes') . '%');
            }
            
        }

        $list = $qb->getQuery()->getResult();

        $total = count($list);
        $pageCount = ceil($total / $session->get('user_options')['contact_list_show']);

        $list = $qb->orderBy('c.contact_name', 'ASC');
        $list = $qb->setFirstResult($start);
        $list = $qb->setMaxResults($session->get('user_options')['contact_list_show']);
        $list = $qb->getQuery()->getResult();

        return $this->render('contact/list.html.twig',
            array(
                'list'      => $list,
                'total'     => $total,
                'pageCount' => $pageCount,
                'page'      => $page,
                'success'   => $this->success
            ));
    }

    /**
     * @Route("/contact/add", name="contact_add")
     */
    public function addContact(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $contact = new Contact();

        $contactForm = $this->createFormBuilder($contact)
            ->setAction($this->generateUrl('contact_add'))
            ->add('contact_type', ChoiceType::class, array(
                'choices'                   => array(
                    '1' => 'individual',
                    '2' => 'corporate'
                ),
                'choice_translation_domain' => 'messages'
            ))
            ->add('contact_name', TextType::class)
            ->add('email', TextType::class, array('required' => false))
            ->add('phone', TextType::class, array('required' => false))
            ->add('gsm', TextType::class, array('required' => false))
            ->add('citizenship_no', TextType::class, array('required' => false))
            ->add('tax_id', TextType::class, array('required' => false))
            ->add('tax_office', TextType::class, array('required' => false))
            ->add('web', TextType::class, array('required' => false))
            ->add('im', TextType::class, array('required' => false))
            ->add('fax', TextType::class, array('required' => false))
            ->add('country_id', EntityType::class, array(
                'class'        => 'AppBundle:Country',
                'choice_label' => 'country',
                'choice_value' => 'country_id',
                'required'     => false,
                'placeholder'  => ''
            ))
            ->add('address', TextareaType::class, array('required' => false))
            ->add('notes', TextareaType::class, array('required' => false))
            ->add('btn_save_contact', SubmitType::class)
            ->add('btn_cancel', ButtonType::class)
            ->getForm();

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {

            $contact->setContactType($contactForm->getData()->getContactType());
            $contact->setContactName($contactForm->getData()->getContactName());
            $contact->setEmail($contactForm->getData()->getEmail());
            $contact->setPhone($contactForm->getData()->getPhone());
            $contact->setGsm($contactForm->getData()->getGsm());
            $contact->setCitizenshipNo($contactForm->getData()->getCitizenshipNo());
            $contact->setTaxId($contactForm->getData()->getTaxId());
            $contact->setTaxOffice($contactForm->getData()->getTaxOffice());
            $contact->setWeb($contactForm->getData()->getWeb());
            $contact->setIm($contactForm->getData()->getIm());
            $contact->setFax($contactForm->getData()->getFax());
            $contact->setCountryId($contactForm->getData()->getCountryId());
            $contact->setAddress($contactForm->getData()->getAddress());
            $contact->setNotes($contactForm->getData()->getNotes());
            $contact->setIsDeleted(false);

            try {
                $man = $this->getDoctrine()->getManager('default');
                $man->persist($contact);
                $man->flush();
                $this->success = true;
                $request->getSession()->set('contact_count', $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Contact')->contactCount($request, $this));
            } catch (Exception $e) {
                $this->success = false;
            }

            return $this->listContact($request, 1);
        }

        return $this->render('contact/view.html.twig',
            array(
                'contactForm' => $contactForm->createView()
            ));
    }

}