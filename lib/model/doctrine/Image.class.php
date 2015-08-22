<?php

/**
* Image
*
* This class has been auto-generated by the Doctrine ORM Framework
*
* @package    sfProject
* @subpackage model
* @author     Thiago Lagden
* @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
*/

use lagden\SaveFile as SaveFile;
use lagden\GetFile as GetFile;

class Image extends BaseImage
{
  static private function loadFormats()
  {
    $fmts = Doctrine_Core::getTable('Format')->findAll();
    if ($fmts->count()==0) {
      $fmts = new Doctrine_Collection('Format');
      $formats = array('S','S2x','T','T2x','B','B2x');
      foreach ($formats as $format) {
        $f = new Format();
        $f->name=$format;
        $f->save();
        $fmts->add($f);
      }
    }
    return $fmts;
  }

  protected function generateVersions($dir, $hash)
  {
    $ds       = DIRECTORY_SEPARATOR;
    $versions = new Doctrine_Collection('ImageVersion');
    $formats  = static::loadFormats();
    $base     = "{$dir}{$ds}{$hash}{$ds}{$this->id}";

    foreach ($formats as $format) {
      foreach (glob("{$base}{$ds}{$this->estate_id}-{$format->slug}.*") as $file)
      {
        if (is_file($file))
        {
          $file = basename($file);
          $filename = "{$hash}/{$this->id}/$file";

          // Generate the version
          $version = new ImageVersion();
          $version
            ->setImage($this)
            ->setFormat($format)
            ->setFile($filename);

          $versions->add($version);
        }
      }
    }
    return $versions;
  }

  public function save(Doctrine_Connection $conn = null)
  {
    // No id, no FUN
    if ($this->isNew()) {
      parent::save($conn);
    }

    if ($this->file && (strpos($this->file, '/') === false)) {

      // Salva Imagem
      $dir = $this->getTable()->dir();
      $param = [
        'id' => $this->id,
        'name' => $this->file
      ];

      $is = SaveFile::save(
        $param,
        $dir,
        '{*}',
        true,
        'blowimg',
        $this->estate_id
      );

      $this->file = "{$is['hash']}/{$this->id}/{$this->estate_id}.{$is['ext']}";

      $this->Versions->delete();
      $this->Versions = $this->generateVersions($dir, $is['hash']);
    }

    return parent::save($conn);
  }

  private function version($type)
  {
    foreach ($this->Versions as $version) {
      if($type === $version->Format->slug) {
        return $version->file;
      }
    }
    return null;
  }

  public function formato($type)
  {
    $formats = [
      'b2x' => 'large',
      'b'   => 'large',
      't2x' => 'medium1',
      't'   => 'medium2',
      's2x' => 'small',
      's'   => 'thumbnail',
    ];
    $ver = static::version($type);
    $verOld = static::version($formats[$type]);
    if ($ver) {
      return "/uploads/{$this->getTable()->className()}/{$ver}";
    }
    if ($verOld) {
      return "/estates/{$verOld}";
    }
    return null;
  }

  public function postDelete($event)
  {
    $o = $event->getInvoker();
    if($o->id) {
      $dir = SaveFile::encontreNoGrupo($o->getTable()->dir(), $o->id);
      if(is_dir($dir)) {
        sfToolkit::clearDirectory($dir);
        rmdir($dir);
      }
    }
  }

  // Old stuff compatibility
  static public function dir()
  {
    $ds = DIRECTORY_SEPARATOR;
    $web = sfConfig::get('sf_web_dir');
    return "{$web}{$ds}estates{$ds}";
  }

  public function delete(Doctrine_Connection $conn = null)
  {
    if ($this->id) {
      // Removing images when deleting the record
      $dir = static::dir().$this->id;
      if(is_dir($dir)) {
        sfToolkit::clearDirectory($dir);
        rmdir($dir);
      }
    }
    return parent::delete();
  }
}
