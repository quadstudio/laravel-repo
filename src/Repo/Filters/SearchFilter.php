<?php

namespace QuadStudio\Repo\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;
use QuadStudio\Repo\Tag;

abstract class SearchFilter extends FormFilter
{

    /**
     * @var string
     */
    protected $search = 'search';

    /**
     * @var string
     */
    protected $mode = 'mode';

    /**
     * @var string
     */
    protected $encoding = 'UTF-8';

    /**
     * @var array
     */
    protected $restricted = [
        "'", '"', '!', '@', '#', '$', '%', '^', '&', '*', '?', '=', '+', ':',
        '|', '`', '№', '~', '!', '<', '>', '{', '}', '[', ']', '\\', '/'
    ];

    /**
     * @var array
     */
    protected $delimiter = [' ', '\.', ';', ','];

    /**
     * @var array
     */
    protected $changed = ['(', ')'];

    function apply($builder, RepositoryInterface $repository)
    {
        //dump($this);
        //dd($this->canTrack());
        if ($this->canTrack()) {
            if (!empty($this->columns())) {
                $words = $this->split($this->get($this->search));
                if (!empty($words)) {
                    foreach ($words as $word) {
                        $builder = $builder->where(function ($query) use ($word) {
                            foreach ($this->columns() as $column) {
                                $query->orWhereRaw("LOWER({$column}) LIKE LOWER(?)", ["%{$word}%"]);
                            }
                        });
                    }
                }
            }
        }

        return $builder;
    }

    /**
     * @return array
     */
    protected function columns()
    {
        return [];
    }

    /**
     * @param $words
     * @return array
     */
    protected function split($words)
    {
        // Очищаем искомый текст
        $clear_words = $this->clean($words);

        // Разбиваем строку поиска на составляющие
        return preg_split('/[' . implode('', $this->delimiter) . ']/', $clear_words, null, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * @param $text
     * @return string
     */
    protected function clean($text)
    {
        $text = str_replace($this->changed, " ", $text);
        $text = str_replace($this->restricted, "", $text);
        $text = preg_replace('/\s+/', ' ', trim($text));

        return trim($text);
    }

    /**
     * @return Tag
     */
    public function tag(): Tag
    {
        if (is_null($this->tag)) {
            $attributes = $this->attributes();
            if ($this->has($this->name()) && $this->get($this->name()) != "") {
                $attributes['value'] = $this->get($this->name());
            }
            $this->tag = new Tag('text', [
                'attributes' => $attributes,
            ]);
        }

        return $this->tag;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->search;
    }

    /**
     * @return array
     */
    public function track()
    {
        return [
            $this->search,
        ];
    }

}