<?php
namespace Witooh\TagBuilder;


class Tag
{

    private $tag;
    private $attribute;
    private $id;
    private $inner_html;
    private $beforeInnerHtml;
    private $afterInnerHtml;

    public function make($tag)
    {
        $this->tag = $tag;
        $this->attribute = array();
        $this->inner_html = '';
        $this->afterInnerHtml = array();
        $this->beforeInnerHtml = array();
        return clone $this;
    }

    public function setId($id)
    {
        $this->id = ' id="' . $id . '"';

        return $this;
    }

    public function attr($name, $value)
    {
        $this->attribute[$name] = $value;

        return $this;
    }

    public function removeAttribute($name)
    {
        unset($this->attribute[$name]);

        return $this;
    }

    public function innerHtml($str)
    {
        $this->inner_html = $str;

        return $this;
    }

    public function appendInnerHtml($str){
        $this->inner_html .= $str;

        return $this;
    }

    public function beforeInnerHtml(Tag $tag){
        $this->beforeInnerHtml[] = $tag;

        return $this;
    }

    public function afterInnerHtml(Tag $tag){
        $this->afterInnerHtml[] = $tag;

        return $this;
    }

    public function toString()
    {
        $str = '';
        $str .= $this->createOpenTag();
        $str .= $this->TagsToString($this->beforeInnerHtml);
        $str .= $this->inner_html;
        $str .= $this->TagsToString($this->afterInnerHtml);
        $str .= $this->createCloseTag();

        return $str;
    }

    private function TagsToString($tags){
        if(empty($tags))
            return '';

        $str = '';
        foreach($tags as $tag){
            $str .= $tag->toString();
        }

        return $str;
    }

    private function createOpenTag()
    {
        $openTag = '<' . $this->tag;
        $openTag .= $this->id;
        $openTag .= $this->mergeAttributes();
        $openTag .= '>';

        return $openTag;
    }

    private function mergeAttributes()
    {
        $attribute = '';
        foreach ($this->attribute as $name => $value) {
            $attribute .= ' ' . $name . '="' . $value . '"';
        }

        return $attribute;
    }

    private function createCloseTag()
    {
        return '</' . $this->tag . '>';
    }
}