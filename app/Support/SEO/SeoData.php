<?php
namespace App\Support\SEO;

use Carbon\Carbon;

/**
 * @method $this setHeading(string $h1);
 * @method $this setSubHeading(string $h2);
 * @method $this setTitle(string $title);
 * @method $this setDescription(string $description);
 * @method $this setKeywords(string $keywords);
 * @method $this setMetaFooter(string $meta_footer);
 * @method $this setRobots(string $robot);
 * @method $this setCanonicalUrl(string $canonical_url);
 * @method $this setShortDescription(string $short_description);
 * @method $this setContent(string $content);
 * @method $this setExcerpt(string $excerpt);
 * @method $this setOgURL(string $og_url);
 * @method $this setOgTitle(string $og_title);
 * @method $this setOgDescription(string $og_description);
 * @method $this setOgImage(string $og_image);
 * @method string getHeading();
 * @method string getSubHeading();
 * @method string getTitle();
 * @method string getDescription();
 * @method string getKeywords();
 * @method string getMetaFooter();
 * @method string getRobots();
 * @method string getOgURL();
 * @method string getOgImage();
 * @method string getOgTitle();
 * @method string getOgDescription();
 * @method string getCanonicalUrl();
 * @method string getContent();
 * @method string getShortDescription();
 * @method $this getExcerpt();
 *
 */
Class SeoData
{
    private $h1;
    private $h2;
    private $title;
    private $description;
    private $keywords;
    private $short_description;
    private $content;
    private $vars;
    private $snippetTitle;
    private $excerpt;
    private $meta_footer;
    private $og_image;
    private $og_url;
    private $canonical_url;
    private $robots;
    private $og_description;
    private $og_title;


    /**
     * @param $function
     * @param $arguments
     * @return $this|mixed
     */
    public function __call($function, $arguments)
    {
        $variables = [
            'heading',
            'title',
            'description',
            'keywords',
            'short_description',
            'vars',
            'content',
            'excerpt',
            'sub_heading',
            'meta_footer',
            'og_url',
            'og_image',
            'canonical_url',
            'robots',
            'og_description',
            'og_title'
        ];
        $parts = preg_split('/set/', $function);

        if (isset($parts[1])) {
            $property = $this->fromCamelCase($parts[1]);

            if (isset($parts[1]) && in_array($property, $variables)) {

                switch ($property) {
                    case "heading":
                        $this->h1 = collect($arguments)->first();
                        break;

                    case "sub_heading":
                        $this->h2 = collect($arguments)->first();
                        break;

                    default :
                        $this->{$property} = collect($arguments)->first();
                        break;
                }

                return $this;
            }
        }

        $parts = preg_split('/get/', $function);

        if (isset($parts[1])) {
            $property = $this->fromCamelCase($parts[1]);

            if (isset($parts[1])) {
                switch ($property) {
                    case "heading":
                        $value = $this->h1;
                        break;

                    case "sub_heading":
                        $value = $this->h2;
                        break;

                    default :
                        if (isset($this->{$property})) {
                            $value = $this->{$property};
                        } else {
                            $value = '';
                        }
                        break;
                }

                return $value;
            }
        }
    }

    public function setMetaData($meta = '')
    {
        if (!is_array($meta)) {
            \Log::warning("Meta data did not process for ROUTE:: " . request()->route()->getName());
            return '';
        }

        $meta = (object)$meta;

        if (isset($meta->title)) {
            $this->setTitle($meta->title);
        }

        if (isset($meta->description)) {
            $this->setDescription($meta->description);
        }

        if (isset($meta->keywords)) {
            $this->setKeywords($meta->keywords);
        }

        if (isset($meta->keyword)) {
            $this->setKeywords($meta->keyword);
        }

        if (isset($meta->short_description)) {
            $this->setShortDescription($meta->short_description);
        }

        if (isset($meta->h1)) {
            $this->setHeading($meta->h1);
        }

        if (isset($meta->content)) {
            $this->setContent($meta->content);
        }

        if (isset($meta->robots)) {
            $this->setRobots($meta->robots);
        }

        return true;
    }

    public function dd()
    {
        dd($this);
    }

    public function getAllMetas()
    {
        $meta['title'] = $this->getTitle();
        $meta['h1'] = $this->getHeading();
        $meta['description'] = $this->getDescription();
        $meta['short_description'] = $this->getShortDescription();
        $meta['keywords'] = $this->getKeywords();
        $meta['content'] = $this->getContent();
        $meta['robots'] = $this->getRobot();
        
        return $meta;
    }

    public function getStaticMeta($string, $brand = '', $category = '')
    {
        if (is_string($string)) {
            $metas = (object)config($string);
        } else {
            $metas = $string;
        }

        if (is_null($metas)) {
            return false;
        }

        foreach ($metas as $key => $meta) {
            $search = ['{DATE}', '{YEAR}', '{BRAND}', '{GROUP}', '{CATEGORY}', '{{cat}}'];
            $replace = [
                Carbon::now()->format('F, Y'),
                Carbon::now()->format('Y'),
                ucwords($brand),
                ucwords($category),
                ucwords($category),
                ucwords($category),
            ];

            foreach ($search as $k => $s) {
                $metas->{$key} = preg_replace('/' . $s . '/', $replace[$k], $metas->{$key});
                $metas->{$key} = preg_replace('/\s\s+/', ' ', $metas->{$key});
                $metas->{$key} = preg_replace('/' . $s . '/', $replace[$k], $metas->{$key});
            }
        }

        if (empty($brand) && empty($category)) {
            return (array)$metas;
        } else {
            return $metas;
        }
    }

    public function hasKey($key)
    {
        if (isset($this->{$key}) && !empty($this->{$key})) {
            return true;
        }
        return false;
    }

    public function has($key)
    {
        if (isset($this->{$key}) && !empty($this->{$key})) {
            return true;
        }

        return false;
    }

    public function fromCamelCase($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);

        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}