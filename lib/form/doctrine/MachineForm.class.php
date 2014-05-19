<?php

/**
 * Machine form.
 *
 * @package    metatrader-backend
 * @subpackage form
 * @author     Anatoly Pashin
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MachineForm extends BaseMachineForm
{
  public function configure()
  {
    unset (
      $this["created_at"]
      , $this["updated_at"]
      , $this["created_by"]
      , $this["updated_by"]
      , $this["version"]
    );
  }
}
