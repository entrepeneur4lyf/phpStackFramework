<?php

namespace phpStack\Templating;

class DiffEngine
{
    public function calculateDiff(string $oldHtml, string $newHtml): array
    {
        $oldDom = new \DOMDocument();
        $newDom = new \DOMDocument();
        
        @$oldDom->loadHTML($oldHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        @$newDom->loadHTML($newHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $oldXpath = new \DOMXPath($oldDom);
        $newXpath = new \DOMXPath($newDom);

        $changes = [];

        $this->compareNodes($oldDom->documentElement, $newDom->documentElement, $oldXpath, $newXpath, $changes);

        return $changes;
    }

    private function compareNodes(\DOMNode $oldNode, \DOMNode $newNode, \DOMXPath $oldXpath, \DOMXPath $newXpath, array &$changes, string $path = '/')
    {
        if ($oldNode->nodeType !== XML_ELEMENT_NODE || $newNode->nodeType !== XML_ELEMENT_NODE) {
            return;
        }

        if ($oldNode->nodeName !== $newNode->nodeName) {
            $changes[] = ['action' => 'replace', 'path' => $path, 'content' => $newDom->saveHTML($newNode)];
            return;
        }

        $oldAttributes = $this->getAttributes($oldNode);
        $newAttributes = $this->getAttributes($newNode);

        foreach ($newAttributes as $name => $value) {
            if (!isset($oldAttributes[$name]) || $oldAttributes[$name] !== $value) {
                $changes[] = ['action' => 'setAttribute', 'path' => $path, 'name' => $name, 'value' => $value];
            }
        }

        foreach ($oldAttributes as $name => $value) {
            if (!isset($newAttributes[$name])) {
                $changes[] = ['action' => 'removeAttribute', 'path' => $path, 'name' => $name];
            }
        }

        $oldChildren = $oldNode->childNodes;
        $newChildren = $newNode->childNodes;

        $maxLength = max($oldChildren->length, $newChildren->length);

        for ($i = 0; $i < $maxLength; $i++) {
            $oldChild = $oldChildren->item($i);
            $newChild = $newChildren->item($i);

            if (!$oldChild && $newChild) {
                $changes[] = ['action' => 'append', 'path' => $path, 'content' => $newDom->saveHTML($newChild)];
            } elseif ($oldChild && !$newChild) {
                $changes[] = ['action' => 'remove', 'path' => $path . '/' . ($i + 1)];
            } else {
                $this->compareNodes($oldChild, $newChild, $oldXpath, $newXpath, $changes, $path . '/' . ($i + 1));
            }
        }
    }

    private function getAttributes(\DOMNode $node): array
    {
        $attributes = [];
        if ($node->hasAttributes()) {
            foreach ($node->attributes as $attr) {
                $attributes[$attr->name] = $attr->value;
            }
        }
        return $attributes;
    }
}