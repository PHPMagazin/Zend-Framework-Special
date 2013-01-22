<?php
namespace Zhorty\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TrimController extends AbstractActionController
{
    private $trimForm;
    
    public function indexAction()
    {
        // Get the form in the service_manager
        // configuration.
        // $sm = $this->getServiceLocator();
        // $form = $sm->get('Zhorty\Form\Trim');
        return new ViewModel(array('form' => $this->getTrimForm()));
    }
    
    public function setTrimForm($trimForm)
    {
        $this->trimForm = $trimForm;
    }
    
    public function getTrimForm()
    {
        return $this->trimForm;
    }
}
