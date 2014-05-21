<?php

/**
 * Product form.
 *
 * @package    metatrader-backend
 * @subpackage form
 * @author     Anatoly Pashin
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductForm extends BaseProductForm
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

    $this->getWidgetSchema()
      ->offsetGet("description")
        ->setAttribute("class", "input-block-level")
        ->getParent()
      ->offsetSet("package", new sfWidgetFormInputFileEditable([
        "file_src" => "/uploads/packages/" . $this->getObject()->getPackage(),
        "is_image" => false,
        "with_delete" => false,
      ]))
      ->setLabels([
        "name" => "Наименование",
        "metaname" => "Код",
        "description" => "Описание",
        "package" => "Архив для скачивания",
      ])
    ;

    $this->getValidatorSchema()->offsetSet("package", new sfValidatorFile([
      "required" => false,
      "path"     => sfConfig::get("sf_upload_dir")."/packages",
    ]));
  }
}
