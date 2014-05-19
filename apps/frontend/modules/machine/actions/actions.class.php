<?php

/**
 * machine actions.
 *
 * @package    metatrader-backend
 * @subpackage machine
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class machineActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->machines = Doctrine_Query::create()
      ->from('Machine m')
      ->execute()
    ;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MachineForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MachineForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($machine = Doctrine_Core::getTable('Machine')->find(array($request->getParameter('id'))), sprintf('Object machine does not exist (%s).', $request->getParameter('id')));
    $this->form = new MachineForm($machine);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($machine = Doctrine_Core::getTable('Machine')->find(array($request->getParameter('id'))), sprintf('Object machine does not exist (%s).', $request->getParameter('id')));
    $this->form = new MachineForm($machine);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($machine = Doctrine_Core::getTable('Machine')->find(array($request->getParameter('id'))), sprintf('Object machine does not exist (%s).', $request->getParameter('id')));
    $machine->delete();

    $this->redirect('machine/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $machine = $form->save();

      $this->redirect('machine/edit?id='.$machine->getId());
    }
  }
}
