<?php
namespace WebSite\Controller;
use Symfony\Component\Yaml\Parser;

class AbstractBaseController{

$yaml = new Parser();

$routes = $yaml->parse(file_get_contents('../app/config/config-prod.yml'));

}