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

class FileController extends Controller
{
    private $success = null;

    /**
     * @Route("/file/list/{document_id}/{type}", name="file_list")
     * @Method({"GET", "POST"})
     */
    public function listFiles(Request $request, $document_id, $type = 'json')
    {
        if ($this->get('appbundle.utils')->checkSession($this->getRequest()) == false) {
            return new Response();
        }

        $this->get('appbundle.utils')->setCustomerConnection($this->getRequest(), $this);

        $man = $this->getDoctrine()->getManager('default');

        $qb = $man->createQueryBuilder()->from('AppBundle:DocumentFile', 'file')->select('file, user.full_name');

        $list = $qb->leftJoin("AppBundle:User", "user", "WITH", "file.user_id = user.user_id");
        $list = $qb->andWhere("file.document_id = {$document_id}");
        $list = $qb->orderBy('file.file_name', 'ASC');

        if ($type == 'json') {
            $list = $qb->getQuery()->getResult();
            $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
            $list = $serializer->serialize($list, 'json');
            return new Response($list);
        }

        if ($type == 'html') {
            $list = $qb->getQuery()->getResult(Query::HYDRATE_SCALAR);
            $res = '';
            foreach ($list as $l) {
                $downloadUrl = $this->generateUrl('file_download',
                    array('file_id' => $l['file_file_id'], 'file_name' => $l['file_file_name']));
                $res .= '<li id="file-id-' . $l['file_file_id'] . '" class="file-row">
                <a href="javascript:void(0);" class="send-email" data-file-id="' . $l['file_file_id'] . '"><span class="icon-email" style="color: #BA6D6D;"></span></a>
                    <a href="' . $downloadUrl . '">' . $l['file_file_name'] . '</a>
                    <span data-file-id="' . $l['file_file_id'] . '" class="remove btnFileDelete"></span>
                </li>';
            }

            return new Response($res);
        }

        if ($type == 'entity') {
            $list = $qb->getQuery()->getResult(Query::HYDRATE_SCALAR);
            return $list;
        }
    }

    /**
     * @Route("/file/delete/{file_id}", name="file_delete")
     * @Method({"GET", "POST"})
     */
    public function fileDelete(Request $request, $file_id)
    {
        if ($this->get('appbundle.utils')->checkSession($this->getRequest()) == false) {
            return new Response();
        }

        $this->get('appbundle.utils')->setCustomerConnection($this->getRequest(), $this);

        $man = $this->getDoctrine()->getManager('default');

        $file = $man->getRepository('AppBundle:DocumentFile')->find($file_id);

        if ($file && file_exists('PFS/' . $file->getPath() . $file->getFileName()) && $this->getRequest()->getSession()->get('user_options')['priv_file_delete'] == true) {
            try {
                unlink('PFS/' . $file->getPath() . $file->getFileName());
                $man->remove($file);
                $man->flush();
                $this->success = true;
                $request->getSession()->set('file_count', $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentFile')->fileCount($request, $this));
            } catch (Exception $e) {
                $this->success = false;
            }
        } else {
            $this->success = false;
        }

        return new Response(var_export($this->success));
    }

    /**
     * @Route("/file/download/{file_id}/{file_name}", name="file_download")
     * @Method({"GET", "POST"})
     */
    public function fileDownload($file_id, $file_name)
    {
        if ($this->get('appbundle.utils')->checkSession($this->getRequest()) == false) {
            return new Response();
        }

        $this->get('appbundle.utils')->setCustomerConnection($this->getRequest(), $this);

        $man = $this->getDoctrine()->getManager('default');

        $file = $man->getRepository('AppBundle:DocumentFile')->find($file_id);

        if ($file && file_exists('PFS/' . $file->getPath() . $file->getFileName())) {
            return new BinaryFileResponse('PFS/' . $file->getPath() . $file->getFileName(), 200, array(
                'Content-type'  => 'application/octect-stream',
                "Cache-Control" => "no-cache, no-store, must-revalidate"
            ));
        } else {
            return new Response();
        }
    }

    /**
     * @Route("/file/upload/{document_id}", name="file_upload")
     * @Method({"GET", "POST"})
     */
    public function fileUpload(Request $request, $document_id)
    {
        if ($this->get('appbundle.utils')->checkSession($this->getRequest()) == false) {
            return new Response();
        }

        $this->get('appbundle.utils')->setCustomerConnection($this->getRequest(), $this);

        $session = $this->getRequest()->getSession();

        $path = 'PFS/' . $session->get('customer_id') . '/';

        if (!file_exists($path)) {
            mkdir($path, 0777);
        }

        $path .= date("Y") . '/';

        if (!file_exists($path)) {
            mkdir($path, 0777);
        }

        $path .= date("m") . '/';

        if (!file_exists($path)) {
            mkdir($path, 0777);
        }

        $path .= $document_id . '/';

        if (!file_exists($path)) {
            mkdir($path, 0777);
        }

        $i = rand(1, 9);

        $man = $this->getDoctrine()->getManager('default');

        foreach ($_FILES as $key) {

            $i++;
            srand(time() * $i);
            $rnd = rand(11111, 99999) . '/';

            if (!file_exists($path . $rnd)) {
                mkdir($path . $rnd, 0777);
            }

            if (move_uploaded_file($key['tmp_name'], $path . $rnd . $key['name'])) {
                $file = new DocumentFile();
                $file->setFileName($key['name']);
                $file->setPath(str_replace('PFS/', '', $path . $rnd));
                $file->setDateAdded(time());
                $file->setUserId($session->get('user_id'));
                $file->setDocumentId($document_id);
                $file->setSize(number_format($key['size'] / 1048576, 2));
                $man->persist($file);
                $man->flush();
                $request->getSession()->set('file_count', $this->getDoctrine()->getManager('default')->getRepository('AppBundle:DocumentFile')->fileCount($request, $this));
            }
        }

        return $this->listFiles($request, $document_id, 'html');
    }
}
