<?php
namespace Laventure\Component\Templating\Template;

class TemplateTags
{
    public function toArray(): array
    {
         return [
             "@loop" => "<?php ",
             "@if"   => "<?php if ()"
         ];
    }
}