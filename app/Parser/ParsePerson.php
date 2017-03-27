<?php

namespace App\Parser;

use Carbon\Carbon;
use Goutte\Client;
use Image;

class ParsePerson
{

    /**
     * Person url.
     *
     * @var string
     */
    protected $url;

    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    protected $client;

    /**
     * Person username
     *
     * @var
     */
    protected $username;

    /**
     * Person avatar
     *
     * @var
     */
    protected $avatar;


    /**
     * Saved person image path.
     *
     * @var
     */
    protected $saved_avatar;

    public function __construct(string $url)
    {
        $this->url = $url;

        $this->client = new Client();

        $this->client = $this->client->request('GET', $url);
    }


    /**
     * @return array|bool
     */
    public function parse ()
    {
        if($this->filter())
            return true;

        $username = $this->getUsername()->text();

        $avatar = $this->saved_avatar;

        return [
            'username' => $username,
            'avatar' => $avatar,
            'url' => $this->url,
        ];
    }

    /**
     * Check for having needed values.
     *
     * @return bool
     */
    public function filter ()
    {
        if(count($this->getUsername()) && count($this->getAvatar()))
            return false;

        return true;
    }

    public function getUsername ()
    {
        if($this->username)
            return $this->username;

        $this->username = $this->client->filter('h1[class="mt0"]')->first();

        return $this->username;
    }

    /**
     * @return string
     */
    public function getAvatar ()
    {
        if($this->avatar)
            return $this->avatar;

        $this->avatar = $this->client->filter('img[class="rounded"]')->first();

        if($this->avatar)
            $this->storeAvatar();

        return $this->avatar;
    }

    /**
     * @return string
     */
    public function storeAvatar ()
    {
        $path = 'uploads/people/'.Carbon::today()->timestamp;

        if(!is_dir(public_path($path))) {
            mkdir(public_path($path));
        }

        $image = str_random(30).'.jpg';

        $f_path = $path.'/'.$image;

        Image::make($this->avatar->attr('src'))->save($f_path);

        $this->saved_avatar = $f_path;
    }
}