<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Document;
use AppBundle\Entity\Contact;
use AppBundle\Entity\DocumentType;
use AppBundle\Entity\DocumentCategory;
use AppBundle\Entity\DocumentFile;
use AppBundle\Entity\DocumentUser;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\HttpFoundation\Request;

class DocumentController extends Controller
{

    public $success = null;

    public function sidebarSearchAction()
    {
        if ($this->get('appbundle.utils')->checkSession($this->getRequest()) == false) {
            return new Response();
        }

        $this->get('appbundle.utils')->setCustomerConnection($this->getRequest(), $this);

        $types = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentType')->findBy(array('is_deleted' => false),
            array('document_type' => 'ASC'));
        $categories = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentCategory')->findBy(array('is_deleted' => false),
            array('document_category' => 'ASC'));
        $contacts = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Contact')->getContactNames($this->getRequest(),
            $this);

        return $this->render(
            'other/sidebar_search_document.html.twig',
            array(
                'types' => $types,
                'categories' => $categories,
                'contacts' => $contacts
            )
        );
    }

    /**
     * @Route("/document/type/edit/{document_type_id}/{value}", name="document_type_edit")
     */
    public function documentTypeEdit(Request $request, $document_type_id, $value)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        try {
            $man = $this->getDoctrine()->getManager('default');
            $type = $man->getRepository('AppBundle:DocumentType')->find($document_type_id);
            $type->setDocumentType($request->get('value'));
            $man->flush();
            $this->success = true;
        } catch (Exception $e) {
            $this->success = false;
        }

        return $this->documentDefinitions($request);
    }

    /**
     * @Route("/document/type/delete/{document_type_id}", name="document_type_delete")
     */
    public function documentTypeDelete(Request $request, $document_type_id)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        try {
            $man = $this->getDoctrine()->getManager('default');
            $type = $man->getRepository('AppBundle:DocumentType')->find($document_type_id);
            $type->setIsDeleted(true);
            $man->flush();
            $this->success = true;
        } catch (Exception $e) {
            $this->success = false;
        }

        return $this->documentDefinitions($request);
    }

    /**
     * @Route("/document/type/add", name="document_type_add")
     */
    public function documentTypeAdd(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        if ($request->get('btnDocTypeAdd') && $request->get('doc_type')) {
            $type = new DocumentType();
            $type->setDocumentType($request->get('doc_type'));
            $type->setIsDeleted(false);

            try {
                $man = $this->getDoctrine()->getManager('default');
                $man->persist($type);
                $man->flush();
                $this->success = true;
            } catch (Exception $e) {
                $this->success = false;
            }
        }

        return $this->documentDefinitions($request);
    }

    /**
     * @Route("/document/category/edit/{document_category_id}/{value}", name="document_category_edit")
     */
    public function documentCategoryEdit(Request $request, $document_category_id, $value)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        try {
            $man = $this->getDoctrine()->getManager('default');
            $category = $man->getRepository('AppBundle:DocumentCategory')->find($document_category_id);
            $category->setDocumentCategory($request->get('value'));
            $man->flush();
            $this->success = true;
        } catch (Exception $e) {
            $this->success = false;
        }

        return $this->documentDefinitions($request);
    }

    /**
     * @Route("/document/category/delete/{document_category_id}", name="document_category_delete")
     */
    public function documentCategoryDelete(Request $request, $document_category_id)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        try {
            $man = $this->getDoctrine()->getManager('default');
            $category = $man->getRepository('AppBundle:DocumentCategory')->find($document_category_id);
            $category->setIsDeleted(true);
            $man->flush();
            $this->success = true;
        } catch (Exception $e) {
            $this->success = false;
        }

        return $this->documentDefinitions($request);
    }

    /**
     * @Route("/document/category/add", name="document_category_add")
     */
    public function documentCategoryAdd(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        if ($request->get('btnDocCategoryAdd') && $request->get('doc_category')) {
            $category = new DocumentCategory();
            $category->setDocumentCategory($request->get('doc_category'));
            $category->setIsDeleted(false);

            try {
                $man = $this->getDoctrine()->getManager('default');
                $man->persist($category);
                $man->flush();
                $this->success = true;
            } catch (Exception $e) {
                $this->success = false;
            }
        }

        return $this->documentDefinitions($request);
    }

    /**
     * @Route("/document/definitions", name="document_definitions")
     */
    public function documentDefinitions(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $type_list = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentType')->findBy(
            array('is_deleted' => false),
            array('document_type' => 'ASC')
        );

        $category_list = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentCategory')->findBy(
            array('is_deleted' => false),
            array('document_category' => 'ASC')
        );

        return $this->render('document/definitions.html.twig',
            array(
                'type_list' => $type_list,
                'category_list' => $category_list,
                'success' => $this->success
            ));
    }

    /**
     * @Route("/document/search/{clear}", name="document_search", defaults={"clear" = ""})
     */
    public function searchDocument(Request $request, $clear = "")
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $session = $request->getSession();

        if ($request->get('document_filter_column') != null && $request->get('btn_quick_document_search') != null) {

            $session->remove('document_filter');
            $session->set('document_filter', true);

            if ($request->get('document_filter_column') == 'document_filter_subject') {
                $session->set('document_filter_subject', $request->get('document_filter_value'));
            }

            if ($request->get('document_filter_column') == 'document_filter_no') {
                $session->set('document_filter_no', $request->get('document_filter_value'));
            }

            if ($request->get('document_filter_column') == 'document_filter_document_date') {
                if ($request->get('qds_date_start') != '') {
                    $session->set('document_filter_document_date_start', $request->get('qds_date_start'));
                }
                if ($request->get('qds_date_end') != '') {
                    $session->set('document_filter_document_date_end', $request->get('qds_date_end'));
                }
            }

            if ($request->get('document_filter_column') == 'document_filter_date_added') {
                if ($request->get('qds_date_start') != '') {
                    $session->set('document_filter_date_added_start', date_format(date_create($request->get('qds_date_start')), 'U'));
                }
                if ($request->get('qds_date_end') != '') {
                    $session->set('document_filter_date_added_end', date_format(date_create($request->get('qds_date_end')), 'U'));
                }
            }

            if ($request->get('document_filter_column') == 'document_filter_notes') {
                $session->set('document_filter_notes', $request->get('document_filter_value'));
            }

            if ($request->get('document_filter_column') == 'document_filter_type') {
                $session->set('document_filter_type', $request->get('qds_types'));
            }

            if ($request->get('document_filter_column') == 'document_filter_category') {
                $session->set('document_filter_category', $request->get('qds_categories'));
            }

            if ($request->get('document_filter_column') == 'document_filter_from') {
                $session->set('document_filter_from', $request->get('qds_contacts'));
            }

            if ($request->get('document_filter_column') == 'document_filter_to') {
                $session->set('document_filter_to', $request->get('qds_contacts'));
            }
        }

        if ($clear == "clear") {
            $session->remove('document_filter');
            $session->remove('document_filter_subject');
            $session->remove('document_filter_no');
            $session->remove('document_filter_notes');
            $session->remove('document_filter_type');
            $session->remove('document_filter_category');
            $session->remove('document_filter_from');
            $session->remove('document_filter_to');
            $session->remove('document_filter_document_date_start');
            $session->remove('document_filter_document_date_end');
            $session->remove('document_filter_date_added_start');
            $session->remove('document_filter_date_added_end');
        }

        return $this->listDocument($request);
    }

    /**
     * @Route("/document/sort/{column}/{dir}", name="documents_sort", requirements={"dir": "asc|desc"})
     */
    public function sortDocuments(Request $request, $column, $dir)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $c = explode(".", $column);

        if ($c[0] == 'document') {
            if (property_exists(Document::Class, $c[1]) == false) {
                $this->success = false;
                return $this->listDocument($request);
            }
        }

        if ($c[0] == 'type') {
            if (property_exists(DocumentType::Class, $c[1]) == false) {
                $this->success = false;
                return $this->listDocument($request);
            }
        }

        if ($c[0] == 'category') {
            if (property_exists(DocumentCategory::Class, $c[1]) == false) {
                $this->success = false;
                return $this->listDocument($request);
            }
        }

        $request->getSession()->set('document_sort_column', $column);
        $request->getSession()->set('document_sort_dir', $dir);
        return $this->listDocument($request);
    }

    /**
     * @Route("/document/view/{document_id}", name="document_view")
     */
    public function viewDocument(Request $request, $document_id)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $session = $request->getSession();
        $userList = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:User')->findAll();
        $this->get('appbundle.utils')->setCustomerConnection($request, $this);
        $man = $this->getDoctrine()->getManager('default');
        $document = $man->getRepository('AppBundle:Document')->find($document_id);
        $document->date_format = $request->getSession()->get('user_options')['date_format'];

        if (!$document || $request->getSession()->get('user_options')['priv_document_edit'] == false) {
            $this->success = false;
            return $this->listDocument($request);
        }

        if ($document->getTypeId()) {
            $getType = $man->getRepository('AppBundle:DocumentType')->find($document->getTypeId());
            $document->setTypeId($getType);
        }

        if ($document->getCategoryId()) {
            $getCategory = $man->getRepository('AppBundle:DocumentCategory')->find($document->getCategoryId());
            $document->setCategoryId($getCategory);
        }

        if ($document->getFromContact()) {
            $getContact = $man->getRepository('AppBundle:Contact')->find($document->getFromContact());
            $document->setFromContact($getContact);
        }

        if ($document->getToContact()) {
            $getContact = $man->getRepository('AppBundle:Contact')->find($document->getToContact());
            $document->setToContact($getContact);
        }

        $lookupContact = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Contact')->createQueryBuilder('c')
            ->where('c.is_deleted = false')
            ->orderBy('c.contact_name', 'ASC');

        $lookupType = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentType')->createQueryBuilder('type')
            ->where('type.is_deleted = false')
            ->orderBy('type.document_type', 'ASC');

        $lookupCategory = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentCategory')->createQueryBuilder('category')
            ->where('category.is_deleted = false')
            ->orderBy('category.document_category', 'ASC');

        $documentForm = $this->createFormBuilder($document)
            ->setAction($this->generateUrl('document_view', array('document_id' => $document_id)))
            ->add('document_subject', TextType::class)
            ->add('document_no', TextType::class, array('required' => false))
            ->add('document_date', DateType::class,
                array('required' => false, 'html5' => false, 'widget' => 'single_text', 'format' => 'yyyy-MM-dd'))
            ->add('expiry_date', DateType::class,
                array('required' => false, 'html5' => false, 'widget' => 'single_text', 'format' => 'yyyy-MM-dd'))
            ->add('filing_cabinet_no', TextType::class, array('required' => false))
            ->add('from_contact', EntityType::class, array(
                'class' => 'AppBundle:Contact',
                'choice_label' => 'contact_name',
                'choice_value' => 'contact_id',
                'required' => false,
                'placeholder' => $this->get('translator')->trans('choose'),
                'query_builder' => function () use ($lookupContact) {
                    return $lookupContact;
                }
            ))
            ->add('to_contact', EntityType::class, array(
                'class' => 'AppBundle:Contact',
                'choice_label' => 'contact_name',
                'choice_value' => 'contact_id',
                'required' => false,
                'placeholder' => $this->get('translator')->trans('choose'),
                'query_builder' => function () use ($lookupContact) {
                    return $lookupContact;
                }
            ))
            ->add('type_id', EntityType::class, array(
                'class' => 'AppBundle:DocumentType',
                'choice_label' => 'document_type',
                'choice_value' => 'document_type_id',
                'required' => false,
                'placeholder' => $this->get('translator')->trans('choose'),
                'query_builder' => function () use ($lookupType) {
                    return $lookupType;
                }
            ))
            ->add('category_id', EntityType::class, array(
                'class' => 'AppBundle:DocumentCategory',
                'choice_label' => 'document_category',
                'choice_value' => 'document_category_id',
                'required' => false,
                'placeholder' => $this->get('translator')->trans('choose'),
                'query_builder' => function () use ($lookupCategory) {
                    return $lookupCategory;
                }
            ))
            ->add('notes', TextareaType::class, array('required' => false))
            ->add('from_contact_add', TextType::class, array('required' => false, 'mapped' => false))
            ->add('to_contact_add', TextType::class, array('required' => false, 'mapped' => false))
            ->add('type_add', TextType::class, array('required' => false, 'mapped' => false))
            ->add('category_add', TextType::class, array('required' => false, 'mapped' => false))
            ->add('related_users', HiddenType::class, array('required' => false, 'mapped' => false))
            ->add('btn_save_document', SubmitType::class)
            ->add('btn_cancel', ButtonType::class)
            ->getForm();

        if ($request->getSession()->get('user_options')['priv_document_edit'] == false) {
            $documentForm->remove('btn_save_document');
        }

        $documentForm->handleRequest($request);

        if ($documentForm->isSubmitted() && $documentForm->isValid()) {

            try {

                if ($documentForm->get('from_contact_add')->getData() != '') {
                    $m = $this->getDoctrine()->getManager('default');
                    $c = new Contact();
                    $c->setContactType(1);
                    $c->setContactName($documentForm->get('from_contact_add')->getData());
                    $c->setIsDeleted(false);
                    $m->persist($c);
                    $m->flush();
                    $document->setFromContact($c->getContactId());
                }

                if ($documentForm->get('to_contact_add')->getData() != '') {
                    $m = $this->getDoctrine()->getManager('default');
                    $c = new Contact();
                    $c->setContactType(1);
                    $c->setContactName($documentForm->get('to_contact_add')->getData());
                    $c->setIsDeleted(false);
                    $m->persist($c);
                    $m->flush();
                    $document->setToContact($c->getContactId());
                }

                if ($documentForm->get('type_add')->getData() != '') {
                    $m = $this->getDoctrine()->getManager('default');
                    $c = new DocumentType();
                    $c->setDocumentType($documentForm->get('type_add')->getData());
                    $c->setIsDeleted(false);
                    $m->persist($c);
                    $m->flush();
                    $document->setTypeId($c->getDocumentTypeId());
                }

                if ($documentForm->get('category_add')->getData() != '') {
                    $m = $this->getDoctrine()->getManager('default');
                    $c = new DocumentCategory();
                    $c->setDocumentCategory($documentForm->get('category_add')->getData());
                    $c->setIsDeleted(false);
                    $m->persist($c);
                    $m->flush();
                    $document->setCategoryId($c->getDocumentCategoryId());
                }

                $document->setIsTemp(false);
                $document->setTempTimestamp(null);
                $document->setIsDeleted(false);

                $man->persist($document);
                $man->flush();

                if (null !== $documentForm->get('related_users')->getData()) {
                    $relatedUsers = json_decode($documentForm->get('related_users')->getData(), true);

                    $deleteUsersQuery = $man->createQuery('DELETE FROM AppBundle:DocumentUser du WHERE du.document_id = :document_id')
                        ->setParameter('document_id', $document_id);
                    $deleteUsersQuery->execute();

                    foreach ($relatedUsers as $relatedUser) {
                        $documentUser = new DocumentUser();
                        $documentUser->setDocumentId($document_id);
                        $documentUser->setFromUserId($session->get('user_id'));
                        $documentUser->setUserId($relatedUser);
                        $man->persist($documentUser);
                        $man->flush();
                    }
                }

                $this->success = true;
            } catch (Exception $e) {
                $this->success = false;
            }

            $session->set('document_count',
                $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Document')->documentCount($request,
                    $this));

            return $this->listDocument($request);
        }

        $file_list = $this->get('appbundle.file')->listFiles($request, $document_id, 'entity');
        $total_files = count($file_list);

        $disk_usage = $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentFile')->diskUsage($request,
            $this);

        $disk_usage_percent = ($disk_usage * 100) / $session->get('customer_disk_limit');

        return $this->render('document/view.html.twig',
            array(
                'userList' => $userList,
                'documentForm' => $documentForm->createView(),
                'document_id' => $document_id,
                'file_list' => $file_list,
                'total_files' => $total_files,
                'disk_usage' => $disk_usage,
                'disk_usage_percent' => $disk_usage_percent
            ));
    }

    /**
     * @Route("/document/delete/{document_id}", name="document_delete")
     * @Method("GET")
     */
    public function deleteDocument(Request $request, $document_id)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $session = $request->getSession();

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $man = $this->getDoctrine()->getManager('default');

        try {
            $document = $man->getRepository('AppBundle:Document')->find($document_id);
            if ($document && $request->getSession()->get('user_options')['priv_document_delete'] == true) {
                $document->setIsDeleted(true);
                $man->flush();
                $fileMan = $this->getDoctrine()->getManager('default');
                $file = $man->getRepository('AppBundle:DocumentFile')->findBy(array(
                    'document_id' => $document_id
                ));
                foreach ($file as $f) {
                    unlink('PFS/' . $f->getPath() . $f->getFileName());
                    $fileMan->remove($f);
                }
                $fileMan->flush();
                $this->success = true;
                $request->getSession()->set('document_count',
                    $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Document')->documentCount($request,
                        $this));
                $request->getSession()->set('file_count',
                    $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentFile')->fileCount($request,
                        $this));
            } else {
                $this->success = false;
            }
        } catch (Exception $e) {
            $this->success = false;
        }

        $session->set('document_count',
            $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Document')->documentCount($request,
                $this));
        $session->set('file_count',
            $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentFile')->fileCount($request,
                $this));

        return $this->listDocument($request);
    }

    /**
     * @Route("/document/list/{page}", name="document_list", defaults={"page" = 1})
     */
    public function listDocument(Request $request, $page = 1)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);

        $session = $request->getSession();

        if ($page == 1) {
            $start = 0;
        } else {
            $start = ($page - 1) * $session->get('user_options')['document_list_show'];
        }

        $em = $this->getDoctrine()->getManager('default');

        $qb = $em->createQueryBuilder()->from('AppBundle:Document',
            'document')->select('document, type, category, contact');

        $list = $qb->leftJoin("AppBundle:DocumentType", "type", "WITH", "document.type_id = type.document_type_id");
        $list = $qb->leftJoin("AppBundle:DocumentCategory", "category", "WITH",
            "document.category_id = category.document_category_id");
        $list = $qb->leftJoin("AppBundle:Contact", "contact", "WITH", "document.from_contact = contact.contact_id");
        $list = $qb->andWhere('document.is_deleted = false');
        $list = $qb->andWhere('document.is_temp = false');
        $list = $qb->orderBy($session->get('document_sort_column'), $session->get('document_sort_dir'));

        if ($session->has('document_filter')) {

            if ($session->has('document_filter_subject')) {
                $list = $qb->andWhere("document.document_subject LIKE :document_subject");
                $list->setParameter('document_subject', '%' . $session->get('document_filter_subject') . '%');
            }

            if ($session->has('document_filter_no')) {
                $list = $qb->andWhere("document.document_no LIKE :no");
                $list->setParameter('no', '%' . $session->get('document_filter_no') . '%');
            }

            if ($session->has('document_filter_notes')) {
                $list = $qb->andWhere("document.notes LIKE :notes");
                $list->setParameter('notes', '%' . $session->get('document_filter_notes') . '%');
            }

            if ($session->has('document_filter_document_date_start') && !$session->has('document_filter_document_date_end')) {
                $list = $qb->andWhere("document.document_date = :document_date_start");
                $list->setParameter('document_date_start', $session->get('document_filter_document_date_start'));
            }

            if ($session->has('document_filter_document_date_start') && $session->has('document_filter_document_date_end')) {
                $list = $qb->andWhere("(document.document_date between :document_date_start and :document_date_end)");
                $list->setParameter('document_date_start', $session->get('document_filter_document_date_start'));
                $list->setParameter('document_date_end', $session->get('document_filter_document_date_end'));
            }

            if ($session->has('document_filter_date_added_start') && !$session->has('document_filter_date_added_end')) {
                $list = $qb->andWhere("(document.date_added >= :document_date_added_start and document.date_added <= :document_date_added_start_2)");
                $list->setParameter('document_date_added_start', $session->get('document_filter_date_added_start'));
                $list->setParameter('document_date_added_start_2', $session->get('document_filter_date_added_start') + 86400);
            }

            if ($session->has('document_filter_type')) {
                $list = $qb->andWhere("document.type_id = :type_id");
                $list->setParameter('type_id', $session->get('document_filter_type'));
            }

            if ($session->has('document_filter_category')) {
                $list = $qb->andWhere("document.category_id = :category_id");
                $list->setParameter('category_id', $session->get('document_filter_category'));
            }

            if ($session->has('document_filter_from')) {
                $list = $qb->andWhere("document.from_contact = :from_contact_id");
                $list->setParameter('from_contact_id', $session->get('document_filter_from'));
            }

            if ($session->has('document_filter_to')) {
                $list = $qb->andWhere("document.to_contact = :to_contact_id");
                $list->setParameter('to_contact_id', $session->get('document_filter_to'));
            }

        }

        $list = $qb->getQuery()->getResult(Query::HYDRATE_SCALAR);

        $total = count($list);
        $pageCount = ceil($total / $session->get('user_options')['document_list_show']);

        $list = $qb->setFirstResult($start);
        $list = $qb->setMaxResults($session->get('user_options')['document_list_show']);
        $list = $qb->getQuery()->getResult(Query::HYDRATE_SCALAR);

        return $this->render('document/list.html.twig',
            array(
                'list' => $list,
                'total' => $total,
                'pageCount' => $pageCount,
                'page' => $page,
                'success' => $this->success
            ));
    }

    /**
     * @Route("/document/add", name="document_add")
     */
    public function addDocument(Request $request)
    {
        if ($this->get('appbundle.utils')->checkSession($request) == false) {
            return $this->redirectToRoute('login_form');
        }

        $this->get('appbundle.utils')->setCustomerConnection($request, $this);
        $document = new Document();
        $document->setIsTemp(true);
        $document->setTempTimestamp(time());
        $document->setIsDeleted(false);
        $document->setUserId($request->getSession()->get('user_id'));
        $document->setDateAdded(time());

        try {
            $man = $this->getDoctrine()->getManager('default');
            $man->persist($document);
            $man->flush();
            $request->getSession()->set('document_count',
                $this->getDoctrine()->getManager('default')->getRepository('AppBundle:Document')->documentCount($request,
                    $this));

            return $this->viewDocument($request, $document->getDocumentId());
        } catch (Exception $e) {
            $this->success = false;
        }
    }

}