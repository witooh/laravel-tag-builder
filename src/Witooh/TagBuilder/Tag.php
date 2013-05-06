<?php
namespace Witooh\TagBuilder;


class Tag
{

    /**
     * @var string
     */
    private $tag;

    /**
     * @var array
     */
    private $attribute;

    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $inner_html;

    /**
     * Make Tag object
     *
     * @param $tag
     * @return Tag
     */
    public function make($tag)
    {
        $this->tag        = $tag;
        $this->attribute  = array();
        $this->inner_html = array();

        return clone $this;
    }

    /**
     * Set ID Attribute of Html
     *
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = ' id="' . $id . '"';

        return $this;
    }

    /**
     * Add Attribute of Html Tag
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function attr($name, $value)
    {
        $this->attribute[$name] = $value;

        return $this;
    }

    /**
     * Remove Attribute of Html Tag
     *
     * @param string $name
     * @return $this
     */
    public function removeAttribute($name)
    {
        unset($this->attribute[$name]);

        return $this;
    }

    /**
     * Insert Html to inner html
     *
     * @param Tag|string $tag
     * @return $this
     */
    public function innerHtml($tag)
    {
        $this->inner_html[] = $tag;

        return $this;
    }

    /**
     * Generate Tag to Html string
     *
     * @return string
     */
    public function toString()
    {
        $str = '';
        $str .= $this->createOpenTag();
        $str .= $this->innerHtmlToString();
        $str .= $this->createCloseTag();

        return $str;
    }

    /**
     * Generate inner html array to string
     *
     * @return string
     */
    private function innerHtmlToString()
    {
        $result = '';
        foreach ($this->inner_html as $tag) {
            if ($tag instanceof Tag) {
                $result .= $tag->toString();
            } elseif (is_string($tag)) {
                $result .= $tag;
            }
        }

        return $result;
    }

    /**
     * Create open tag to string
     *
     * @return string
     */
    private function createOpenTag()
    {
        $openTag = '<' . $this->tag;
        $openTag .= $this->id;
        $openTag .= $this->mergeAttributes();
        $openTag .= '>';

        return $openTag;
    }

    /**
     * Merge Html Attribute to string
     *
     * @return string
     */
    private function mergeAttributes()
    {
        $attribute = '';
        foreach ($this->attribute as $name => $value) {
            $attribute .= ' ' . $name . '="' . $value . '"';
        }

        return $attribute;
    }

    /**
     * Create close tag to string
     *
     * @return string
     */
    private function createCloseTag()
    {
        return '</' . $this->tag . '>';
    }
}