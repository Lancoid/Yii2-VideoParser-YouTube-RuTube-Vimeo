<?php

namespace app\models;

use Yii;
use yii\web\HttpException;

/**
 * Class VideoParser
 * @package app\models
 */
class VideoParser
{
    const YOUTUBE_SERVICE = 1;
    const RUTUBE_SERVICE = 2;
    const VIMEO_SERVICE = 3;

    const YOUTUBE_REGEX = '/(?:http|https\:\/\/|)(?:www\.|m\.|)(?:youtu\.be\/|youtube\.com\/)(?:v\/|embed\/|watch\?v\=|)([a-zA-Z0-9]+)/';
    const RUTUBE_REGEX = '/(?:http|https\:\/\/|)(?:www\.|m\.|)rutube\.ru\/(?:video|tracks)\/(?:embed\/|)([a-zA-Z0-9_\-]+)/';
    const VIMEO_REGEX = '/(?:http|https\:\/\/|)(?:www\.|m\.|)vimeo\.com\/(?:album\/[0-9]+\/video\/|groups\/[a-zA-Z0-9]+\/videos\/|channels\/[a-zA-Z0-9]+\/|)([0-9]+)/';

    const YOUTUBE_URL = 'http://www.youtube.com/watch?v=';
    const RUTUBE_URL = 'https://rutube.ru/video/';
    const VIMEO_URL = 'https://vimeo.com/';

    /**
     * Identifying the service by regex and getting information from the API
     * @param $url
     * @return bool
     * @throws HttpException
     */
    public function identifyServiceAndGetInfo($url)
    {
        if (preg_match(self::YOUTUBE_REGEX, $url, $match)) {
            $pre_content = $this->dataYouTube($match[1]);
            $contents = $pre_content['items'][0];

            if ($contents) {
                $data['service'] = self::YOUTUBE_SERVICE;
                $data['video_id'] = $contents['id'];
                $data['title'] = $contents['snippet']['title'];
                $data['description'] = $contents['snippet']['description'];
                $data['thumbnail'] = $contents['snippet']['thumbnails']['standard']['url'];
                $data['url'] = self::YOUTUBE_URL . $data['video_id'];
                return $data;
            }
        } elseif (preg_match(self::RUTUBE_REGEX, $url)) {
            if (preg_match('/video\/embed/', $url)) {
                $embed_url = preg_filter('/video\/embed/', 'tracks', $url);
                $url = $embed_url . '.html';
            }

            if (preg_match('/tracks/', $url)) {
                $url = $this->redirectedPage($url);
            }

            preg_match(self::RUTUBE_REGEX, $url, $match);
            $contents = $this->dataRuTube($match[1]);

            if ($contents) {
                $data['service'] = self::RUTUBE_SERVICE;
                $data['video_id'] = $contents['id'];
                $data['title'] = $contents['title'];
                $data['description'] = $contents['description'];
                $data['thumbnail'] = $contents['thumbnail_url'];
                $data['url'] = self::RUTUBE_URL . $data['video_id'];
                return $data;
            }
        } elseif (preg_match(self::VIMEO_REGEX, $url, $match)) {
            $contents = $this->dataVimeo($match[1]);

            if ($contents) {
                $data['service'] = self::VIMEO_SERVICE;
                $data['video_id'] = $contents->video->id;
                $data['title'] = $contents->video->title;
                $data['description'] = $contents->video->description;
                $data['thumbnail'] = $contents->video->thumbnail_large;
                $data['url'] = self::VIMEO_URL . $data['video_id'];
                return $data;
            }
        } else {
            throw new HttpException(404, "Couldn't get information from your link");
        }
    }

    /**
     * Getting information from the YouTube Data API v3 (requires ApiKey from @app/config/params.php)
     * @param $id
     * @return mixed
     * @throws HttpException
     */
    private function dataYouTube($id)
    {
        try {
            $apiKey = Yii::$app->params['youtubeApiKey'];
            $source = 'https://www.googleapis.com/youtube/v3/videos?id=' . $id . '&key=' . $apiKey . '&part=snippet';
            $json = file_get_contents($source);
            $contents = json_decode($json, true);
            return $contents;
        } catch (\Exception $e) {
            throw new HttpException(404, "Couldn't get information from your link");
        }
    }

    /**
     * Method for retrieving url the last page after redirects
     * some RuTube links needs this
     * @param $url
     * @return bool|mixed
     */
    private function redirectedPage($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_exec($ch);
        $target = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        if ($target) {
            return $target;
        } else {
            return false;
        }
    }

    /**
     * Getting information from the RuTube Api
     * @param $id
     * @return mixed
     * @throws HttpException
     */
    private function dataRuTube($id)
    {
        try {
            $content = file_get_contents('http://rutube.ru/api/video/' . $id);
            $contents = json_decode($content, true);
            return $contents;
        } catch (\Exception $e) {
            throw new HttpException(404, "Couldn't get information from your link");
        }
    }

    /**
     * Getting information from the Vimeo Api
     * @param $id
     * @return object SimpleXMLElement
     * @throws HttpException
     */
    private function dataVimeo($id)
    {
        try {
            $contents = simplexml_load_file('http://vimeo.com/api/v2/video/' . $id . '.xml');
            return $contents;
        } catch (\Exception $e) {
            throw new HttpException(404, "Couldn't get information from your link");
        }
    }
}
