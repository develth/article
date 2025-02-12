<?php

declare(strict_types=1);

namespace Bolt\Article;

use Bolt\Widget\BaseWidget;
use Bolt\Widget\Injector\RequestZone;
use Bolt\Widget\Injector\Target;
use Bolt\Widget\TwigAwareInterface;

class ArticleInjectorWidget extends BaseWidget implements TwigAwareInterface
{
    protected $name = 'Article Injector Widget';
    protected $target = Target::AFTER_JS;
    protected $zone = RequestZone::BACKEND;
    protected $template = '@article/injector.html.twig';
    protected $priority = 200;

    public function __construct()
    {
    }

    public function run(array $params = []): ?string
    {
        $request = $this->getExtension()->getRequest();
        // Only produce output when editing or creating a Record, with GET method.
        if (! in_array($request->get('_route'), ['bolt_content_edit', 'bolt_content_new'], true) ||
            ($this->getExtension()->getRequest()->getMethod() !== 'GET')) {
            return null;
        }

        return parent::run();
    }
}
