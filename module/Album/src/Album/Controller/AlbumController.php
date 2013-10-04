<?php
 
namespace Album\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager; 
use Album\Form\AlbumForm; // <- adicionar isso
use Album\Entity\Album; // <- adicionar isso
 
class AlbumController extends AbstractActionController 
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
 
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
 
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
 
    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => $this->getEntityManager()->getRepository('Album\Entity\Album')->findAll()
        ));
    }
 
    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setAttribute('label', 'Add');
 
        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Album();
 
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $album->populate($form->getData());
                $this->getEntityManager()->persist($album);
                $this->getEntityManager()->flush();
 
                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
 
        return array('form' => $form);
    }
 
    public function editAction()
    {
    }
 
    public function deleteAction()
    {
    }
}