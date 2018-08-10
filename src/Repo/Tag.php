<?php

namespace QuadStudio\Repo;

use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

final class Tag
{

    /**
     * @var array|\Illuminate\Config\Repository|mixed
     */
    protected $config = [];
    /**
     * Html tag name
     * @var string
     */
    private $tag = '';
    /**
     * Indicates the need to close the tag
     *
     * @var bool
     */
    private $canClose = true;

    /**
     * @var Collection
     */
    private $attributes;
    /**
     * @var array
     */
    private $global = [];
    /**
     * @var Collection
     */
    private $arguments;

    private $content;

    /**
     * Tag constructor.
     *
     * @param $name
     * @param $arguments
     */
    public function __construct($name, $arguments)
    {
        $this->global['attributes'] = config('global.attributes', []);
        $this->attributes = collect([]);
        //$this->global['events'] = config('global.events', []);
        $this->getConfig($name);

        $this->setTag($name);
        $this->arguments = collect($arguments);
        $this->collectData();
    }

    /**
     * @param $name
     */
    public function getConfig($name)
    {

        $this->config = config("tag.{$name}");
        if (!is_null($this->config)) {
            $this->config['attributes'] = array_merge($this->config['attributes'], config('global.attributes', []));
        }
    }

    /**
     * @param $name
     */
    private function setTag($name)
    {

        if (is_null($this->config)) {
            $this->tag = $name;
        } else {
            $this->tag = array_get($this->config, 'tag', $name);

        }
    }

    /**
     *
     */
    private function collectData()
    {
        $this->collectProperties();

        $this->collectPredefinedAttributes();

        foreach ($this->arguments as $key => $value) {
            if ($key == 'attributes') {
                $this->collectAttributes($value);
            } elseif ($key == 'content') {
                $this->putContent($value);
            }
        }
    }

    /**
     *
     */
    private function collectProperties()
    {
        $this->setClose(array_get($this->config, 'closed', false));
    }

    /**
     * @param $canClose
     */
    private function setClose($canClose)
    {
        $this->canClose = (bool)$canClose;
    }

    /**
     *
     */
    private function collectPredefinedAttributes()
    {
        if (key_exists('attributes', $this->config)) {
            foreach ($this->config['attributes'] as $key => $value) {
                if (is_string($key) && is_string($value)) {
                    $this->attributes[$key] = $value;
                }
            }
        }
    }

    /**
     * @param $attributes
     */
    private function collectAttributes($attributes)
    {
        foreach ($attributes as $key => $value) {
            if (!is_string($key)) {
                $key = $value;
                $value = true;
            }
            $this->putAttribute($key, $value);
        }
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function putAttribute($key, $value)
    {
        if (in_array($key, $this->config["attributes"]) || substr($key, 0, 5) == 'data-') {
            $this->attributes[$key] = $value;
        }
        return $this;
    }

    /**
     * @param $content
     */
    public function putContent($content)
    {
        $result = '';

        $this->_collectContent($result, $content);
        $this->content = $result;
    }

    /**
     * @param $result
     * @param $content
     */
    private function _collectContent(&$result, $content)
    {
        if (is_array($content)) {
            foreach ($content as $value) {
                $this->_collectContent($result, $value);
            }
        } else {
            $result .= $content;
        }
    }

    /**
     * @param $key
     * @param $value
     * @param string $separator
     * @return $this
     */
    public function mergeAttribute($key, $value, $separator = '')
    {
        if ($this->attributes()->has($key)) {
            $attribute = $this->attributes->get($key);
            if (is_array($attribute)) {
                $attribute[] = $value;
            } else {
                $attribute .= $separator . $value;
            }
            $this->attributes()->put($key, $attribute);
        } else {
            $this->putAttribute($key, $value);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function attributes()
    {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render()->toHtml();
    }

    /**
     * @return HtmlString
     */
    public function render()
    {
        return $this->toHtmlString('<' . $this->getTag() . $this->getAttributes() . $this->closeTag() . '>');
    }

    /**
     * @param $html
     * @return HtmlString
     */
    private function toHtmlString($html)
    {
        return new HtmlString($html);
    }

    /**
     * @return string
     */
    private function getTag()
    {
        return $this->tag;
    }
//
//    public function __toString()
//    {
//       return (string)$this->tag();
//    }

    /**
     * @return string
     */
    private function getAttributes()
    {
        $html = collect([]);

        foreach ($this->attributes as $key => $value) {
            $element = $this->attribute($key, $value);
            if (!is_null($element)) {
                $html->push($element);
            }
        }

        return $html->isNotEmpty() ? ' ' . $html->implode(' ') : '';
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    private function attribute($key, $value)
    {
        // For numeric keys we will assume that the value is a boolean attribute
        // where the presence of the attribute represents a true value and the
        // absence represents a false value.
        // This will convert HTML attributes such as "required" to a correct
        // form instead of using incorrect numerics.
        if (is_numeric($key)) {
            return $value;
        }
        // Treat boolean attributes as HTML properties
        if (is_bool($value) && $key !== 'value') {
            return $value ? $key : '';
        }
        if (!is_null($value)) {
            return $key . '="' . $this->encode($value, false) . '"';
        }

        return null;
    }

    /**
     * Convert an HTML string to entities.
     *
     * @param string $value
     * @param bool $double_encode
     *
     * @return string
     */
    private function encode($value, $double_encode = false)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', $double_encode);
    }

    /**
     * @return string
     */
    private function closeTag()
    {
        return $this->canClose ? (">" . $this->getContent() . "</" . $this->getTag()) : ' /';
    }

    /**
     * @return string
     */
    private function getContent()
    {
        return $this->content;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        return array_get($this->attributes, $key, null);
    }

    /**
     * @return bool
     */
    public function getClose(): bool
    {
        return $this->canClose;
    }

    /**
     * @return Collection
     */
    public function arguments()
    {
        return $this->arguments;
    }

    /**
     * Convert entities to HTML characters.
     *
     * @param string $value
     *
     * @return string
     */
    public function decode($value)
    {
        return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    }

}