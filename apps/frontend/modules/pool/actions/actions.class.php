<?php

/**
 * pool actions.
 *
 * @package    metatrader-backend
 * @subpackage pool
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class poolActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->pools = Doctrine_Query::create()
      ->from('Pool p')
      ->execute()
    ;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PoolForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PoolForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($pool = Doctrine_Core::getTable('Pool')->find(array($request->getParameter('id'))), sprintf('Object pool does not exist (%s).', $request->getParameter('id')));
    $this->form = new PoolForm($pool);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pool = Doctrine_Core::getTable('Pool')->find(array($request->getParameter('id'))), sprintf('Object pool does not exist (%s).', $request->getParameter('id')));
    $this->form = new PoolForm($pool);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($pool = Doctrine_Core::getTable('Pool')->find(array($request->getParameter('id'))), sprintf('Object pool does not exist (%s).', $request->getParameter('id')));
    $pool->delete();

    $this->redirect('pool/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $pool = $form->save();

      $this->redirect('pool/edit?id='.$pool->getId());
    }
  }
}
