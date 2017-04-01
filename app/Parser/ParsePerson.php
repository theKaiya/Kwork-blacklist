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
     * @var
     */
    protected $name;


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
    public function parse (): array
    {
        if(!$this->filter())
            return null;

        return [
            'name' => $this->getName(),
            'username' => $this->getUsername(),
            'avatar' => $this->saved_avatar,
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
        if($this->getUsername() && $this->getAvatar())
            return true;

        return false;
    }

    /**
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    public function getUsername ()
    {
        if($this->username)
            return $this->username;

        $this->username = $this->client->filter(
            "div[class='userbannertext pull-left ml15 sm-pull-reset m-text-center m-m0'] h1"
        )->first();

        if(count($this->username)) {
            $this->username = $this->username->text();

            return $this->username;
        }

        return null;
    }

    public function getName ()
    {
        if($this->name)
            return $this->name;

        $this->name = $this->client->filter("div[class='color-white sm-pull-reset mb10']")->first();

        if(count($this->name)) {
            $this->name = $this->name->text();

            return $this->name;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getAvatar ()
    {
        if($this->avatar)
            return $this->avatar;

        $this->avatar = $this->client->filter('img[class="rounded"]')->first();

        if(count($this->avatar)) {
            $this->storeAvatar();

            return true;
        }

        return null;
    }

    /**
     * Store avatar to local storage.
     *
     * @return string
     */
    public function storeAvatar ()
    {
        $avatar = $this->avatar->attr('src');

        // if its a default avatar.
        if(strpos($avatar, 'noprofilepicture') !== false) {
            return $this->saved_avatar = "/assets/images/noprofilepicture.jpg";
        }

        $path = 'uploads/people/'.Carbon::today()->timestamp;

        if(!is_dir(public_path($path))) {
            mkdir(public_path($path));
        }

        $image = str_random(30).'.jpg';

        $f_path = $path.'/'.$image;

        Image::make($avatar)->save($f_path);

        $this->saved_avatar = '/'.$f_path;
    }
}